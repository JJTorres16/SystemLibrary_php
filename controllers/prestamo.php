<?php

class Prestamo extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->render('prestamo/index');
    }
}

?>