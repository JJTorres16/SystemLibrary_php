<?php

    class Help extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "Sección de ayuda";
            $this->view->render('help/index');
        }
    }

?>