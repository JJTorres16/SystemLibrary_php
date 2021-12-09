<?php

class Alumno extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->render('alumno/index');
    }
}
?>