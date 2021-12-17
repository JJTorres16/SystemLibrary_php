<?php

    class Categoria extends Controller{
        function __construct(){
            parent:: _construct();
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
    }

?>