<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de libros</title>
</head>
<body>
    <?php require 'views/header.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Alta de material bibliográfico</h2>
        <small class="text-muted">Añade nuevos libros al sotck</small>    
    </div><br>

    <div class="container" style="margin-top:15px;">
        <form action="" class="row g-3" method="post">
            <div class="col-md-4">
                <label for="txtNameBook" class="form-label">Nombre del libro:</label>
                <input type="text" class="form-control" id="txtNameBook" name="txtNameBook">
            </div>
            <div class="col-md-4">
                <label for="txtAuthorBook" class="form-label">Nombre del autor:</label>
                <input type="text" class="form-control" id="txtAuthorBook" name="txtAuthorBook">
            </div>
            <div class="col-md-4">
                <label for="txtISBNBook" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="txtISBNBook" name="txtISBNBook">
            </div>
            <div class="col-md-4">
                <label for="txtFormatBook" class="form-label">Formato:</label>
                <select name="txtFormatSelect" id="txtFormatSelect" class="form-select">
                    <option value="PastaDura">Pasta dura</option>
                    <option value="PataBlanda">Pasta blanda</option>
                    <option value="Revista">Revista</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="txtLenguageBook" class="form-label">Idioma:</label>
                <select name="txtLenguageBook" id="txtLenguageBook" class="form-select">
                    <option value="Español">Español</option>
                    <option value="Ingles">Ingles</option>
                    <option value="Aleman">Alemán</option>
                </select> 
            </div>
            <div class="col-md-2">
                <label for="txtEditionBook" class="form-label">Edicion:</label>
                <input type="text" class="form-control" id="txtEditionBook" name="txtEditionBook">
            </div>
            <div class="col-md-2">
                <label for="txtYearBook" class="form-label">Año:</label>
                <input type="text" class="form-control" id="txtYearBook" name="txtYearBook">
            </div>
            <div class="col-md-4">
                <label for="txtCategoryBook" class="form-label">Categoria</label>
                <input type="text" class="form-control" id="txtCategoryBook" name="txtCategoryBook">
            </div>
            <div class="col-md-2">
                <label for="txtPagesBook" class="form-label">Número de Páginas:</label>
                <input type="text" class="form-control" id="txtPagesBook" name="txtPagesBook">
            </div>
            <div class="col-md-2">
                <label for="txtTotalBook" class="form-label">Cantidad:</label>
                <input type="text" class="form-control" id="txtTotalBook" name="txtTotalBook">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <label for="fileImageBook" class="form-label">Portada:</label>
                <input type="file" class="form-control" id="fileImageBook" name="fileImageBook"><br>
                <!-- Se previsualiza la imágen -->
                <img src="" id="imgPortadaLibro" style="max-width:150px">
            </div><br>
            <div class="col-12">
                <span></span>
                <a href="/SystemLibrary/catalogo" class="btn btn-success">Agregar</a>
            </div>
        </form>
    </div>    

    <?php //require 'views/footer.php' ?>
</body>
    <script src="../public/js-own/preview-image.js"></script>
</html>