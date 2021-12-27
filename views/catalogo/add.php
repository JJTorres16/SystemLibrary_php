<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/js-own/formularios.js"></script>
    <title>Alta de libros</title>
</head>
<body>
    <?php require 'views/header.php' ?>
    <?php require 'controllers/categoria.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Alta de material bibliográfico</h2>
        <small class="text-muted">Añade nuevos libros al stock</small>    
    </div><br>

    <div class="container" style="margin-top:15px;">
        <form action="/SystemLibrary/catalogo/agregar" class="row g-3" method="post" enctype="multipart/form-data" id="formAltaLibro" name="formAltaLibro" onsubmit="return confirmaIngreso(this);" >
            <div class="col-md-4">
                <label for="txtNameBook" class="form-label">Nombre del libro:</label>
                <input type="text" class="form-control" id="txtNameBook" name="txtNameBook" pattern="{5,100}" required>
            </div>
            <div class="col-md-4">
                <label for="txtAuthorBook" class="form-label">Nombre del autor:</label>
                <input type="text" class="form-control" id="txtAuthorBook" name="txtAuthorBook" pattern="{5,100}" required>
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
                <input type="text" class="form-control" id="txtEditorialBook" name="txtEditorialBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1 ]{1,50}" required>
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
                <label for="fileImageBook" class="form-label">Portada:</label>
                <input type="file" accept="image/*" class="form-control" id="fileImageBook" name="fileImageBook" required><br>
                <!-- Se previsualiza la imágen -->
                <img src="" id="imgPortadaLibro" style="max-width:150px">
            </div>
            <div class="col-8">
                <label for="txtAreaSinposis" class="form-label">Sinpósis:</label>
                <textarea class="md-textarea form-control" name="txtAreaSinposis" id="txtAreaSinposis" cols="30" rows="5" requiered></textarea>
            </div>
            <div class="col-12">
                <span></span>
                <button class="btn btn-success" name="agregar" type="submit">Editar</button> 
                <a class="btn btn-danger" href="/SystemLibrary/catalogo">Cancelar</a>
            </div>
            <div class="col-12"></div>
        </form>
    </div>



<!-- Modal para agregar una nueva categoria-->
<div class="modal fade" id="agregaCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregaCategoriaHeader">Nueva Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="container">                
            <form action="/SystemLibrary/catalogo/add" class="row g-3" method="post">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="txtTotalBook" class="form-label">Nombre de la nueva categoria:</label>
                        <input type="text" class="form-control" id="txtTotalBook" name="txtTotalBook" pattern="[a-zA-ZÁ-ÿ\uf001\u00d1-\ ]{5,50}" required>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>                
    </div>
  </div>
</div>
    
    
    <?php //require 'views/footer.php' ?>                           
    <script src="../public/js-own/preview-image.js"></script>
</body>
</html>