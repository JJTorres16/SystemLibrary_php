<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/SystemLibrary/public/js-own/mensajes.js"></script>
    <script src="/SystemLibrary/public/js-own/formularios.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Préstamos</title>
</head>
<body>
    <?php require_once 'views/header.php' ?>
    <?php require_once 'controllers/Prestamo.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Registro de Préstamos</h2>
        <small class="text-muted">Historial de préstamos actuales y vencidos</small>    
    </div><br>

    <div class="container">
        <form action="/SystemLibrary/prestamo">
            <label for="" class="form-label">Filtra por:</label>
            <div class="row">
                <div class="col-md-2">
                    <select name="selectFiltroPrestamos" id="selectFiltroPrestamos" class="form-select">
                        <option value="alumnonocontrol">Alumno</option>
                        <option value="LB.nombre">Libro</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="txtDatoFiltro" name="txtDatoFiltro" placeholder="No. de control de alumno o nombre del libro">                 
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <?php

        //Importamos el controlador de catálogo:
        require_once 'controllers/catalogo.php';

        if(isset($_GET['error'])){
            $error = $_GET['error'];            
    ?>

        <script>muestraErrorAltaPrestamo(<?php echo $error ?>);</script> <?php } ?>


    <div class="container" style="margin-top:25px">
        <h5> <small class="text-muted"> Seleccione el tipo de registro que desea consultar </small> </h5>
        <class class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Generar reporte
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/SystemLibrary/prestamo/reporte?tipo=casa" target="_blank">Préstamos a Casa</a></li>
                <li><a class="dropdown-item" href="/SystemLibrary/prestamo/reporte?tipo=sala" target="_blank">Préstamos a Sala</a></li>
            </ul>
        </class>
    </div>

    <div class="container" style="margin-top:15px">
        <div class="accordion" id="accordionPrestamos">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headerEnCurso">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#prestamosEnCurso" aria-expanded="true" aria-controls="prestamosEnCurso">
                        Préstamos en curso
                    </button>
                </h2>
                <div id="prestamosEnCurso" class="accordion-collapse collapse" arial-labelledby="headerEnCurso" data-bs-parent="#accordionPrestamos">
                    <div class="container" style="margin-top:25px;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Id</th>
                                    <th scope="col" width="30%">Libro</th>
                                    <th scope="col" width="20%">Alumno</th>
                                    <th scope="col" width="10%">Fec. Inicio</th>
                                    <th scope="col" width="10%">Fec. Entrega</th>
                                    <th scope="col" width='10%' style="text-align: center;">Tipo</th>
                                    <th scope="col" colspan="3" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
    
                                $controllerPrestamo = new Prestamo();
                                $listaPrestamo = $controllerPrestamo->show('En curso');

                                foreach($listaPrestamo as $prestamoEnCurso){
                                    $nombreCompleto = $prestamoEnCurso['alumnonombre'] . ' ' . $prestamoEnCurso['appaterno'] . ' ' . $prestamoEnCurso['apmaterno'];

                                    $controllerPrestamo->comparaFecha($prestamoEnCurso['idprestamo'], $prestamoEnCurso['fecfin']);
                            
                            ?>

                                <tr>
                                    <th scope="row"><?php echo $prestamoEnCurso['idprestamo']; ?></th>
                                    <td><?php echo $prestamoEnCurso['nombre']; ?></td>
                                    <td><?php echo $nombreCompleto; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecinit']; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecfin']; ?></td>
                                    <td style="text-align: center"><?php echo $prestamoEnCurso['tipo']; ?></td>
                                    <td style="text-align: center;">
                                        <form action="/SystemLibrary/prestamo/refrendar" name="formRefrendarPrestamo" id="formRefrendarPrestamo" method="POST">
                                            <input type="text" name="txtIdPrestamo" id="txtIdPrestamo" value="<?php echo $prestamoEnCurso['idprestamo'] ?>" hidden>
                                            <input type="text" name="txtNoControl" id="txtNoControl" value="<?php echo $prestamoEnCurso['alumnonocontrol'] ?>" hidden>
                                            <input type="text" name="txtOrigen" id="txtOrigen" value="prestamo" hidden>     
                                            <button type="submit" class="btn btn-outline-success btn-sm">Refrendar</button>
                                        </form>                           
                                    </td>
                                    <td style="text-align: center;">
                                        <form action="/SystemLibrary/prestamo/devolver" name="formDevolverPrestamo"  method="POST" onsubmit="return confirmaDevolucionDeLibro(this);">
                                            <input type="text" name="txtIdPrestamo" id="txtEstadoPrestamo" value="<?php echo $prestamoEnCurso['idprestamo'] ?>" hidden>     
                                            <input type="text" name="txtIdLibro" id="txtIdLibro" value="<?php echo $prestamoEnCurso['idlibro'] ?>" hidden>
                                            <input type="text" name="txtNoControl" id="txtNoControl" value="<?php echo $prestamoEnCurso['alumnonocontrol'] ?>" hidden>
                                            <input type="text" name="txtOrigen" id="txtOrigen" value="prestamo" hidden> 
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Devolver</button>
                                        </form>                           
                                    </td>
                                    <td>
                                        <a href="/SystemLibrary/prestamo/details?idPrestamo=<?php echo $prestamoEnCurso['idprestamo']; ?>" class="btn btn-outline-danger btn-sm">Detalles</a>
                                    </td>                                        
                                </tr>
    
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>
            <div class="accordion" id="accordionPrestamos">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headerRetrasos">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#prestamosRetrasados" aria-expanded="true" aria-controls="prestamosRetrasados">
                        Préstamos retrasados
                    </button>
                </h2>
                <div id="prestamosRetrasados" class="accordion-collapse collapse" arial-labelledby="headerRetrasos" data-bs-parent="#accordionPrestamos">
                    <div class="container" style="margin-top:25px;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Id</th>
                                    <th scope="col" width="30%">Libro</th>
                                    <th scope="col" width="22%">Alumno</th>
                                    <th scope="col" width="12%">Fec. Inicio</th>
                                    <th scope="col" width="12%">Fec. Entrega</th>
                                    <th scope="col" style="text-align: center;">Tipo</th>
                                    <th scope="col" colspan="2" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
    
                                $controllerPrestamo = new Prestamo();
                                $listaPrestamo = $controllerPrestamo->show('Retrasado');

                                foreach($listaPrestamo as $prestamoEnCurso){
                                    $nombreCompleto = $prestamoEnCurso['alumnonombre'] . ' ' . $prestamoEnCurso['appaterno'] . ' ' . $prestamoEnCurso['apmaterno'];

                            ?>

                                <tr>
                                    <th scope="row"><?php echo $prestamoEnCurso['idprestamo']; ?></th>
                                    <td><?php echo $prestamoEnCurso['nombre']; ?></td>
                                    <td><?php echo $nombreCompleto; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecinit']; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecfin']; ?></td>
                                    <td style="text-align: center"><?php echo $prestamoEnCurso['tipo']; ?></td>
                                    <td style="text-align: center;">
                                        <form action="/SystemLibrary/prestamo/devolver" name="formDevolverPrestamo"  method="POST" onsubmit="return confirmaDevolucionDeLibro(this);">
                                            <input type="text" name="txtIdPrestamo" id="txtEstadoPrestamo" value="<?php echo $prestamoEnCurso['idprestamo'] ?>" hidden>
                                            <input type="text" name="txtIdLibro" id="txtIdLibro" value="<?php echo $prestamoEnCurso['idlibro'] ?>" hidden>     
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Devolver</button>
                                        </form>                           
                                    </td>
                                    <td>
                                        <a href="/SystemLibrary/prestamo/details?idPrestamo=<?php echo $prestamoEnCurso['idprestamo']; ?>" class="btn btn-outline-danger btn-sm">Detalles</a>
                                    </td>                                        
                                </tr>
    
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headerHistorial">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#prestamosHistorial" aria-expanded="true" aria-controls="prestamosHistorial">
                        Historial de préstamos
                    </button>
                </h2>
                <div id="prestamosHistorial" class="accordion-collapse collapse" arial-labelledby="headerHistorial" data-bs-parent="#accordionPrestamos">
                    <div class="container" style="margin-top:25px;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Id</th>
                                    <th scope="col" width="30%">Libro</th>
                                    <th scope="col" width="22%">Alumno</th>
                                    <th scope="col" width="12%">Fec. Inicio</th>
                                    <th scope="col" width="12%">Fec. Entrega</th>
                                    <th scope="col" style="text-align: center;">Tipo</th>
                                    <th scope="col" width="12%" style="text-align: center">Estado</th>
                                    <th scope="col" width="12%" style="text-align: center">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
    
                                $controllerPrestamo = new Prestamo();
                                $listaPrestamo = $controllerPrestamo->show('Finalizado');

                                foreach($listaPrestamo as $prestamoEnCurso){
                                    $nombreCompleto = $prestamoEnCurso['alumnonombre'] . ' ' . $prestamoEnCurso['appaterno'] . ' ' . $prestamoEnCurso['apmaterno'];

                            ?>

                                <tr>
                                    <th scope="row"><?php echo $prestamoEnCurso['idprestamo']; ?></th>
                                    <td><?php echo $prestamoEnCurso['nombre']; ?></td>
                                    <td><?php echo $nombreCompleto; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecinit']; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecfin']; ?></td>
                                    <td style="text-align: center"><?php echo $prestamoEnCurso['tipo']; ?></td>
                                    <td style="text-align: center">
                                            <?php 
                                                if($prestamoEnCurso['retraso'] == 1) 
                                                    echo 'Finalizado con Retraso';  
                                                else  
                                                    echo 'Finalizado'; 
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/SystemLibrary/prestamo/details?idPrestamo=<?php echo $prestamoEnCurso['idprestamo']; ?>" class="btn btn-outline-primary btn-sm">Detalles</a>
                                    </td>  
                                </tr>

                            <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>        
        </div>
    </div>
             
    <?php //require_once 'views/footer.php' ?>
</body>
</html>