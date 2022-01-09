<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de préstamos</title>
</head>
<body>

    <?php require_once 'views/header.php' ?>
    <?php require_once 'controllers/Prestamo.php' ?>
    <?php require_once 'controllers/alumno.php' ?>

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
    <h5>Historial de préstamos</h5>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="5%">Id</th>
                    <th scope="col" width="25%">Libro</th>
                    <th scope="col" width="20%">Categoria</th>
                    <th scope="col" width="15%">Fec. inicio</th>
                    <th scope="col" width="15">Fec. entrega</th>
                    <th scope="col" width="10%">Refrendos</th>
                    <th scope="col" width="10%">Retardo</th>
                </tr>
            </thead>
            <tbody>

            <?php 
    
                $controllerPrestamo = new Prestamo();
                $listaPrestamo = $controllerPrestamo->show();

                foreach($listaPrestamo as $prestamosHistorial){
            ?>

                <tr>
                    <th scope="row"><?php echo $prestamosHistorial['idprestamo']; ?></th>
                    <td><?php echo $prestamosHistorial['nombre']; ?></td>
                    <td><?php echo $prestamosHistorial['categoria']; ?></td>
                    <td><?php echo $prestamosHistorial['fecinit']; ?></td>
                    <td><?php echo $prestamosHistorial['fecfin']; ?></td>
                    <td><?php echo $prestamosHistorial['norefrendo']; ?></td>
                    <td><?php if ($prestamosHistorial['estado'] == 'Retrasado'){ ?> Sí <?php } else { ?> No <?php } ?></td>
                </tr>

                <?php } ?>

            </tbody>
        </table>
        <a href="/SystemLibrary/alumno" class="btn btn-primary">Regresar</a>
    </div>

    <?php //require_once 'views/footer.php' ?>
</body>
</html>