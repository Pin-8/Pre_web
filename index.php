<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-web </title>
    <link rel="stylesheet" type="text/css" href="index.css" media="all">


</head>

<body>
    <!--  // Conexion a la base de datos-->
    <?php
    $con = new mysqli("localhost", "root", "", "sistema");
    // Creo la consulta que traiga los servicios
    $sql = "SELECT * FROM entradas  WHERE id_categoria =  ? "; // manera segura de consultar datos a una base de datos php
    $stmt = $con->prepare($sql);
    ?>


    <?php
    $id_categoria = 4; // 1 por el id que figura en el link, puede ser cualquiera
    $stmt->bind_param("i", $id_categoria);

    // Ejecuto la consulta
    $stmt->execute();
    $variable = $stmt->get_result(); // luego abro la variable servicios en el HTML

    ?>

    <section class="container">
        <div class="navbar">
            <img src="imagenes/logo.png" class="logo" alt="Logo">
            <ul>
                <li><a href="#cervezas">Cervezas</a></li>
                <li><a href="#whiskys">Whiskys</a></li>
                <li><a href="#tragos">Tragos</a></li>
                <li><a href="#otros">Otros</a></li>
            </ul>
        </div>
    </section>

    <!-- <div class="direction-bar">
        <a href="#cervezas" class="icon icon-cerveza"><img src="" alt=""> </a>
        <a href="#" class="icon icon-whisky"></a>
        <a href="#" class="icon icon-licores"></a>
        <a href="#" class="icon icon-tragos"></a>
    </div> -->


    <section class="contenido">
        <section class="titulo">
            <h2 id="cervezas"> Cervezas </h2>
        </section>

        <?php while ($data = $variable->fetch_object()) { ?>
            <div class="row">
                <section class="tipo ">

                    <div class="nombre "><?php echo $data->titulo; ?></div>
                    <div class="valor"> $ <?php echo $data->precio; ?> </div>
            </div>
            <div class="linea"></div>
        <?php } ?>
    </section>



    <?php
    $id_categoria = 5;
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $variable = $stmt->get_result()
    ?>


    <section class="contenido">
        <section class="titulo">
            <h2 id="whiskys"> Whiskys </h2>
        </section>

        <?php while ($data = $variable->fetch_object()) { ?>
            <div class="row">
                <section class="tipo ">

                    <div class="nombre "><?php echo $data->titulo; ?></div>
                    <div class="valor"> $ <?php echo $data->precio; ?> </div>
            </div>
            <div class="linea"></div>
        <?php } ?>
    </section>






    <?php
    $id_categoria = 6;
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $variable = $stmt->get_result()
    ?>


    <section class="contenido">
        <section class="titulo">
            <h2 id="tragos"> Tragos </h2>
        </section>

        <?php while ($data = $variable->fetch_object()) { ?>
            <div class="row">
                <section class="tipo">
                    <!--AGREGAR OTRO DIV QUE ENGLOBE ESTOS DIV-->
                    <div class="nombre "><?php echo $data->titulo; ?></div>
                    <div class="valor"> $ <?php echo $data->precio; ?> </div>
            </div>
            <div class="linea"></div>
        <?php } ?>
    </section>




    <?php
    $id_categoria = 7;
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $variable = $stmt->get_result()
    ?>


    <section class="contenido">
        <section class="titulo">
            <h2 id="otros"> Otros </h2>
        </section>

        <?php while ($data = $variable->fetch_object()) { ?>
            <div class="row">
                <section class="tipo">
                    <!--AGREGAR OTRO DIV QUE ENGLOBE ESTOS DIV-->
                    <div class="nombre "><?php echo $data->titulo; ?></div>
                    <div class="valor"> $ <?php echo $data->precio; ?> </div>
            </div>
            <div class="linea"></div>
        <?php } ?>
    </section>







</body>

</html>