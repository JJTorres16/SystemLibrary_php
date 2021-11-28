<?php

    class View{

        function __construct(){
            //echo "<p>Vista base</p>";
        }

        function render($nombre){
            require 'views/'.$nombre.'.php'; // Cargar la vista que se le indique en el nombre
        }
    }
?>