<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Préstamo de libro</title>
</head>
<body>
    <?php require 'views/header.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Alta de préstamos</h2>
        <small class="text-muted">Presta los libros a sala o a domicilio</small>    
    </div><br>

    <div class="container" style="margin-top:15px;">
        <form action="/SystemLibrary/alumno" class="row g-3">
            <div class="col-md-4">
                <label for="txtNombreLibro" class="form-label">Nombre del libro:</label>
                <input readonly type="text" class="form-control" id="txtNombreLibro" name="txtNombreLibro" value="Túneles">
            </div>
            <div class="col-md-4">
                <label for="txtISBNLibro" class="form-label">ISBN:</label>
                <input readonly type="text" class="form-control" id="txtISBNLibro" name="txtISBNLibro" value="978-8197-99-999-0">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for="txtNameAlumno" class="form-label">Número de control del estudiante:</label>
                <input type="text" class="form-control" id="txtNameAlumno" name="txtNameAlumno" required pattern="[0-9]{10}">
            </div>
            <div class="col-md-4">
                <label for="dateFechaInicio" class="form-label">Fecha de inicio de préstamo:</label>
                <input readonly type="date" class="form-control" id="dateFechaInicio" name="dateFechaInicio" requiered>
            </div>
            <div class="col-md-4">
                <label for="dateFinPrestamo" class="form-label">Fecha de retorno de libro:</label>
                <input readonly type="date" class="form-control" id="dateFinPrestamo" name="dateFinPrestamo" required>
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
        </form>
    </div>

    <?php //require 'views/footer.php' ?>
</body>
</html>