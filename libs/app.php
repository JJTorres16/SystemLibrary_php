<?php

require_once 'controllers/error.php';

 class App
 {
     function __construct(){
        //echo "<p>Nueva App</p>";

        $url = isset($_GET['url']) ? $_GET['url']: 'main';
        $url = rtrim($url, '/');
        $url = explode('/', $url);
         
        $archivoController = 'controllers/'.$url[0].'.php';

        if(file_exists($archivoController)){
           require_once $archivoController;
           $controller = new $url[0];

           if(isset($url[1])){
               if ($url[1] == 'add'){
                   $controller -> irVistaAdd();

               } elseif ($url[1] == 'edit'){
                   $controller -> irVistaEdit();

               } elseif($url[1] == 'details'){
                    $controller -> irVistaDetail();

               } elseif($url[1] == 'historial'){
                   $controller -> irVistaHistorial();

               } elseif($url[1] == 'agregar'){
                   $controller -> agregar();
                   
               } elseif($url[1] == 'editar'){
                   $controller -> editar();

               } elseif($url[1] == 'eliminar'){
                   $controller -> eliminar();

               } elseif($url[1] == 'refrendar'){
                   $controller -> refrendar();

               } elseif($url[1] == 'devolver'){
                   $controller -> devolver();

               } elseif($url[1] == 'reporte'){
                   $controller -> irVistaReporte();
               }

           } else {
               $controller -> irVistaMain();
           }

        } else {       
            $controller = new Errors(); 
        }      
     }
 }

?>