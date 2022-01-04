<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/js-own/formularios.js"></script>
    <title>Alta de alumnos</title>
</head>
<body>
    <?php require 'views/header.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Edición de datos del alumnos</h2>
        <small class="text-muted">Modifica los datos de los alumnos</small>    
    </div><br>

    <?php 
    
        $noControl = $_GET['noControl'];
        
        $modeloAlumno = new Alumno();
        $alumno = $modeloAlumno->show($noControl);

        foreach($alumno as $dataAlumno){

    ?>

    <div class="container" style="margin-top:15px;">

        <form action="/SystemLibrary/alumno/eliminar" class="row g-3" id="formBajaAlumno" name="formBajaAlumno" method="POST" onsubmit="return confirmaBajaLogicaAlumnos(this);">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <input hidden type="text" id="txtnoControlBaja" name="txtnoControlBaja" value="<?php echo $dataAlumno -> getNoControl(); ?>">
                <input hidden type="text" id="txtNombreAlumno" name="txtNombreAlumno" value="<?php echo $dataAlumno -> getNombre(); ?>">
                <input hidden type="text" id="txtApPaterno" name="txtApPaterno" value="<?php echo $dataAlumno -> getApellidoPaterno(); ?>">
                <input hidden type="text" id="txtApMaterno" name="txtApMaterno" value="<?php echo $dataAlumno -> getApellidoMaterno(); ?>">
                <?php if($dataAlumno->getHabilitado()) { ?>
                    <button type="submit" class="btn btn-danger" style="margin-left:20px">Borrar</button>

                <?php } else { ?>
                    <button type="submit" class="btn btn-danger" style="margin-left:20px" disabled>Borrar</button>

                <?php } ?>
            </div>
        </form>

        <form name="formEditAlumno" action="/SystemLibrary/alumno/editar" class="row g-3" method="POST" onsubmit="return confirmaCambiosAlumno(this);">

            <div class="col-md-4">
                <label for="txtPaternoAlumno" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="txtPaternoAlumno" name="txtPaternoAlumno" value="<?php echo $dataAlumno->getApellidoPaterno(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtMaternoAlumno" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="txtMaternoAlumno" name="txtMaternoAlumno" value="<?php echo $dataAlumno->getApellidoMaterno(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtNameAlumno" class="form-label">Nombre(s):</label>
                <input type="text" class="form-control" id="txtNameAlumno" name="txtNameAlumno" value="<?php echo $dataAlumno->getNombre(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtNCAlumno" class="form-label">Número de control:</label>
                <input type="text" class="form-control" id="txtNCAlumno" name="txtNCAlumno" value="<?php echo $dataAlumno->getNoControl(); ?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="txtTelAlumno" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="txtTelAlumno" name="txtTelAlumno" value="<?php echo $dataAlumno->getTelefono(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtEmailAlumno" class="form-label">E-mail:</label>
                <input type="text" class="form-control" id="txtEmailAlumno" name="txtEmailAlumno" value="<?php echo $dataAlumno->getEmail(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtCarreraAlumno" class="form-label">Carrera:</label>
                <select name="txtCarreraAlumno" id="txtFormatSelect" class="form-select" required>
                    <option value="Ingenieria Electrónica" <?php if ($dataAlumno->getCarrera() == "Ingenieria Electrónica"){ ?> selected=selected <?php } ?> >Ingeniería Electrónica</option>
                    <option value="Ingenieria Eléctrica" <?php if ($dataAlumno->getCarrera() == "Ingenieria Eléctrica"){ ?> selected=selected <?php } ?>>Ingeniería Eléctrica</option>
                    <option value="Ingenieria en Sistemas" <?php if ($dataAlumno->getCarrera() == "Ingenieria en Sistemas"){ ?> selected=selected <?php } ?>>Ingeniería en Sistemas</option>
                    <option value="Ingenieria Química" <?php if ($dataAlumno->getCarrera() == "Ingenieria Química"){ ?> selected=selected <?php } ?>>Ingeniería Química</option>
                    <option value="Ingenieria Mecánica" <?php if ($dataAlumno->getCarrera() == "Ingenieria Mecánica"){ ?> selected=selected <?php } ?>>Ingeniería Mecánica</option>
                    <option value="Ingenieria Industrial" <?php if ($dataAlumno->getCarrera() == "Ingenieria Industrial"){ ?> selected=selected <?php } ?>>Ingeniería Industrial</option>
                    <option value="Ingenieria en Gestión Empresarial" <?php if ($dataAlumno->getCarrera() == "Ingenieria en Gestión Empresarial"){ ?> selected=selected <?php } ?>>Ingeniería en Gestión Empresarial</option>                    
                </select>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-6">
                <label for="txtSexoAlumno" class="form-label">Sexo:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="txtSexoAlumno" name="txtSexoAlumno" value="Hombre" <?php if ($dataAlumno->getSexo() == "Hombre"){ ?> checked <?php } ?> >
                    <label for="txtSexoAlumno" class="form-check-label">
                        Hombre
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="txtSexoAlumno" name="txtSexoAlumno" value="Mujer" <?php if ($dataAlumno->getSexo() == "Mujer"){ ?> checked <?php } ?> >
                    <label for="txtSexoAlumno" class="form-check-label">
                        Mujer
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="txtSexoAlumno" name="txtSexoAlumno" value="No Binario" <?php if ($dataAlumno->getSexo() == "No Binario"){ ?> checked <?php } ?> >
                    <label for="txtSexoAlumno" class="form-check-label">
                        No binario
                    </label>
                </div>
                <div class="col-md-6">
                    <span><br></span>
                </div>

                <?php 
                
                }

                ?>

                <div>
                    <button class="btn btn-success" type="submit">Modificar</button>
                    <a class="btn btn-warning" href="/SystemLibrary/alumno">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <?php //require 'views/footer.php' ?>
</body>
</html>