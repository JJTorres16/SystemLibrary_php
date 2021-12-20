<?php

class Controller{

    function __construct(){
        //echo "<p>Controlador base</p>";
        $this->view = new View();
        
        include_once("libs/Conexion.php");
        Conexion::conexionBD();

    }

}

?>