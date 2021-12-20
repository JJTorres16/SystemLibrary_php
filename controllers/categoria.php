<?php

    class Categoria extends Controller{

        function __construct(){
            parent::__construct();
        }

        function irVistaMain(){
            $this->view->render('categoria/index');
        }
    
        function irVistaAdd(){
            $this->view->render('categoria/add');
        }
    
        function irVistaEdit(){
            $this->view->render('categoria/edit');
        }

        function showAll(){
            
            // Importamos los paquetes que se necesitan
            require ('modelDAO/CategoriaDAO.php');
            require ('models/ModeloCategoria.php');

            $listaCategoria = array();
            $catDAO = new CategoriaDAO();

            $queryCategorias =  $catDAO->show();

            foreach($queryCategorias as $row){
                $modelCat = new ModeloCategoria();
                $modelCat -> setId($row['id_']);
                $modelCat -> setCategoria($row['categoria']);
                array_push($listaCategoria, $modelCat);
                //echo $row['id_'].'-'.$row['categoria'].'<br>';
            }

            return $listaCategoria;
        }
    }

?>