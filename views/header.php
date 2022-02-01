<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
</head>

<body>

    <?php

        session_start();
    
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #713269">
        <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="/SystemLibrary">BIBLIOTECA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Navegacion" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="Navegacion">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropDownCatalogoCategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catálogo</a>
                        <ul class="dropdown-menu" aria-labelledby="dropDownCatalogoCategoria">
                            <?php

                                $contCategoria = new Categoria();
                                $categorias = $contCategoria->showAll();

                                foreach($categorias as $categoria){
                                    $nameCategoria = $categoria->getCategoria();
                                    $nameCategoria = rtrim($nameCategoria, '/');
                                    $nameCategoria = explode('/', $nameCategoria);

                            ?>

                            <li><a href="/SystemLibrary/catalogo?categoria=<?php echo $categoria->getId() ?>&pag=0" class="dropdown-item"><?php echo $nameCategoria[1]; ?></a></li>
                            
                            <?php
                                }
                            ?>

                            <li><hr class="dropdown-divider"></li>
                            <li><a href="/SystemLibrary/catalogo?categoria=0&pag=0" class="dropdown-item">Todo</a></li>
                        
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/SystemLibrary/alumno">Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/SystemLibrary/prestamo">Préstamos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SystemLibrary/help" tabindex="-1" aria-disabled="true">Ayuda</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>   
    
</body>
</html>