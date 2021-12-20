<?php

require_once('libs/model.php');
require_once('models/ModeloCatalogo.php');

class CategoriaDAO extends Model{

    function show(){

        $query = "SELECT * FROM categoria";

        return parent::getConnection()->query($query);

    }

}

?>