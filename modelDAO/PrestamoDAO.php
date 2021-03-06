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

    function refrendar($idPrestamo, $origen, $alumnoNoControl){
        
        $query = parent::getConnection()->prepare("UPDATE prestamo SET norefrendo = (SELECT norefrendo FROM prestamo WHERE idprestamo = ?) + 1,
                                                   fecfin = (SELECT fecfin FROM prestamo WHERE idprestamo = ?) + INTERVAL '3 days'  
                                                   WHERE idprestamo = ?;");        

        try {
            $query->execute(array(
                $idPrestamo,
                $idPrestamo,
                $idPrestamo
            ));

            if($origen == 'prestamo')
                header('Location: /SystemLibrary/prestamo');
            else
                header('Location: /SystemLibrary/prestamo/historial?noControl='.$alumnoNoControl.'');
        
        } catch(PDOException $e) {
            if($e->getCode() == '23514'){
                $numError = 13;

                if($origen == 'prestamo')
                    header('Location: /SystemLibrary/prestamo?error='.$numError.'');
                else
                    header('Location: /SystemLibrary/prestamo/historial?error='.$numError.'&noControl='.$alumnoNoControl.'');
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


    function showPrestamo($criterioBusqueda, $busqueda, $estado1, $estado2){

        if($criterioBusqueda!="")
            $stringBusqueda = 'LOWER(' . $criterioBusqueda . ") LIKE LOWER('%" . $busqueda . "%') AND ";
        else
            $stringBusqueda = "";

        $query = "SELECT idprestamo, alumnonocontrol, idlibro, tipo, retraso, LB.nombre, CTA.categoria, ALM.nombre AS alumnoNombre, ALM.appaterno, ALM.apmaterno, fecinit, fecfin, norefrendo, estado 
                  FROM prestamo INNER JOIN libros AS LB ON idlibro = idlibros INNER JOIN alumno as ALM ON alumnonocontrol = nocontrol
                  INNER JOIN categoria AS CTA ON LB.categoria = id_
                  WHERE $stringBusqueda (estado = '$estado1' OR estado = '$estado2')
                  ORDER BY idprestamo";
                  
        return parent::getConnection()->query($query);
       
    }


    function consultaExistencias($noControlAlumno, $idLibro){

        $query = parent::getConnection()->prepare("SELECT COUNT(alumnonocontrol) FROM prestamo WHERE alumnonocontrol = ? AND idlibro = ? AND 
                                                   (estado = ? OR estado = ?);");

        $query->execute(array(
            $noControlAlumno,
            $idLibro,
            'En curso',
            'Retrasado'
        ));

        $listaExistencias = $query->fetchAll();

        return $listaExistencias; // Regresa la cantidad de filas que corresponden a esa descripción
    }


    function cantPrestamosAlumno($noControlAlumno){

        $query = parent::getConnection()->prepare("SELECT COUNT(idprestamo) FROM prestamo WHERE alumnonocontrol = ?
                                                   AND (estado = ? OR estado = ?)");

        $query->execute(array(
            $noControlAlumno,
            'En curso',
            'Retrasado'
        ));

        $cantPrestamosAlumno = $query->fetchAll(); 

        return $cantPrestamosAlumno;
    }
    

    function consultaRefrendos($idPrestamo){

        $query = parent::getConnection()->prepare("SELECT idprestamo, norefrendo FROM prestamo WHERE idprestamo = ?");

        $query->execute(array(
            $idPrestamo
        ));

        $listaRefrendos = $query->fetchAll();
        return $listaRefrendos;
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


    function detallePrestamo($idPrestamo){

        $query = parent::getConnection()->prepare("SELECT idprestamo, fecinit, fecfin, observaciones, alumnonocontrol, estado, retraso, tipo, norefrendo, LBR.portada, LBR.isbn, LBR.autor, LBR.formato, LBR.nombre AS nombrelibro,
                                                   ALO.nombre AS nombrealumno, ALO.appaterno, ALO.apmaterno, ALO.carrera, CTA.categoria
                                                   FROM prestamo INNER JOIN libros AS LBR ON idlibro = idlibros INNER JOIN alumno AS ALO ON alumnonocontrol = nocontrol
                                                   INNER JOIN categoria AS CTA ON LBR.categoria = id_
                                                   WHERE idprestamo = ?");

        $query->execute(array($idPrestamo));

        $prestamoSelecionado = $query->fetchAll();

        return $prestamoSelecionado;
    }

    function reportePrestamo($tipo){
        
        $query = parent::getConnection()->prepare("SELECT idprestamo, fecinit, fecfin, observaciones, alumnonocontrol, estado, retraso, tipo, norefrendo, LBR.portada, LBR.isbn, LBR.autor, LBR.formato, LBR.nombre AS nombrelibro,
                                                   ALO.nombre AS nombrealumno, ALO.appaterno, ALO.apmaterno, ALO.carrera, CTA.categoria
                                                   FROM prestamo INNER JOIN libros AS LBR ON idlibro = idlibros INNER JOIN alumno AS ALO ON alumnonocontrol = nocontrol
                                                   INNER JOIN categoria AS CTA ON LBR.categoria = id_
                                                   WHERE tipo = ? ORDER BY fecinit DESC");

        
        $query ->execute(array($tipo));

        $listadoPrestamo = $query->fetchAll();

        return $listadoPrestamo;
    }

    /*function consultaHistorial($noControl, $estado1, $estado2){

        $query = parent::getConnection()->prepare("SELECT * FROM prestamo WHERE alumnonocontrol = ? 
                                                   AND (estado = ? OR estado = ?)");

       $query->execute(array(
            $noControl,
            $estado1,
            $estado2
       ));

        $prestamo = $query->fetchAll();

        return $prestamo;
    }*/
}


?>

