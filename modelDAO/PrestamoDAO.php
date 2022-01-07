<?php

require_once 'libs/model.php';

echo '<script src="../public/js-own/formularios.js"></script>';

class PrestamoDAO extends Model{

    function add($prestamo){

        $numError = 0; // Inicialización de la variable numError

        try{
            $query = parent::getConnection()->prepare("INSERT INTO prestamo (alumnonocontrol, fecinit, fecfin, tipo, idlibro, observaciones)
                                                    VALUES (?, ?, ?, ?, ?, ?);");

            $query->execute(array(
                $prestamo->getNoControlAlumno(),
                $prestamo->getFecInit(),
                $prestamo->getFecFin(),
                $prestamo->getTipo(),
                $prestamo->getIdLibro(),
                $prestamo->getObservaciones(),
            ));

            require_once 'modelDAO/CatalogoDAO.php'; // Importamos el controlador de CatalogoDAO
            $catalogoDAO = new CatalogoDAO();
            $catalogoDAO->restaUnLibro($prestamo->getIdLibro()); // Restamos en uno la cantidad de libros disponibles:
        
        } catch(PDOException $e){
            if($e->getCode() == '23503')
                $numError = 10;
            
        } finally {
            header('Location: /SystemLibrary/prestamo/add?idLibro='.$prestamo->getIdLibro().'&tipo='.$prestamo->getTipo().'&error='.$numError.'');
        
        }

        $result = false;
        
    }

    /*function show($criterioBusqueda, $busqueda){

        $query = "SELECT idprestamo,  FROM "
    }*/

    function consultaExistencias($noControlAlumno, $idLibro){

        $query = "SELECT COUNT(alumnonocontrol) FROM prestamo WHERE alumnonocontrol = '$noControlAlumno' AND idlibro = $idLibro AND 
                         (estado = 'En curso' OR estado = 'Retrasado');";

        return parent::getConnection()->query($query); // Regresa la cantidad de filas que corresponden a esa descripción
    }

    function cantPrestamosAlumno($noControlAlumno){

        $query = "SELECT COUNT(idprestamo) FROM prestamo WHERE alumnonocontrol = '$noControlAlumno'";
        return parent::getConnection()->query($query);
    }
}


?>

