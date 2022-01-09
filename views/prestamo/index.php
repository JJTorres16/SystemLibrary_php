<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <div class="container" style="margin-top:25px">
        <h5> <small class="text-muted"> Seleccione el tipo de registro que desea consultar </small> </h5>
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
                                    <th scope="col" width="22%">Alumno</th>
                                    <th scope="col" width="12%">Fec. Inicio</th>
                                    <th scope="col" width="12%">Fec. Entrega</th>
                                    <th scope="col" width="14%" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
    
                                $controllerPrestamo = new Prestamo();
                                $listaPrestamo = $controllerPrestamo->show('En curso', 'Retrasado');

                                foreach($listaPrestamo as $prestamoEnCurso){
                                    $nombreCompleto = $prestamoEnCurso['alumnonombre'] . ' ' . $prestamoEnCurso['appaterno'] . ' ' . $prestamoEnCurso['apmaterno'];

                            ?>

                                <tr>
                                    <th scope="row"><?php echo $prestamoEnCurso['idprestamo']; ?></th>
                                    <td><?php echo $prestamoEnCurso['nombre']; ?></td>
                                    <td><?php echo $nombreCompleto; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecinit']; ?></td>
                                    <td><?php echo $prestamoEnCurso['fecfin']; ?></td>
                                    <td>
                                        <!-- Código para deshabilitar un link -->
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                            <a href="alumno/edit" class="btn btn-outline-success btn-sm" style="cursor: not-allowed; pointer-events: none;">Refrendar</a>
                                            <a href="alumno/edit" class="btn btn-outline-primary btn-sm" style="cursor: not-allowed; pointer-events: none;">Devolver</a>
                                        </span>
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
                                    <th scope="col" width="12%">Refrendar</th>
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
                                    <td>
                                        <!-- Código para deshabilitar un link -->
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                            <a href="alumno/edit" class="btn btn-outline-success btn-sm" style="cursor: not-allowed; pointer-events: none;">Refrendar</a>
                                        </span>
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