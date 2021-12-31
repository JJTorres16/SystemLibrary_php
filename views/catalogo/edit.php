<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/js-own/formularios.js"></script>
    <link rel="stylesheet" href="../public/css-owner/UpdateCover.css">
    <title>Edición de libros</title>
</head>
<body>

    <?php require_once 'views/header.php'; ?>

    <div class="container" style="margin-top:50px;">
        <h2>Edición de material bibligráfico</h2>
        <small class="text-muted">Edita o elimina libros del stock</small>    
    </div><br>

    <?php

        $idLibro = $_GET['idLibro'];

        $controllerCatalogo = new Catalogo();
        $libroSelect = $controllerCatalogo -> showDetail($idLibro);

        foreach($libroSelect as $libro) {
            $ruteCover = "../".$libro->getPortada();

    ?>

    <div class="container" style="margin-top:0px;">
        
        <form action="/SystemLibrary/catalogo/eliminar" class="row g-3" id="formBajaLibro" name="formBajaLibro" method="POST" onsubmit="return confirmaBajaLogica(this);">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <input hidden type="text" id="txtIdLibro" name="txtIdLibro" value="<?php echo $libro -> getidLibros(); ?>">
                <input hidden type="text" id="txtNameBook" name="txtNameBook" value="<?php echo $libro -> getNombre(); ?>">
                <?php if($libro->getCantidad() > 0) { ?>
                    <button type="submit" class="btn btn-danger" style="margin-left:20px">Borrar</button>

                <?php } else { ?>
                    <button type="submit" class="btn btn-danger" style="margin-left:20px" disabled>Borrar</button>

                <?php } ?>
            </div>
        </form>
        

        <form action="/SystemLibrary/catalogo/editar" enctype="multipart/form-data" class="row g-3" method="post" id="formCambioLibro" name="formCambioLibro" onsubmit="return confirmaCambios(this);">

            <div class="col-md-4">
                <input hidden type="text" name="txtIdLibro" value="<?php echo $libro -> getidLibros(); ?>">
                <label for="txtNameBook" class="form-label">Nombre del libro:</label>
                <input type="text" class="form-control" id="txtNameBook" name="txtNameBook" pattern="{5,50}" value="<?php echo $libro -> getNombre(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtAuthorBook" class="form-label">Nombre del autor:</label>
                <input type="text" class="form-control" id="txtAuthorBook" name="txtAuthorBook" pattern="{5,50}" required value="<?php echo $libro -> getAutor(); ?>">
            </div>
            <div class="col-md-4">
                <label for="txtISBNBook" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="txtISBNBook" name="txtISBNBook" pattern ="[0-9]{3}[-][0-9]{2}[-][0-9]{4}[-][0-9]{3}[-][0-9]{1}" value="<?php echo $libro -> getISBN(); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="txtFormatBook" class="form-label">Formato:</label>
                <select name="txtFormatSelect" id="txtFormatSelect" class="form-select" require>
                    <option value="PastaDura" <?php if($libro->getFormato() == "PastaDura"){ ?> selected="selected" <?php } ?>>Pasta dura</option>
                    <option value="PastaBlanda" <?php if($libro->getFormato() == "PastaBlanda"){ ?> selected="selected" <?php } ?>>Pasta blanda</option>
                    <option value="Revista" <?php if($libro->getFormato() == "Revista"){ ?> selected="selected" <?php } ?>>Revista</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="txtLenguageBook" class="form-label">Idioma:</label> 
                <select name="txtLenguageBook" id="txtLenguageBook" class="form-select">
                    <option value="Español" <?php if($libro->getIdioma() == "Español"){ ?> selected="selected" <?php } ?>>Español</option>
                    <option value="Ingles" <?php if($libro->getIdioma() == "Ingles"){ ?> selected="selected" <?php } ?>>Inglés</option>
                    <option value="Aleman" <?php if($libro->getIdioma() == "Aleman"){ ?> selected="selected" <?php } ?>>Alemán</option>
                    <option value="Otro" <?php if($libro->getIdioma() == "Otro"){ ?> selected="selected" <?php } ?>>Otro</option>
                </select> 
            </div>
            <div class="col-md-2">
                <label for="txtEditionBook" class="form-label">Edicion:</label>
                <input type="text" class="form-control" id="txtEditionBook" name="txtEditionBook" pattern="[0-9]" value="<?php echo $libro -> getEdicion(); ?>" required> 
            </div>
            <div class="col-md-2">
                <label for="txtYearBook" class="form-label">Año:</label>

                    <?php
                        $cont = date('Y');
                    ?>

                <select name="txtYearBook" id="txtYearBook" class="form-select">

                    <?php while($cont >= 1980) {
                        if($cont == $libro->getAnio()){  
                    
                    ?>
                            <option value="<?php echo($cont); ?>" selected=selected><?php echo($cont); ?></option>

                        <?php } else { ?>

                            <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>

                    <?php
                        }

                        $cont = ($cont-1); } 
                    ?>
                    
                </select>
            </div>
            <div class="col-md-4">
                <label for="txtCategoryBook" class="form-label">Categoria</label>
                <div class="input-group has-validation">
                    <select type="text" class="form-control" id="txtCategoryBook" name="txtCategoryBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1-\ ]{5,50}" required>

                    <?php
                        
                        /*
                            NOTA:
                            Aquí no se vuelve a delcarar un objeto de la clase Categoria, porque en el header ya se declaró uno,
                            Al usar el 'require_once 'views/header.php' se inserta todo el código de ese archivo en este, y por lo tanto
                            es como si el objeto que usamos en ese código estuviera escrito aquí también. Es por ello que el objeto $categoria
                            puede ser usado en el foreach sin problema alguno. 
                        */
                
                        foreach($categorias as $row){
                            if($row->getId() == $libro->getCategoria()){
    
                    ?>

                            <option value="<?php echo $row->getId() ?>" selected=selected><?php echo $row->getCategoria() ?></option>

                        <?php } else { ?>

                            <option value="<?php echo $row->getId() ?>"><?php echo $row->getCategoria() ?></option>

                    <?php 

                       } 
                    } 
                    
                    ?>

                    </select>
                    <span class="input-group-text" id="inputGroupPrepend">
                        <a href="" style="text-decoration:none; color:#413C41" data-bs-toggle="modal" data-bs-target="#agregaCategoria">Agregar</a>
                    </span>
                </div>    
            </div>
            <div class="col-md-4">
                <label for="txtEditorialBook" class="form-label">Editorial</label>
                <input type="text" class="form-control" id="txtEditorialBook" name="txtEditorialBook" pattern="{1,50}" value="<?php echo $libro -> getEditorial(); ?>" required>
            </div>
            <div class="col-md-2">
                <label for="txtPagesBook" class="form-label">Número de Páginas:</label>
                <input type="text" class="form-control" id="txtPagesBook" name="txtPagesBook" pattern="[0-9]{1,10}" value="<?php echo $libro -> getPaginas(); ?>" required>
            </div>
            <div class="col-md-2">
                <label for="txtTotalBook" class="form-label">Cantidad:</label>
                <input type="text" class="form-control" id="txtTotalBook" name="txtTotalBook" pattern="[0-9]{1,10}" value="<?php echo $libro -> getCantidad(); ?>" required>
            </div>
            <div class="col-md-4">
                <!--Se previsualiza la imágen -->
                <img src="<?php echo $ruteCover ?>" id="imgPortadaLibro" style="width: 60%; heigth:100%"><br>
                <input hidden type="file" accept="image/*" class="form-control" id="fileImageBook" name="fileImageBook"><br>
                <button type="button" onclick="defaultBtnActive();" id="btnChooseCover" name="btnChooseCover"><i class="fas fa-camera"></i></button>
            </div>
            <div class="col-8">
                <label for="txtAreaSinposis" class="form-label">Sinpósis:</label>
                <textarea class="md-textarea form-control" name="txtAreaSinposis" id="txtAreaSinposis" cols="30" rows="5" requiered pattern="{10,50}" ><?php echo $libro -> getSinopsis(); ?></textarea><br>
                <button class="btn btn-success" name="editar" type="submit">Guardar</button> 
                <a class="btn btn-warning" href="/SystemLibrary/catalogo">Cancelar</a>            
            </div>
            <div class="col-md-12"></div>

            <?php 

                }
            ?>

        </form>
    </div>
    </div>    

    <?php //require 'views/footer.php' ?>
    <script src="/SystemLibrary/public/js-own/buttonUpload.js"></script>                           
    <script src="/SystemLibrary/public/js-own/preview-image.js"></script>
</body>
</html>