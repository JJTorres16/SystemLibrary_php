<?php

    class ModeloCatalogo {
        
        private $idLibros;
        private $portada;
        private $nombre;
        private $isbn;
        private $edicion;
        private $formato;
        private $idioma;
        private $noPaginas;
        private $anio;
        private $cantidad;
        private $autor;
        private $categoria;

        //Fucniones getter y setter

        //idLibros
        function setidLibros($idLibros){
            $this->idLibros = $idLibros;
        }

        function getLibros(){
            return $idLibros;
        }

        //Portada
        function setPortada($portada){ // <- Pendiente
            $this->portada = $portada;
        }

        function getPortada(){ // <- Pendiente
            return $portada;
        }

        //Nombre
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        function getNombre(){
            return $nombre;
        }

        //ISBN
        function setISBN($isbn){
            $this->isbn = $isbn;
        }

        function getISBN(){
            return $isbn;
        }

        //Edición
        function setEdicion($edicion){
            $this->edicion = $edicion;
        }

        function getEdicion(){
            return $edicion;
        }

        //Formato
        function setFormato($formato){
            $this->formato = $formato;
        }

        function getFormato(){
            return $formato;
        }

        //Idioma
        function setIdioma($idioma){
            $this->idioma = $idioma;
        }

        function getIdioma(){
            return $idioma;
        }

        //Número de Páginas
        function setPaginas($noPaginas){
            $this->noPaginas = $noPaginas;
        }

        function getPaginas(){
            return $noPaginas;
        }

        //Año
        function setAnio($anio){
            $this->anio = $anio;
        }

        function getAnio(){
            return $anio;
        }

        //Cantidad
        function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }

        function getCantidad(){
            return $cantidad;
        }

        //Autor
        function setAutor($autor){
            $this->autor = $autor;
        }

        function getAutor(){
            return $autor;
        }

        //Categoria
        function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        function getCatetoria(){
            return $categoria;
        }
    }

?>