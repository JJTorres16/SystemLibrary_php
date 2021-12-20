<?php

    class ModeloCategoria{

        private $id;
        private $categoria;

        // Métodos getter y setter

        //Id
        function setId($id){
            $this->id = $id;
        }

        function getId(){
            return $this->id;
        }

        // Categoria
        function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        function getCategoria(){
            return $this->categoria;
        }
    }

?>