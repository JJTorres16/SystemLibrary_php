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
                <div class="d-flex">
                    <input class="form-control" type="search" placeholder="Busca alumno" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>                    
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <br><a href="alumno/add" class="btn" style="background-color:#8F3A84; color:white">Dar alumno de alta</a>
                </div>
            </div>         
        </div>
    </div>

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
                <tr>
                    <th scope="row">15010878</th>
                    <td>Torres Velásquez Jesús Julián</td>
                    <td>Ingenieria Electrónica</td>
                    <td>juliantv_416@outlook.com</td>
                    <td>272-131-56-60</td>
                    <td>
                        <a href="alumno/edit" class="btn btn-outline-primary btn-sm">Editar</a>
                        <a href="#" class="btn btn-outline-success btn-sm">Historial</a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">15010830</th>
                    <td>Jiménez Palacios Samantha Vianey</td>
                    <td>Ingenieria Electrónica</td>
                    <td>samantha.vj20@gmail.com</td>
                    <td>272-572-27-48</td>
                    <td>
                        <a href="alumno/edit" class="btn btn-outline-primary btn-sm">Editar</a>
                        <a href="#" class="btn btn-outline-success btn-sm">Historial</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php //require_once 'views/footer.php' ?>
</body>
</html>