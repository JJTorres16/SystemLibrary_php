<?php

    class Help extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "Sección de ayuda";          
        }

        function irVistaMain(){
            $this->view->render('help/index');
        }
    }

?>