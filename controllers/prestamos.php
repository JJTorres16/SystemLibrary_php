<?php

class Prestamos extends Controller {
    function __construct(){
        parent::__construct();
        //$this->view->mensaje = "Sección principal";
        $this->view->render('prestamos/index');
        //echo "<p>Nuevo controlador main</p>";
    }
}

?>