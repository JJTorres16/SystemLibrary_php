<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de alumnos</title>
</head>
<body>
    <?php require 'views/header.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Edición de alumnos</h2>
        <small class="text-muted">Modifica los datos de los alumnos</small>    
    </div><br>

    <div class="container" style="margin-top:15px;">
        <form action="/SystemLibrary/alumno" class="row g-3">
            <div class="col-md-4">
                <label for="txtPaternoAlumno" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="txtPaternoAlumno" name="txtPaternoAlumno" required >
            </div>
            <div class="col-md-4">
                <label for="txtMaternoAlumno" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="txtMaternoAlumno" name="txtMaternoAlumno" required>
            </div>
            <div class="col-md-4">
                <label for="txtNameAlumno" class="form-label">Nombre(s):</label>
                <input type="text" class="form-control" id="txtNameAlumno" name="txtNameAlumno" required>
            </div>
            <div class="col-md-4">
                <label for="txtNCAlumno" class="form-label">Número de control:</label>
                <input type="text" class="form-control" id="txtNCAlumno" name="txtNCAlumno" required>
            </div>
            <div class="col-md-4">
                <label for="txtTelAlumno" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="txtTelAlumno" name="txtTelAlumno" required>
            </div>
            <div class="col-md-4">
                <label for="txtEmailAlumno" class="form-label">E-mail:</label>
                <input type="text" class="form-control" id="txtEmailAlumno" name="txtEmailAlumno" required>
            </div>
            <div class="col-md-4">
                <label for="txtCarreraAlumno" class="form-label">Carrera:</label>
                <select name="txtCarreraAlumno" id="txtFormatSelect" class="form-select" required>
                    <option value="Ingenieria Electrónica">Ingenieria Electrónica</option>
                    <option value="Ingenieria Eléctrica">Ingenieria Eléctrica</option>
                    <option value="Ingeniera en Sistema">Ingeniera en Sistemas</option>
                    <option value="Ingenieria Química">Ingenieria Química</option>
                    <option value="Ingenieria Mecánica">Ingenieria Mecánica</option>
                    <option value="Ingenieria Industria">Ingenieria Industria</option>
                    <option value="Ingenieria en Gestión Empresarial">Ingenieria en Gestión Empresarial</option>                    
                </select>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-6">
                <label for="txtSexoAlumno" class="form-label">Sexo:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="txtSexoAlumno" name="txtSexoAlumno" value="Hombre">
                    <label for="txtSexoAlumno" class="form-check-label">
                        Hombre
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="txtSexoAlumno" name="txtSexoAlumno" value="Mujer">
                    <label for="txtSexoAlumno" class="form-check-label">
                        Mujer
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="txtSexoAlumno" name="txtSexoAlumno" value="No Binario">
                    <label for="txtSexoAlumno" class="form-check-label">
                        No binario
                    </label>
                </div>
                <div class="col-md-6">
                    <span><br></span>
                </div>
                <div>
                    <button class="btn btn-success" type="submit">Dar de alta</button>
                    <a class="btn btn-danger" href="/SystemLibrary/alumno">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <?php //require 'views/footer.php' ?>
</body>
</html>