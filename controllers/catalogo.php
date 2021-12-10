<?php

class Catalogo extends Controller {

    function __construct(){
        
        parent::__construct();
        //$this->view->mensaje = "Sección principal";
        //$this->view->render('catalogo/index');
        //echo "<p>Nuevo controlador main</p>";
    }

    function irVistaMain(){
        $this->view->render('catalogo/index');
    }

    function irVistaAdd(){
        $this->view->render('catalogo/add');
    }

    function irVistaEdit(){
        $this->view->render('catalogo/edit');
    }
}

?>