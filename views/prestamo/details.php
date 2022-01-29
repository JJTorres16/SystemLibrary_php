<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de préstamo</title>
</head>
<body>

    <?php require_once 'views/header.php' ?>
    <?php require_once 'controllers/Prestamo.php' ?>

    <div class="container" style="margin-top:50px">
        <h3>Detalles del préstamo</h3>
        <small class="text-muted">Se mostrarán los detalles específicos del préstamo seleccionado</small>
    </div>

    <div class="container">

    <?php 
    
        $controllerPrestamo = new Prestamo();
        $prestamoSeleccionado = $controllerPrestamo->consultaDetalles();

        foreach($prestamoSeleccionado as $prestamo){
            $ruteCover = "../".$prestamo['portada'];
            $nombreCompletoAlumno = $prestamo['appaterno'].' '.$prestamo['apmaterno'].' '.$prestamo['nombrealumno'];
    ?>

        <div class="container bcontent">
            <hr>
            <div class="card" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-sm-3">
                        <img src="<?php echo $ruteCover ?>" class="card-img-top" alt="" height="100%" id="coverPhoto">  
                    </div>
                    <div class="col-sm-9">
                        <div class="card-body">
                           <div class="row" style="margin-top: 20px;">
                                <div class="col">
                                    <label for="" class="form-label"><strong>ID del préstamo:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Nombre del libro:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>ISBN:</strong></label>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <?php echo $prestamo['idprestamo'] ?>
                                </div>
                                <div class="col">
                                    <?php echo $prestamo['nombrelibro'] ?>
                                </div>
                                <div class="col">
                                    <?php echo $prestamo['isbn'] ?>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <label for="" class="form-label"><strong>Autor:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Categoría del libro:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Formato del libro:</strong></label>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <?php echo $prestamo['autor'] ?>
                                </div>
                                <div class="col">
                                    <?php echo $prestamo['categoria'] ?>
                                </div>
                                <div class="col">
                                    <?php echo $prestamo['formato'] ?>
                                </div>
                           </div>
                           <hr>
                           <div class="row" style="margin-top: 20px;">
                                <div class="col">
                                    <label for="" class="form-label"><strong>Nombre del alumno:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Número de control:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Carrera:</strong></label>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <?php echo $nombreCompletoAlumno ?>
                                </div>
                                <div class="col">
                                    <?php echo $prestamo['alumnonocontrol'] ?>
                                </div>
                                <div class="col">
                                    <?php echo $prestamo['carrera'] ?>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <label for="" class="form-label"><strong>Fecha de inicio préstamo:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Fecha de devolución:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Estado del préstamo:</strong></label>
                                </div>
                           </div>
                           <div class="row">
                               <div class="col">
                                    <?php echo $prestamo['fecinit'] ?>
                               </div>
                               <div class="col">
                                    <?php echo $prestamo['fecfin'] ?>
                               </div>
                               <div class="col">
                                    <?php 
                                        if(($prestamo['retraso'] == 1) && ($prestamo['estado'] == 'Finalizado'))
                                            echo 'Finalizado con retraso';
                                        else
                                            echo $prestamo['estado'];
                                    ?>
                               </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <label for="" class="form-label"><strong>Observaciones:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Tipo de préstamo:</strong></label>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label"><strong>Total de refrendos:</strong></label>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col">
                                    <?php echo $prestamo['observaciones'] ?>
                               </div>
                               <div class="col">
                                    <?php echo $prestamo['tipo'] ?>
                               </div>
                               <div class="col">
                                    <?php echo $prestamo['norefrendo'] ?>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        
            }

        ?>

    </div>

    <div class="container" style="margin-top: 25px;">
        <a href="javascript: history.go(-1)" class="btn btn-primary">Regresar</a>
    </div>
    
</body>
</html>