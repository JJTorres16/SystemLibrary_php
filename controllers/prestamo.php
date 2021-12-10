<?php

class Prestamo extends Controller{
    function __construct(){
        parent::__construct();
    }

    function irVistaMain(){
        $this->view->render('prestamo/index');
    }

    function irVistaAdd(){
        $this->view->render('prestamo/add');
    }

    function irVistaEdit(){
        $this->view->render('prestamo/edit');
    }
}

?>