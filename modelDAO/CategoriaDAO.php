<?php

require_once('libs/model.php');
require_once('models/ModeloCatalogo.php');

class CategoriaDAO extends Model{

    function show(){

        $query = parent::getConnection()->prepare("SELECT * FROM categoria");
        $query->execute();

        $listaCategoria = $query->fetchAll();

        return $listaCategoria;

    }

}

?>