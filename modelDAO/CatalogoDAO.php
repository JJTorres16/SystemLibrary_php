<?php

require_once('libs/model.php');
//require_once('models/ModeloCatalogo.php');

class CatalogoDAO extends Model{

    //private $conn = parent->getConnection();
    
    function add($catalogo){

        $query=parent::getConnection()->prepare("INSERT INTO libros (nombre, autor, isbn, formato, idioma, edicion, anio, categoria, nopaginas, cantidad, portada, sinopsis, editorial)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $query->execute(array(
            $catalogo->getNombre(),
            $catalogo->getAutor(),
            $catalogo->getISBN(),
            $catalogo->getFormato(),
            $catalogo->getIdioma(),
            $catalogo->getEdicion(),
            $catalogo->getAnio(),
            $catalogo->getCategoria(),
            $catalogo->getPaginas(),
            $catalogo->getCantidad(),
            $catalogo->getPortada(),
            $catalogo->getSinopsis(),
            $catalogo->getEditorial()
        ));

        $restult = false;

    }
    
    function show(){

        $query = "SELECT * FROM libros";

        return parent::getConnection()->query($query);
    }
}

?>