<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php require 'views/header.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Edición de libros</h2>
        <small class="text-muted">Haz las correcciones necesarias</small>    
    </div><br>

    <div class="container" style="margin-top:15px;">
        <form action="/SystemLibrary/catalogo" class="row g-3" method="post">
            <div class="col-md-4">
                <label for="txtNameBook" class="form-label">Nombre del libro:</label>
                <input type="text" class="form-control" id="txtNameBook" name="txtNameBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1 ]{5,50}" required>
            </div>
            <div class="col-md-4">
                <label for="txtAuthorBook" class="form-label">Nombre del autor:</label>
                <input type="text" class="form-control" id="txtAuthorBook" name="txtAuthorBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1 ]{5,50}" required>
            </div>
            <div class="col-md-4">
                <label for="txtISBNBook" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="txtISBNBook" name="txtISBNBook" pattern ="[0-9]{3}[-][0-9]{2}[-][0-9]{4}[-][0-9]{3}[-][0-9]{1}" required>
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
                <input type="text" class="form-control" id="txtEditionBook" name="txtEditionBook" pattern="[0-9]" required> 
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
                    <input type="text" class="form-control" id="txtCategoryBook" name="txtCategoryBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1-\ ]{5,50}" required>
                    <span class="input-group-text" id="inputGroupPrepend"><a href="" style="text-decoration:none; color:#413C41">Agregar</a></span>
                </div>    
            </div>
            <div class="col-md-2">
                <label for="txtPagesBook" class="form-label">Número de Páginas:</label>
                <input type="text" class="form-control" id="txtPagesBook" name="txtPagesBook" pattern="[0-9]{1,10}" required>
            </div>
            <div class="col-md-2">
                <label for="txtTotalBook" class="form-label">Cantidad:</label>
                <input type="text" class="form-control" id="txtTotalBook" name="txtTotalBook" pattern="[0-9]{1,10}" required>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <label for="fileImageBook" class="form-label">Portada:</label>
                <input type="file" accept="image/*" class="form-control" id="fileImageBook" name="fileImageBook" required><br>
                <!-- Se previsualiza la imágen -->
                <img src="" id="imgPortadaLibro" style="max-width:150px">
            </div><br>
            <div class="col-12">
                <span></span>
                <button class="btn btn-success" type="submit">Modificar</button> 
                <a class="btn btn-danger" href="/SystemLibrary/catalogo">Cancelar</a>
            </div>
        </form>
    </div>    

    <?php //require 'views/footer.php' ?>
</body>
</html>