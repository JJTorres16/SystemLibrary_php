<?php

require_once 'models/ModeloPrestamo.php';
require_once 'modelDAO/PrestamoDAO.php';
require_once 'modelDAO/CatalogoDAO.php';

class Prestamo extends Controller{
    function __construct(){
        parent::__construct();
    }

    function irVistaMain(){
        $this->view->render('prestamo/index');
    }

    function irVistaAdd(){
        $this->view->render('prestamo/add');
    }

    function irVistaEdit(){
        $this->view->render('prestamo/edit');
    }

    function irVistaDetail(){
        $this->view->render('prestamo/detail');
    }

    function agregar(){

        $modeloPrestamo = new ModeloPrestamo();
        $prestamoDAO = new PrestamoDAO();
        $catalogoDAO = new CatalogoDAO();        
    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $idLibro = $_POST['txtIdLibro']; // -> Falta colocar el campo en el formulario (hidden)
            $noControlAlumno = $_POST['txtNcAlumno'];
            $text_fechaDeInicio = $_POST['dateFechaInicio'];
            $text_fechaDeFin = $_POST['dateFinPrestamo'];
            $tipoPrestamo = $_POST['txtTipoPrestamo']; // Casa o Sala -> Falta colocar el campo en el formulario (hidden)
            $observaciones = $_POST['areaObservPrestamo'];

            //Convertimos las fechas dadas en el formulario a formato fecha. Objeto DateTime:
            $obj_fechaDeInicio = DateTime::createFromFormat('d/m/Y', $text_fechaDeInicio);
            $obj_fechaDeFin = DateTime::createFromFormat('d/m/Y', $text_fechaDeFin);

            //Nueva cadena con el formato fecha requerido:
            $fechaDeInicio = $obj_fechaDeInicio->format("d/m/Y");
            $fechaDeFin = $obj_fechaDeFin->format("d/m/Y");

            // Asignamos las variables al modeloPrestamo:
            $modeloPrestamo->setIdLibro($idLibro);
            $modeloPrestamo->setNoControlAlumno($noControlAlumno);
            $modeloPrestamo->setFecInit($fechaDeInicio);
            $modeloPrestamo->setFecFin($fechaDeFin);
            $modeloPrestamo->setTipo($tipoPrestamo);
            $modeloPrestamo->setObservaciones($observaciones);

            // Corroboramos que no haya un prestamo igual (mismo libro):
            $corroboraPrestamo = $prestamoDAO->consultaExistencias($noControlAlumno, $idLibro);

            //Corrobormos que el alumno no tenga más de un préstamo:
            $cantPrestamosAlumno = $prestamoDAO->cantPrestamosAlumno($noControlAlumno);
            foreach($cantPrestamosAlumno as $prestamosEnCurso){
                $cantPrestamo = $prestamosEnCurso['count']; // Devolvemos el valor de la consulta en el campo count
            }
            
            if($cantPrestamo == 2)
                header('Location: /SystemLibrary/prestamo/add?idLibro='.$idLibro.'&tipo='.$tipoPrestamo.'&error=11');

            else {
                if(isset($corroboraPrestamo)){       
                    header('Location: /SystemLibrary/prestamo/add?idLibro='.$idLibro.'&tipo='.$tipoPrestamo.'&error=12');

                } else
                    $prestamoDAO->add($modeloPrestamo); // Con el método add del modelo DAO de préstamo hacemos la incersión de la base de datos:
                    $catalogoDAO->restaUnLibro($idLibro); // Restamos en uno la cantidad de libros disponibles:
                    header ('Location: /SystemLibrary/prestamo/add?idLibro='. $idLibro .'&tipo='. $tipoPrestamo .'&error=0'); 
            } 

        } else
            header ('Location: /SystemLibrary/catalogo');

    }
}

?>