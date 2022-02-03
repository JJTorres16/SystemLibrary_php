<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js-own/mensajes.js"></script>
    <title>Registro de Préstamo de libro</title>
</head>
<body>
    <?php require 'views/header.php' ?>

    <?php

        //Importamos el controlador de catálogo:
        require_once 'controllers/catalogo.php';

        if(isset($_GET['error'])){
            $error = $_GET['error']; 
            
    ?>

        <script>muestraErrorAltaPrestamo(<?php echo $error ?>);</script> <?php } ?>

    <?php        

        //Variables obtenidos por el método GET:
        $idLibro = $_GET['idLibro'];
        $tipoPrestamo = $_GET['tipo'];

        if($tipoPrestamo == 'sala')
            $cantDiasPrestamo = 0;
        else
            $cantDiasPrestamo = 3;

        $contCatalogo = new Catalogo();
        $selectedBook = $contCatalogo->showDetail($idLibro);

        //Ciclo foreach para recorrer el arreglo con la información de libro seleccionado:
        foreach($selectedBook as $libro){

    ?>

    <div class="container" style="margin-top:50px;">
        <h2>Alta de préstamos</h2>
        <small class="text-muted">Presta los libros a sala o a domicilio</small><br><br>
        <p style="text-align: justify; color:gray"><?php echo $libro->getSinopsis(); ?></p><hr>    
    </div>

    <div class="container" style="margin-top:15px;">
        <form action="/SystemLibrary/prestamo/agregar" name="formAltaPrestamo" class="row g-3" method="POST" onsubmit="return confirmaAltaPrestamo(this);">
            <input hidden type="text" name="txtIdLibro" id="txtIdLibro" value="<?php echo $libro->getidLibros(); ?>">
            <input hidden type="text" name="txtTipoPrestamo" id="txtTipoPrestamo" value="<?php echo $tipoPrestamo ?>">
            <div class="col-md-4">
                <label for="txtNombreLibro" class="form-label">Nombre del libro:</label>
                <input readonly type="text" class="form-control" id="txtNombreLibro" name="txtNombreLibro" value="<?php echo $libro->getNombre(); ?>">
            </div>
            <div class="col-md-4">
                <label for="txtISBNLibro" class="form-label">ISBN:</label>
                <input readonly type="text" class="form-control" id="txtISBNLibro" name="txtISBNLibro" value="<?php echo $libro->getISBN(); ?>">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for="txtNameAlumno" class="form-label">Número de control del estudiante:</label>
                <input type="text" class="form-control" id="txtNcAlumno" name="txtNcAlumno" required pattern="[0-9]{8}">
            </div>
            <div class="col-md-4">
                <label for="dateFechaInicio" class="form-label">Fecha de inicio de préstamo:</label>
                <input readonly type="text" class="form-control" id="dateFechaInicio" name="dateFechaInicio" value="<?php echo date("d/m/Y"); ?>" requiered>
            </div>
            <div class="col-md-4">
                <label for="dateFinPrestamo" class="form-label">Fecha de retorno de libro:</label>
                <input readonly type="text" class="form-control" id="dateFinPrestamo" name="dateFinPrestamo" value="<?php echo date("d/m/Y", mktime(0, 0, 0, date("m"), date("d") + $cantDiasPrestamo, date("Y"))); ?>" required>
            </div>
            <div class="col-md-12">
                <label for="areaObservPrestamo" class="form-label">Observaciones:</label>
                <textarea class="form-control" name="areaObservPrestamo" id="areaObservPrestamo" cols="30" rows="7"></textarea>
            </div>
           
           
            <div class="col-md-6">
                <div>
                    <button class="btn btn-success" type="submit">Agregar</button>
                    <a class="btn btn-danger" href="/SystemLibrary/catalogo">Cancelar</a>
                </div>
            </div>

            <?php

                }

            ?>
        </form>
    </div>

    <?php //require 'views/footer.php' ?>
</body>
</html>