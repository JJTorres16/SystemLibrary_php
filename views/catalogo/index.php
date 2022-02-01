<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link rel="stylesheet" href="./public/css-owner/UpdateCover.css"-->
    <!--link rel="stylesheet" href="public/css/default.css"-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js-own/mensajes.js"></script>
    <title>Catálogo de Libros</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <?//php require 'controllers/catalogo.php' ?>

    <div class="d-flex felx-row justify-content-center align-items-center" style="margin-top:50px">
        <h1>Catálogo de libros</h1><br>
    </div>
    <div class="d-flex felx-row justify-content-center align-items-center">
            <small class="text-muted">Edita libros o añade nuevos al stock</small>
    </div><br>
  
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="" method="GET">
                    <div class="d-flex">
                        <input class="form-control" type="search" placeholder="Busca un libro" aria-label="Search" name="busqueda" id="busqueda">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </form>                    
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <br><a href="/SystemLibrary/catalogo/add" class="btn" style="background-color:#8F3A84; color:white">Agrega nuevo libro</a>
                </div>
            </div>         
        </div>
    </div>

    <?php


        $conCatalogo = new Catalogo();

        $totalPaginas = $conCatalogo->setCantPaginas();
        $catalogo = $conCatalogo->showAll();

        $categoria = $_GET['categoria'];
        $pag = $_GET['pag'];

        echo $pag;

    ?>

    <div class="row" style="margin-top:50px; margin-bottom:25px; margin-left: 200px;">

        <?php 
            foreach($catalogo as $row) { 
            $ruteCover = "./".$row->getPortada();
        ?>
    
   
        <div class="col-md-4" style="margin-bottom: 25px;">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $ruteCover ?>" class="card-img-top" alt="" height="400px" id="coverPhoto">
                <div class="accordion" id="accordionPannel">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panel-heading-<?php echo $row->getidLibros(); ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel-<?php echo $row->getidLibros(); ?>" aria-expanded="true" aria-controls="panel-<?php echo $row->getidLibros(); ?>">
                                Información:
                            </button>
                        </h2>
                        <div id="panel-<?php echo $row->getidLibros(); ?>" class="accordion-collapse collapse" aria-labelledby="panel-heading-<?php echo $row->getidLibros(); ?>">
                            <div class="accordion-body">     
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row->getNombre() ?> 
                                        <a type="submit" href="catalogo/edit?idLibro=<?php echo $row->getidLibros(); ?>" class="btn btn-primary btn-sm">Editar</a>
                                    </h5>                               
                                    <!--p class="card-text"><?php //echo $row->getSinopsis() ?></p--> 
                                    <p class="card-title"> <b>Autor:</b> <?php echo $row->getAutor() ?></p>
                                    <p class="card-title"> <b>Año:</b> <?php echo $row->getAnio() ?></p>
                                    <p class="card-title"> <b>ISBN:</b> <?php echo $row->getISBN() ?></p>
                                    <p></p>
    
                                    <?php  if($row->getCantidad() >= 4){ ?>

                                        <a href="/SystemLibrary/prestamo/add?idLibro=<?php echo $row->getidLibros(); ?>&tipo=casa" class="btn btn-success btn-sm">A Casa</a>
                                    
                                    <?php } ?>

                                    <a href="/SystemLibrary/prestamo/add?idLibro=<?php echo $row->getidLibros(); ?>&tipo=sala" class="btn btn-danger btn-sm">A Sala</a>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        
            }

        ?>

    </div>

    <nav aria-label="Page navigation example" style="margin-right: 25px;">
        <ul class="pagination justify-content-center" style="color:#8F3A84">
            <li <?php if($pag == 0){ ?> class="page-item disabled" <?php } else { ?> class="page-item" <?php } ?> >
                <a class="page-link" href="#" tabindex="-1" <?php if($pag == 0){ ?> aria-disabled="true" <?php } ?> style="color:#8F3A84">Previous</a>
            </li>

            <?php for ($i = ($pag + 1); $i < 5; $i++){ ?>
                <li class="page-item"><a class="page-link" href="/SystemLibrary/catalogo?categoria=<?php echo $categoria ?>&pag=0" style="color:#8F3A84"> <?php echo $i ?> </a></li>            
            
            <?php 
                    if($i == $totalPaginas)
                        break;                  
                } 
            
            ?>

                <li <?php if(($pag + 1) == $totalPaginas){ ?> class="page-item disabled" <?php } else { ?> class="page-item" <?php } ?> >
                 <a class="page-link" href="#" style="color:#8F3A84">Next</a>
            </li>
        </ul>
    </nav>

    <?php //require 'views/footer.php'; ?>
</body>
</html>