<?php

require_once 'libs/model.php';

echo '<script src="../public/js-own/formularios.js"></script>';

class PrestamoDAO extends Model{

    function add($prestamo){

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
        
        } catch(PDOException $e){
            if($e->getCode() == '23503')
                header('Location: /SystemLibrary/prestamo/add?idLibro='.$prestamo->getIdLibro().'&tipo='.$prestamo->getTipo().'&error=10');
            
        }

        $result = false;
        
    }

    function consultaExistencias($noControlAlumno, $idLibro){

        $query = "SELECT * FROM prestamo WHERE alumnonocontrol = '$noControlAlumno' AND idlibro = $idLibro AND 
                         (estado = 'En curso' OR estado = 'Retrasado');";

        return parent::getConnection()->query($query); // Regresa la cantidad de filas que corresponden a esa descripción
    }

    function cantPrestamosAlumno($noControlAlumno){

        $query = "SELECT COUNT(idprestamo) FROM prestamo WHERE alumnonocontrol = '$noControlAlumno'";
        return parent::getConnection()->query($query);
    }
}


?>

