<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de alumnos</title>
</head>
<body>

    <?php require_once 'views/header.php' ?>

    <div class="d-flex felx-row justify-content-center align-items-center" style="margin-top:50px">
        <h1>Alumnos registrados</h1><br>
    </div>

    <div class="container" style="margin-top:25px">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="/SystemLibrary/alumno/" method="GET">
                    <div class="d-flex">
                        <input class="form-control" type="search" name="noControl" placeholder="Busca alumno" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>   
                </form>                 
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <br><a href="alumno/add" class="btn" style="background-color:#8F3A84; color:white">Dar alumno de alta</a>
                </div>
            </div>         
        </div>
    </div>

    <?php

        if(isset($_GET['noControl']))
            $noControl = $_GET['noControl'];
        else
            $noControl = "";
    
        // Creamos dos objetos: Un objeto $modeloAlumno:
        $contAlumno = new Alumno();
        $alumnos = $contAlumno->show($noControl);

    ?>

    <div class="container" style="margin-top:75px">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" width="15%">No. de Control</th>
                    <th scope="col" width="22%">Nombre</th>
                    <th scope="col" width="17%">Carrera</th>
                    <th scope="col" width="21">E-mail</th>
                    <th scope="col" width="16%">Tel</th>
                    <th scope="col" width="12%">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                foreach($alumnos as $alumno){
                    $nombreCompleto = $alumno->getApellidoPaterno() . " " . $alumno->getApellidoMaterno() . " " . $alumno->getNombre();
            ?>

                <tr>
                    <th scope="row"><?php echo $alumno->getNoControl() ?></th>
                    <td><?php echo $nombreCompleto ?></td>
                    <td><?php echo $alumno->getCarrera() ?></td>
                    <td><?php echo $alumno->getEmail() ?></td>
                    <td><?php echo $alumno->getTelefono() ?></td>
                    <td>
                        <a href="/SystemLibrary/alumno/edit?noControl=<?php echo $alumno->getNoControl() ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                        <a href="/SystemLibrary/prestamo/detail?noControl=<?php echo $alumno->getNoControl() ?>" class="btn btn-outline-success btn-sm">Historial</a>
                    </td>
                </tr>
            <?php 
                }
            ?>

            </tbody>    
        </table>
    </div>

    <?php //require_once 'views/footer.php' ?>
</body>
</html>