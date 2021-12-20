<?php

    include_once("libs/Conexion.php");

    class Model{

        function __construct(){}

        function getConnection(){
            return Conexion::conexionBD();
        }
    }
?>