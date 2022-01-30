<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Reporte de préstamo</title>
</head>
<body>

    <?php require_once 'controllers/Prestamo.php' ?>

    <?php 
    
        if(isset($_GET['tipo']))
            $tipoPrestamo = $_GET['tipo'];
        else
            $tipoPrestamo = '';
    
    ?>

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <h3 class="navbar-brand" href="#">Reporte de préstamos a <?php echo $tipoPrestamo?></h3>
        </div>
    </nav>

    <?php 
    
    $controllerPrestamo = new Prestamo();
    $listaPrestamo = $controllerPrestamo->reportePrestamo();

    foreach($listaPrestamo as $prestamo){
        $ruteCover = "../".$prestamo['portada'];
        $nombreCompletoAlumno = $prestamo['appaterno'].' '.$prestamo['apmaterno'].' '.$prestamo['nombrealumno'];
        ?>

            <table class="table table-bordered" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                <thead>
                    <tr style="background-color: #B0BEC5;">
                        <th style="width:33%"><strong>ID del préstamo:</strong></th>
                        <th style="width:33%"><strong>Nombre del libro:</strong></th>
                        <th style="width:33%"><strong>ISBN:</strong></th>
                        <th style="width:33%"><strong>Autor:</strong></th>
                        <th style="width:33%"><strong>Categoria del libro:</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="width:33%"><?php echo $prestamo['idprestamo']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['nombrelibro']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['isbn']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['autor']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['categoria']; ?></td>
                    </tr>
                </tbody>
                
                <thead>
                    <tr style="background-color: #B0BEC5;">
                        <th style="width:33%"><strong>Nombre del alumno:</strong></th>
                        <th style="width:33%"><strong>Número de control:</strong></th>
                        <th style="width:33%"><strong>Carrera:</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="width:33%"><?php echo $nombreCompletoAlumno; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['alumnonocontrol']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['carrera']; ?></td>
                    </tr>
                </tbody>

                <thead>
                    <tr style="background-color: #B0BEC5;">
                        <th style="width:33%"><strong>Fecha de inicio:</strong></th>
                        <th style="width:33%"><strong>Fecha de devolción:</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="width:33%"><?php echo $prestamo['fecinit']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['fecfin']; ?></td>
                    </tr>
                </tbody>

                <thead>
                    <tr style="background-color: #B0BEC5;">
                        <th style="width:33%"><strong>Estado del préstamo:</strong></th>
                        <th style="width:33%"><strong>Total de refrendos:</strong></th>
                        <th style="width:33%"><strong>Observaciones:</strong></th>
                        <th style="width:33%"><strong>Formato del libro:</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="width:33%">
                            <?php 
                                if(($prestamo['retraso'] == 1) && ($prestamo['estado'] == 'Finalizado'))
                                    echo 'Finalizado con retraso';
                                else
                                    echo $prestamo['estado'];
                            ?>
                        </td>
                        <td  style="width:33%"><?php echo $prestamo['norefrendo']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['observaciones']; ?></td>
                        <td  style="width:33%"><?php echo $prestamo['formato']; ?></td>
                    </tr>
                </tbody>

            </table>
            <hr>
        <?php 
        
            }

        ?>    
</body>
</html>
