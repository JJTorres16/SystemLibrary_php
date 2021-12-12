<?php

class Alumno extends Controller {
    function __construct(){
        parent::__construct();      
    }

    function irVistaMain(){
        $this->view->render('alumno/index');
    }

    function irVistaAdd(){
        $this->view->render('alumno/add');
    }

    function irVistaEdit(){
        $this->view->render('alumno/edit');
    }
}
?>