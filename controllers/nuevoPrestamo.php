<?php

class NuevoPrestamo extends Controller{
    function __construct(){
        parent:: __construct();
        $this->view->render('nuevoPrestamo/index');
    }
}

?>