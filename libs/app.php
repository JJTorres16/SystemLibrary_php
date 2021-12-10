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