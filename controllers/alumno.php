<?php

class Alumno extends Controller {
    function __construct(){
        parent::__construct();      
    }

    function irVistaMain(){
        $this->view->render('alumno/index');
    }
}
?>