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
        private $sinopsis;

        //Fucniones getter y setter

        //idLibros
        function setidLibros($idLibros){
            $this->idLibros = $idLibros;
        }

        function getidLibros(){
            return $this->idLibros;
        }

        //Portada
        function setPortada($portada){
            $this->portada = $portada;
        }

        function getPortada(){
            return $this->portada;
        }

        //Nombre
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        function getNombre(){
            return $this->nombre;
        }

        //ISBN
        function setISBN($isbn){
            $this->isbn = $isbn;
        }

        function getISBN(){
            return $this->isbn;
        }

        //Edición
        function setEdicion($edicion){
            $this->edicion = $edicion;
        }

        function getEdicion(){
            return $this->edicion;
        }

        //Formato
        function setFormato($formato){
            $this->formato = $formato;
        }

        function getFormato(){
            return $this->formato;
        }

        //Idioma
        function setIdioma($idioma){
            $this->idioma = $idioma;
        }

        function getIdioma(){
            return $this->idioma;
        }

        //Número de Páginas
        function setPaginas($noPaginas){
            $this->noPaginas = $noPaginas;
        }

        function getPaginas(){
            return $this->noPaginas;
        }

        //Año
        function setAnio($anio){
            $this->anio = $anio;
        }

        function getAnio(){
            return $this->anio;
        }

        //Cantidad
        function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }

        function getCantidad(){
            return $this->cantidad;
        }

        //Autor
        function setAutor($autor){
            $this->autor = $autor;
        }

        function getAutor(){
            return $this->autor;
        }

        //Categoria
        function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        function getCategoria(){
            return $this->categoria;
        }

        //Sinópsis
        function setSinopsis($sinopsis){
            $this->sinopsis = $sinopsis;
        }

        function getSinopsis(){
            return $this->sinopsis;
        }

        //Editorial
        function setEditorial($editorial){
            $this->editorial = $editorial;
        }

        function getEditorial(){
            return $this->editorial;
        }

        function totalPaginas($totalLibros){

            $totalPaginas = ceil($totalLibros/9); // Con ceil() se redondea el resultado

            return $totalPaginas;
        }
    }

?>