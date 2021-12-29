<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link rel="stylesheet" href="./public/css-owner/UpdateCover.css"-->
    <!--link rel="stylesheet" href="public/css/default.css"-->
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
                <div class="d-flex">
                    <input class="form-control" type="search" placeholder="Busca un libro" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>                    
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
        $catalogo = $conCatalogo->showAll();

    ?>

<<<<<<< HEAD
            <div class="row" style="margin-top:50px; margin-bottom:25px; margin-left: 110px;">

                <?php 
                    foreach($catalogo as $row) { 
                    $ruteCover = "./".$row->getPortada();
                ?>

                <div class="col-md-4" style="margin-bottom: 20px;">
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
                                            <a type="/SystemLibrary/prestamo/add?idLibro=<?php echo $row->getidLibros(); ?>&tipo=casa" class="btn btn-success btn-sm">A Casa</a>
                                            <a href="/SystemLibrary/prestamo/add?idLibro=<?php echo $row->getidLibros(); ?>&tipo=sala" class="btn btn-danger btn-sm">A Sala</a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
=======
    <div class="container" style="margin-left: 75px; margin-top:50px;">
        <?php 
            foreach($catalogo as $row) { 
            $ruteCover = "./".$row->getPortada();
        ?>

        <div class="card" style="width: 100%;">
            <div class="row no-gutters">    
                <div class="col-md-2">
                    <img src="<?php echo $ruteCover ?>" class="card-img-top" alt="" height="275px" width="50px" id="coverPhoto">
                </div>
                     
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row->getNombre() ?> 
                            <a type="submit" href="catalogo/edit?idLibro=<?php echo $row->getidLibros(); ?>" class="btn btn-primary btn-sm">Editar</a>
                        </h5>                                                       
                        <p class="card-text"><?php echo $row->getSinopsis() ?></p>
                        <p class="card-title"> <b>Autor:</b> <?php echo $row->getAutor() ?></p>
                        <p class="card-title"> <b>Año:</b> <?php echo $row->getAnio() ?></p>

                            <?php if($row->getCantidad() >= 4) { ?>
                                <a type="/SystemLibrary/prestamo/add?idLibro=<?php echo $row->getidLibros(); ?>&tipo=casa" class="btn btn-success btn-sm">A Casa</a>                       
                            <?php } ?>

                        <a href="/SystemLibrary/prestamo/add?idLibro=<?php echo $row->getidLibros(); ?>&tipo=sala" class="btn btn-danger btn-sm">A Sala</a>
>>>>>>> c60a273d16728295ea8c606455f27d65b4c655ba
                    </div>
                </div>
            </div>
        </div><br>

                <?php
        
                    }

<<<<<<< HEAD
                ?>
                
            </div> 
=======
            ?>

    </div>
>>>>>>> c60a273d16728295ea8c606455f27d65b4c655ba

    
    <?php //require 'views/footer.php'; ?>
</body>
</html