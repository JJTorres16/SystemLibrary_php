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

    <div class="container" style="margin-top:50px">
        <h3>Jesús Julián Torres Velásquez</h3>
        <small class="text-muted">Historial de préstamos</small>
    </div>

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
                <tr>
                    <th scope="row">1</th>
                    <td>Túenes</td>
                    <td>Ficción/Aventura</td>
                    <td>12-12-2021</td>
                    <td>16-12-2021</td>
                    <td>0</td>
                    <td>Sí</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Fundamentos de Java</td>
                    <td>Ingeniería/Programación</td>
                    <td>18-12-2021</td>
                    <td>21-12-2021</td>
                    <td>0</td>
                    <td>No</td>
                </tr>
            </tbody>
        </table>
        <a href="/SystemLibrary/alumno" class="btn btn-primary">Regresar</a>
    </div>

    <?php //require_once 'views/footer.php' ?>
</body>
</html>