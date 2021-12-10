<?php

class Main extends Controller {
    function __construct(){
        parent::__construct();
        //$this->view->mensaje = "Sección principal";    
        //echo "<p>Nuevo controlador main</p>";
    }

    function irVistaMain(){
        $this->view->render('main/index');
    }
}

?>