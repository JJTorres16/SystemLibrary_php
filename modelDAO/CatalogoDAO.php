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
    
    function show($busqueda, $categoria){

        if($categoria > 0){
            $query = parent::getConnection()->prepare("SELECT DISTINCT * FROM libros WHERE LOWER(nombre) LIKE LOWER(?) AND categoria = ? ORDER BY nombre ASC");
            $query->execute(array(
                '%'.$busqueda.'%',
                $categoria
            ));

            $listaLibros = $query->fetchAll();

        } else {
            $query = parent::getConnection()->prepare("SELECT DISTINCT * FROM libros WHERE LOWER(nombre) LIKE LOWER(?) ORDER BY nombre ASC");
            $query->execute(array(
                '%'.$busqueda.'%'
            ));

            $listaLibros = $query->fetchAll();

        }

        return $listaLibros;
    }

    function showDetail($id){

        $query = "SELECT * FROM libros WHERE idlibros =" . $id . ";";
        return parent::getConnection()->query($query);
    }

    function edit($catalogo){

        if($catalogo->getPortada() != ""){
            $query = parent::getConnection()->prepare("UPDATE libros SET nombre = ?, autor = ?, isbn = ?, formato = ?, idioma = ?, edicion = ?, anio = ?, categoria = ?,
                                                    nopaginas = ?, cantidad = ?, sinopsis = ?, editorial = ?, portada = ? WHERE idlibros = ?;");

            $query -> execute(array(
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
                $catalogo->getSinopsis(),
                $catalogo->getEditorial(),
                $catalogo->getPortada(),
                $catalogo->getidLibros()
            ));

        } else {
            $query = parent::getConnection()->prepare("UPDATE libros SET nombre = ?, autor = ?, isbn = ?, formato = ?, idioma = ?, edicion = ?, anio = ?, categoria = ?,
                                                    nopaginas = ?, cantidad = ?, sinopsis = ?, editorial = ? WHERE idlibros = ?;");

            $query -> execute(array(
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
                $catalogo->getSinopsis(),
                $catalogo->getEditorial(),
                $catalogo->getidLibros()
            ));
        }
    }

    function restaUnLibro($idlibro){
        
        $query = parent::getConnection()->prepare("UPDATE libros SET cantidad = (SELECT cantidad FROM libros WHERE idlibros = ?) - 1
                                            WHERE idlibros = ?;");

        $query -> execute(array(
            $idlibro,
            $idlibro
        ));
    }

    function sumaUnLibro($idLibro){
        
        $query = parent::getConnection()->prepare("UPDATE libros SET cantidad = (SELECT cantidad FROM libros WHERE idlibros = ?) + 1
                                            WHERE idlibros = ?;");

        $query -> execute(array(
            $idLibro,
            $idLibro
        ));
    }

    function delete($idLibro){

        //$query = parent::getConnection()->prepare("DELETE FROM libros WHERE idlibros = ?");
        $query = parent::getConnection()->prepare("UPDATE libros SET cantidad = 0 WHERE idlibros = ?");


        $query-> execute(array(
            $idLibro
        ));

        //echo "Ya se eliminó el libro";
    }

}

?>