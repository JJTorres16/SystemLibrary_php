<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/SystemLibrary/public/css-owner/StyleScrollDiv.css"></link>
    <script src="/SystemLibrary/public/js-own/mensajes.js"></script>
    <script src="/SystemLibrary/public/js-own/formularios.js"></script>
    <title>Historial de préstamos</title>
</head>
<body>

    <?php require_once 'views/header.php' ?>
    <?php require_once 'controllers/Prestamo.php' ?>
    <?php require_once 'controllers/alumno.php' ?>

    <?php

        //Importamos el controlador de catálogo:
        require_once 'controllers/catalogo.php';

        if(isset($_GET['error'])){
        $error = $_GET['error'];            
    ?>

        <script>muestraErrorAltaPrestamo(<?php echo $error ?>);</script> <?php } ?>

    <?php 
    
        if(isset($_GET['noControl']))
            $noControl = $_GET['noControl'];
        else
            $noControl = '';

        $controllerAlumno = new Alumno();
        $alumnoSeleccionado = $controllerAlumno->show($noControl);

        foreach($alumnoSeleccionado as $alumno){
            $nombreCompleto = $alumno->getNombre() . ' ' . $alumno->getApellidoPaterno() . ' ' . $alumno->getApellidoMaterno();

    ?>

    <div class="container" style="margin-top:50px">
        <h3><?php echo $nombreCompleto ?></h3>
        <small class="text-muted">Historial de préstamos</small>

    </div>

    <?php 
    
        }
    
    ?>

    <div class="container">
    </div>

    <div class="container" style="margin-top:50px">
    <h5>Préstamos Actuales</h5>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="4%">Id</th>
                    <th scope="col" width="25%">Libro</th>
                    <th scope="col" width="17%">Categoria</th>
                    <th scope="col" width="12%">Fec. inicio</th>
                    <th scope="col" width="15">Fec. entrega</th>
                    <th scope="col" width="10%">Tipo</th>
                    <th scope="col" colspan="3" width="10%" style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php 
    
                $controllerPrestamo = new Prestamo();
                $listaPrestamo = $controllerPrestamo->show('En curso', 'Retrasado');

                foreach($listaPrestamo as $prestamosHistorial){
            ?>

                <tr>
                    <th scope="row"><?php echo $prestamosHistorial['idprestamo']; ?></th>
                    <td><?php echo $prestamosHistorial['nombre']; ?></td>
                    <td><?php echo $prestamosHistorial['categoria']; ?></td>
                    <td><?php echo $prestamosHistorial['fecinit']; ?></td>
                    <td><?php echo $prestamosHistorial['fecfin']; ?></td>
                    <td><?php echo $prestamosHistorial['tipo']; ?></td>
                    <td style="text-align: center;">
                        <?php if($prestamosHistorial['retraso'] == 0){ ?>
                            <form action="/SystemLibrary/prestamo/refrendar" name="formRefrendarPrestamo" id="formRefrendarPrestamo" method="POST">
                                <input type="text" name="txtIdPrestamo" id="txtIdPrestamo" value="<?php echo $prestamosHistorial['idprestamo'] ?>" hidden>
                                <input type="text" name="txtNoControl" id="txtNoControl" value="<?php echo $prestamosHistorial['alumnonocontrol'] ?>" hidden>
                                <input type="text" name="txtOrigen" id="txtOrigen" value="alumno" hidden>        
                                <button type="submit" class="btn btn-outline-success btn-sm">Refrendar</button>
                            </form>                          
                        <?php } ?>
                    </td>
                    <td style="text-align: center;">
                        <form action="/SystemLibrary/prestamo/devolver" name="formDevolverPrestamo"  method="POST" onsubmit="return confirmaDevolucionDeLibro(this);">
                            <input type="text" name="txtIdPrestamo" id="txtEstadoPrestamo" value="<?php echo $prestamosHistorial['idprestamo'] ?>" hidden>     
                            <input type="text" name="txtIdLibro" id="txtIdLibro" value="<?php echo $prestamosHistorial['idlibro'] ?>" hidden>
                            <input type="text" name="txtNoControl" id="txtNoControl" value="<?php echo $prestamosHistorial['alumnonocontrol'] ?>" hidden>
                            <input type="text" name="txtOrigen" id="txtOrigen" value="alumno" hidden> 
                            <button type="submit" class="btn btn-outline-primary btn-sm">Devolver</button>
                        </form>
                    </td>
                    <td style="text-align: center">
                        <a href="/SystemLibrary/prestamo/details?idPrestamo=<?php echo $prestamosHistorial['idprestamo']; ?>" class="btn btn-outline-danger btn-sm">Detalles</a>
                    </td>
                </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>

    <!-- Contenedor para los libros con préstamo finalizado-->
    <div class="container" style="margin-top:50px">
        <h5>Registro de préstamos finalizados</h5>

        <!-- Préstamos anteriores con scrolling incluido-->
        <div class="div-scroll" style="margin-top: 25px;">
            <div class="table table-striped table-hover">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="4%">Id</th>
                            <th scope="col" width="25%">Libro</th>
                            <th scope="col" width="16%">Categoria</th>
                            <th scope="col" width="12%">Fec. inicio</th>
                            <th scope="col" width="12%">Fec. entrega</th>
                            <th scope="col" width="5%" style="text-align: center;">Tipo</th>
                            <th scope="col" width="5%">Refrendos</th>
                            <th scope="col" width="10%" style="text-align: center;">Estado</th>
                            <th scope="col" width="12%" style="text-align: center">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
    
                        $controllerPrestamo = new Prestamo();
                        $listaPrestamo = $controllerPrestamo->show('Finalizado');

                        foreach($listaPrestamo as $prestamosHistorial){
                    ?>
                    
                    <tr>
                    <th scope="row"><?php echo $prestamosHistorial['idprestamo']; ?></th>
                    <td><?php echo $prestamosHistorial['nombre']; ?></td>
                    <td><?php echo $prestamosHistorial['categoria']; ?></td>
                    <td><?php echo $prestamosHistorial['fecinit']; ?></td>
                    <td><?php echo $prestamosHistorial['fecfin']; ?></td>
                    <td style="text-align: center;"><?php echo $prestamosHistorial['tipo']; ?></td>
                    <td style="text-align: center;"><?php echo $prestamosHistorial['norefrendo']; ?></td>
                    <td style="text-align: center;">
                            <?php if($prestamosHistorial['retraso'] == 1){ ?> Finalizado con Retraso <?php } else {  ?>
                            Finalizado <?php } ?>
                    </td>
                    <td style="text-align: center">
                        <a href="/SystemLibrary/prestamo/details?idPrestamo=<?php echo $prestamosHistorial['idprestamo']; ?>" class="btn btn-outline-primary btn-sm">Detalles</a>
                    </td>
                </tr>

                <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <a href="/SystemLibrary/alumno" class="btn btn-primary">Regresar</a>

    <?php //require_once 'views/footer.php' ?>
</body>
</html>