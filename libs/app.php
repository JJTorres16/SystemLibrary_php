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
               $controller -> {$url[1]}(); // Con los paréntesis se transforma esta línea a un método
           }

        } else {       
            $controller = new Errors(); 
        }      
     }
 }

?>