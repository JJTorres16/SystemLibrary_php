<?php

include_once  'libs/controller.php';

class Errors extends Controller {

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "Hubo un error en la solicitud o no existe la página";        
        //echo "<p>Error al cargar recurso</p>";
    }

    function irVistaMain(){
        $this->view->render('error/index');
    }
}
?>