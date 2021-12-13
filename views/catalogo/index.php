<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link rel="stylesheet" href="public/css/default.css"-->
    <title>Catálogo de Libros</title>
</head>
<body>
    <?php require 'views/header.php'; ?>

    <div class="d-flex felx-row justify-content-center align-items-center" style="margin-top:50px">
        <h1>Catálogo de libros</h1><br>
    </div>
    <div class="d-flex felx-row justify-content-center align-items-center">
            <small class="text-muted">Edita libros o añade nuevos al stock</small>
    </div><br>
      
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="d-flex">
                    <input class="form-control" type="search" placeholder="Busca un libro" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>                    
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <br><a href="catalogo/add" class="btn" style="background-color:#8F3A84; color:white">Agrega nuevo libro</a>
                </div>
            </div>         
        </div>
    </div>

    <div class="container" style="margin-top:25px; margin-left:125px">
        <div class="row justify-content-center">
            <div class="row" style="margin-top:25px; margin-bottom:25px;">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Túneles <a href="catalogo/edit" class="btn btn-primary btn-sm">Editar</a></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/SystemLibrary/prestamo/add?idLibro=1&tipo=casa" class="btn btn-success btn-sm">A Casa</a>
                            <a href="/SystemLibrary/prestamo/add?idLibro=1&tipo=sala" class="btn btn-danger btn-sm">A Sala</a>
                        </div>
                    </div>
                </div>       
            </div>
        </div>    
    </div>
    
    <?php //require 'views/footer.php'; ?>     
</body>
</html>