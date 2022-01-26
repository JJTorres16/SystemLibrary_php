<?php

require_once 'libs/model.php';
require_once 'modelDAO/CatalogoDAO.php'; // Importamos el controlador de CatalogoDAO

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

    function refrendar($idPrestamo, ){
        
        $query = parent::getConnection()->prepare("UPDATE prestamo SET norefrendo = (SELECT norefrendo FROM prestamo WHERE idprestamo = ?) + 1,
                                                   fecfin = (SELECT fecfin FROM prestamo WHERE idprestamo = ?) + INTERVAL '3 days'  
                                                   WHERE idprestamo = ?;");        

        try {
            $query->execute(array(
                $idPrestamo,
                $idPrestamo,
                $idPrestamo
            ));

            header('Location: /SystemLibrary/prestamo');
        
        } catch(PDOException $e) {
            if($e->getCode() == '23514'){
                $numError = 13;
                header('Location: /SystemLibrary/prestamo?error='.$numError.'');

            }

        }

    }

    function devolverLibro($idPrestamo, $idLibro){

        $query = parent::getConnection()->prepare("UPDATE prestamo SET estado = ? WHERE idprestamo = ?");

        $query->execute(array(
            'Finalizado',
            $idPrestamo
        ));

        $catalogoDAO = new CatalogoDAO();
        $catalogoDAO->sumaUnLibro($idLibro);


    }


    function showPrestamo($criterioBusqueda, $busqueda, $estado1){

        if($criterioBusqueda!="")
            $stringBusqueda = 'LOWER(' . $criterioBusqueda . ") = LOWER('" . $busqueda . "') AND ";
        else
            $stringBusqueda = "";

        $query = "SELECT idprestamo, idlibro, tipo, retraso, LB.nombre, CTA.categoria, ALM.nombre AS alumnoNombre, ALM.appaterno, ALM.apmaterno, fecinit, fecfin, norefrendo, estado 
                  FROM prestamo INNER JOIN libros AS LB ON idlibro = idlibros INNER JOIN alumno as ALM ON alumnonocontrol = nocontrol
                  INNER JOIN categoria AS CTA ON LB.categoria = id_
                  WHERE $stringBusqueda (estado LIKE '%$estado1%')
                  ORDER BY idprestamo";
                  
        return parent::getConnection()->query($query);
       
    }


    function consultaExistencias($noControlAlumno, $idLibro){

        $query = "SELECT COUNT(alumnonocontrol) FROM prestamo WHERE alumnonocontrol = '$noControlAlumno' AND idlibro = $idLibro AND 
                         (estado = 'En curso' OR estado = 'Retrasado');";
        return parent::getConnection()->query($query); // Regresa la cantidad de filas que corresponden a esa descripción
    }


    function cantPrestamosAlumno($noControlAlumno){

        $query = "SELECT COUNT(idprestamo) FROM prestamo WHERE alumnonocontrol = '$noControlAlumno'
                  AND (estado = 'En curso' OR estado = 'Retrasado')";
        return parent::getConnection()->query($query);
    }
    

    function consultaRefrendos($idPrestamo){

        $query = "SELECT idprestamo, norefrendo FROM prestamo WHERE idprestamo = $idPrestamo";
        return parent::getConnection()->query($query);
    }

    
    function cambiaEstadoRetrasado($idPrestamo){

        $query = parent::getConnection()->prepare("UPDATE prestamo SET estado = ?, retraso = ?
                                                   WHERE idprestamo = ?");

        $query->execute(array(
            'Retrasado',
            1,
            $idPrestamo,
        ));

    }
}


?>

