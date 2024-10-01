const labels = document.querySelectorAll("label");

labels.forEach((label) => {
    label.innerHTML = label.innerText
        .split("")
        .map((letter, index) => {
            return `<span style="transition-delay:${index*100}ms">${letter}</span>`
        }).join("");
})


function Solonumeros (evt){
    if(window.event){
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 46 || keynum == 44){
        return true;
    }else{
        var visibleParrafo = document.querySelector(".p__parrafoalert");
        visibleParrafo.style.visibility = 'visible';

        setTimeout(() => {
            visibleParrafo.style.visibility = 'hidden';
          }, 3000);
        return false;
    }

}