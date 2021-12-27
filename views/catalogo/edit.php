<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de libros</title>
</head>
<body>

    <?php require 'views/header.php' ?>
    <?php require 'controllers/categoria.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Edición de material bibligráfico</h2>
        <small class="text-muted">Edita o elimina libros del stock</small>    
    </div><br>

    <?php

        $idLibro = $_GET['idLibro'];

        $controllerCatalogo = new Catalogo();
        $libroSelect = $controllerCatalogo -> showDetail($idLibro);

    ?>

    <div class="container" style="margin-top:0px;">
        <form action="/SystemLibrary/catalogo/editar" class="row g-3" method="post">
            <div class="col-sm-11"></div>
            <div class="col-sm-1">
                <a class="btn btn-danger btn-sm" href="/SystemLibrary/catalogo">Eliminar</a>
            </div>

            <?php 

                    foreach($libroSelect as $libro) {

            ?>

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
                    <option value="PastaDura">Pasta dura</option>
                    <option value="PataBlanda">Pasta blanda</option>
                    <option value="Revista">Revista</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="txtLenguageBook" class="form-label">Idioma:</label> 
                <select name="txtLenguageBook" id="txtLenguageBook" class="form-select">
                    <option value="Español">Español</option>
                    <option value="Ingles">Inglés</option>
                    <option value="Aleman">Alemán</option>
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

                    <?php while($cont >= 1980) { ?>

                <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>

                    <?php $cont = ($cont-1); } ?>
                    
                </select>
            </div>
            <div class="col-md-4">
                <label for="txtCategoryBook" class="form-label">Categoria</label>
                <div class="input-group has-validation">
                    <select type="text" class="form-control" id="txtCategoryBook" name="txtCategoryBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1-\ ]{5,50}" required>

                    <?php
                        
                        $contCategoria = new Categoria(); // Controlador de las categorias
                        $categorias = $contCategoria->showAll();
                
                        foreach($categorias as $row){
    
                    ?>

                            <option value="<?php echo $row->getId() ?>"><?php echo $row->getCategoria() ?></option>

                    <?php } ?>

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
            <!--div class="col-md-4">
                <label for="fileImageBook" class="form-label">Portada:</label>
                <input type="file" accept="image/*" class="form-control" id="fileImageBook" name="fileImageBook" value="<?php //echo $ruteCover ?>" required><br>
                <Se previsualiza la imágen >
                <img src="<?php echo $ruteCover ?>" id="imgPortadaLibro" style="max-width:150px">
            </div-->
            <div class="col-8">
                <label for="txtAreaSinposis" class="form-label">Sinpósis:</label>
                <textarea class="md-textarea form-control" name="txtAreaSinposis" id="txtAreaSinposis" cols="30" rows="5" requiered pattern="{10,50}" ><?php echo $libro -> getSinopsis(); ?></textarea>
            </div>
            <div class="col-12">
                <span></span>
                <button class="btn btn-success" name="editar" type="submit">Editar</button> 
                <a class="btn btn-warning" href="/SystemLibrary/catalogo">Cancelar</a>
            </div>
            <div class="col-12"></div>

            <?php 

                }
            ?>

        </form>
    </div>
    </div>    

    <?php //require 'views/footer.php' ?>
    <script src="../public/js-own/preview-image.js"></script>
</body>
</html>