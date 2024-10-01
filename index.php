<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="img/libro.png" />

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">

    <script defer src="js/label.js"></script>
    <script defer src="js/mostrar_ocultar_html.js"></script>

    <title>Liberar Cartón</title>
</head>

<body>

    <?php
    // Inicializando la variables
    $ancho = '';
    $largo = '';
    $ancholomo = '';
    $largolomo = '';
    $cantidad = '';
    $pliegostapa = '';
    $mayort = '';
    $pliegoslomo = '';
    $mayorl = '';
    $op = '';
    $cliente = '';
    $referencia = '';

    // Verificando si hay un POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recuperar el texto enviado
        $op = isset($_POST['op']) ? $_POST['op'] : '';
        $cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
        $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';

        $ancho = isset($_POST['ancho']) ? $_POST['ancho'] : '';
        $largo = isset($_POST['largo']) ? $_POST['largo'] : '';
        $ancholomo = isset($_POST['ancholomo']) ? $_POST['ancholomo'] : '';
        $largolomo = isset($_POST['largolomo']) ? $_POST['largolomo'] : '';

        $mayorl = isset($_POST['mayorl']) ? $_POST['mayorl'] : '';
    }

    // Arreglo errores
    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!$op) {
            $errores[] = "Se Debe Añadir Una OP";
        }
        if (!$cliente) {
            $errores[] = "Se Debe Añadir CLIENTE";
        }
        if (!$referencia) {
            $errores[] = "Se Debe Añadir REFERENCIA";
        }
        if (!$cantidad) {
            $errores[] = "Se Debe Añadir CANTIDAD DE LIBROS";
        }
        if (!$ancho) {
            $errores[] = "Se Debe Añadir ANCHO TAPA";
        }
        if (!$largo) {
            $errores[] = "Se Debe Añadir LARGO TAPA";
        }
        if (!$ancholomo) {
            $errores[] = "Se Debe Añadir ANCHO LOMO";
        }
        if (!$largolomo) {
            $errores[] = "Se Debe Añadir LARGO LOMO";
        }

        // Revisar arreglo errores vacico

        if (empty($errores)) {

            $pliegoancho70 = 70;
            $pliegolargo100 = 100;

            // $ancho
            // $largo 
            // $ancholomo 
            // $cantidad 

            $cabida1t = intdiv($pliegoancho70, $ancho) * intdiv($pliegolargo100, $largo);
            $cabida2t = intdiv($pliegolargo100, $ancho) * intdiv($pliegoancho70, $largo);
            $cabida3t = 0;


            if (($pliegolargo100 - ($largo * 2)) >= ($ancho * 2)) {
                $cabida3t = 10;
            }

            $mayort = 0;
            if ($cabida1t > $cabida2t && $cabida1t > $cabida3t) {
                $mayort = $cabida1t;
            } else if ($cabida2t > $cabida3t) {
                $mayort = $cabida2t;
            } else {
                $mayort = $cabida3t;
            }

            $pliegostapa = ceil(($cantidad * 2) / $mayort);


            $cabida1l = intdiv($pliegoancho70, $ancholomo) * intdiv($pliegolargo100, $largolomo);
            $cabida2l = intdiv($pliegolargo100, $ancholomo) * intdiv($pliegoancho70, $largolomo);

            $mayorl = 0;
            if ($cabida1l > $cabida2l) {
                $mayorl = $cabida1l;
            } else {
                $mayorl = $cabida2l;
            }

            $pliegoslomo = ceil($cantidad / $mayorl);
        }
    }


    ?>

    <main class="container">

        <nav class="menu ">
            <ul>
                <p class="nav__otros menu__activo">Liberación de : </p>
                <a href="#" class="nav__title menu__activo">Tapa Dura</a>
                <a href="#" class="nav__title">Tapa De Cuaderno</a>
                <a href="#" class="nav__title">Tapa Única</a>
                <a href="#" class="nav__title">Tapa Doble Lomo</a>
                <a href="#" class="nav__title">Acerca De</a>
            </ul>
        </nav>



        <section class="parte1">

            <form class="formulario" method="POST" action="index.php">

                <fieldset>
                    <legend>Ingresar Datos Tapa Dura</legend>

                    <img src="img/TapaDura.png" alt="TapaDura" class="img__tapa">
                    <?php foreach ($errores as $error) :  ?>
                        <div class="alerta error">
                            <?php echo $error;  ?>
                        </div>
                    <?php endforeach;  ?>

                    <div class="formulario__int">

                        <div class="formulario__p2">
                            <div class="label_input">
                                <label for="op">Op: </label>
                                <input type="number" placeholder="Op" id="op"
                                    name="op" value="<?php echo htmlspecialchars($op); ?>" onkeypress="return Solonumeros(event)">
                            </div>
                            <div class="label_input">
                                <label for="cliente">Cliente: </label>
                                <input type="text" placeholder="Cliente" id="cliente"
                                    name="cliente" value="<?php echo htmlspecialchars($cliente); ?>">
                            </div>
                            <div class="label_input">
                                <label for="referencia">Referencia: </label>
                                <input type="text" placeholder="Referencia" id="referencia"
                                    name="referencia" value="<?php echo htmlspecialchars($referencia); ?>">
                            </div>
                            <div class="label_input">
                                <label for="cantidad">Cantidad De Libros:</label>
                                <input type="number" min="0" step="0.01" placeholder="Cantidad De Libros" id="cantidad"
                                    name="cantidad" value="<?php echo htmlspecialchars($cantidad); ?>" onkeypress="return Solonumeros(event)">
                            </div>

                        </div>

                        <div class="formulario__p3">
                            <div class="label_input">
                                <label for="ancho">Ancho Tapa - CMS: </label>
                                <input type="number" min="0" step="0.01" placeholder="Ancho Tapa" id="ancho"
                                    name="ancho" value="<?php echo htmlspecialchars($ancho); ?>" onkeypress="return Solonumeros(event)">
                            </div>
                            <div class="label_input">
                                <label for="largo">Largo Tapa - CMS: </label>
                                <input type="number" min="0" step="0.01" placeholder="Largo Tapa" id="largo"
                                    name="largo" value="<?php echo htmlspecialchars($largo); ?>" onkeypress="return Solonumeros(event)">
                            </div>
                            <div class="label_input">
                                <label for="ancholomo">Ancho lomo - CMS:</label>
                                <input type="number" min="0" step="0.01" placeholder="Ancho lomo" id="ancholomo"
                                    name="ancholomo" value="<?php echo htmlspecialchars($ancholomo); ?>" onkeypress="return Solonumeros(event)">
                            </div>
                            <div class="label_input">
                                <label for="largolomo">Largo Lomo - CMS: </label>
                                <input type="number" min="0" step="0.01" placeholder="Largo Lomo" id="largolomo"
                                    name="largolomo" value="<?php echo htmlspecialchars($largolomo); ?>" onkeypress="return Solonumeros(event)">
                            </div>
                        </div>

                        <div class="principal__p formulario__p4">
                            <p class="p__parrafoalert">Ingresar Solo Números</p>
                            <div class="contenedorboton">
                                <input type="submit" value="calcular" class="boton__naranja">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>




        <section class="parte2">

            <h3>Liberación</h3>

            <div class="parte2__contenedor">

                <div>
                    <h4>Tapa:</h4>
                    <p><?php echo $pliegostapa; ?> Pliegos 70x100 </p>
                    <p>Cortados <?php echo $ancho . " x " . $largo . " CMS"; ?></p>
                    <p>Cabida <?php echo $mayort; ?></p>
                </div>

                <div>
                    <h4>Lomo:</h4>
                    <p><?php echo $pliegoslomo; ?> Pliegos 70x100
                    <p>Cortados <?php echo $ancholomo . " x " . $largolomo . " CMS"; ?></p>
                    <p>Cabida <?php echo $mayorl; ?></p>
                    <h5>Se puede ahorrar este ítem cortando los retazos de la tapa</h5>
                </div>



            </div>



        </section>

        <footer class="footer">

            <h5>Creado Por:</h5>
            <img src="img/Mi Logo.svg" alt="MiLogo" class="img__MiLogo">


        </footer>



    </main>


</body>

</html>