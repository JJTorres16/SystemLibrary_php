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
        $this->view->render('prestamo/details');
    }

    function irVistaHistorial(){
        $this->view->render('prestamo/historial');
    }

    function irVistaReporte(){
        $this->view->render('prestamo/reporte');
    }

    function agregar(){

        $modeloPrestamo = new ModeloPrestamo();
        $prestamoDAO = new PrestamoDAO();        
    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $idLibro = $_POST['txtIdLibro']; // -> Falta colocar el campo en el formulario (hidden)
            $noControlAlumno = $_POST['txtNcAlumno'];
            $text_fechaDeInicio = $_POST['dateFechaInicio'];
            $text_fechaDeFin = $_POST['dateFinPrestamo'];
            $tipoPrestamo = $_POST['txtTipoPrestamo']; // Casa o Sala -> Falta colocar el campo en el formulario (hidden)
            
            //Comprobamos si se escribió alguna observación:
            if($_POST['areaObservPrestamo'] != "")
                $observaciones = $_POST['areaObservPrestamo'];
            else
                $observaciones = "Sin observaciones";

            //Convertimos las fechas dadas en el formulario a formato fecha. Objeto DateTime:
            $fechaDeInicio = date($text_fechaDeInicio);
            $fechaDeFin = date($text_fechaDeFin);

            //Nueva cadena con el formato fecha requerido:
            //$fechaDeInicio = $obj_fechaDeInicio->format("d/m/Y");
            //$fechaDeFin = $obj_fechaDeFin->format("d/m/Y");

            // Asignamos las variables al modeloPrestamo:
            $modeloPrestamo->setIdLibro($idLibro);
            $modeloPrestamo->setNoControlAlumno($noControlAlumno);
            $modeloPrestamo->setFecInit($fechaDeInicio);
            $modeloPrestamo->setFecFin($fechaDeFin);
            $modeloPrestamo->setTipo($tipoPrestamo);
            $modeloPrestamo->setObservaciones($observaciones);

            // Corroboramos que no haya un prestamo igual (mismo libro):
            $corroboraPrestamo = $prestamoDAO->consultaExistencias($noControlAlumno, $idLibro);
            foreach($corroboraPrestamo as $prestamoIgual){
                $mismoLibro = $prestamoIgual['count'];
            }

            //Corrobormos que el alumno no tenga más de un préstamo:
            $cantPrestamosAlumno = $prestamoDAO->cantPrestamosAlumno($noControlAlumno);
            foreach($cantPrestamosAlumno as $prestamosEnCurso){
                $cantPrestamo = $prestamosEnCurso['count']; // Devolvemos el valor de la consulta en el campo count
            }
            
            if($cantPrestamo == 2)
                header('Location: /SystemLibrary/prestamo/historial?noControl='.$noControlAlumno.'&error=11');

            else {
                if($mismoLibro > 0){       
                    header('Location: /SystemLibrary/prestamo/add?idLibro='.$idLibro.'&tipo='.$tipoPrestamo.'&error=12');

                } else
                    $prestamoDAO->add($modeloPrestamo); // Con el método add del modelo DAO de préstamo hacemos la incersión de la base de datos:
                    //header ('Location: /SystemLibrary/prestamo/add?idLibro='. $idLibro .'&tipo='. $tipoPrestamo .'&error=0'); 
            } 

        } else
            header ('Location: /SystemLibrary/catalogo?noSehizoElPrestamo=0');

    }

    function refrendar(){

        $prestamoDAO = new PrestamoDAO();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $idPrestamo = $_POST['txtIdPrestamo'];
            $estado = $_POST['txtEstadoPrestamo'];
            $alumnoNoControl = $_POST['txtNoControl'];
            $origen = $_POST['txtOrigen'];

            $prestamoDAO->refrendar($idPrestamo, $origen, $alumnoNoControl);

        } else {
            header('Location: /SystemLibrary/prestamo');

        }
    }

    function devolver(){

        $prestamoDAO = new PrestamoDAO();

        if($_SERVER['REQUEST_METHOD'] = 'POST'){
            $idPrestamo	= $_POST['txtIdPrestamo'];
            $idLibro = $_POST['txtIdLibro'];
            $alumnoNoControl = $_POST['txtNoControl'];
            $origen = $_POST['txtOrigen'];

            $prestamoDAO->devolverLibro($idPrestamo, $idLibro);

            
            if($origen == 'prestamo')
                header('Location: /SystemLibrary/prestamo');
            else
                header('Location: /SystemLibrary/prestamo/historial?noControl='.$alumnoNoControl.'');

        } else {
            header('Location: /SystemLibrary/prestamo');

        }
    }

    function consultaDetalles(){

        $prestamoDAO = new PrestamoDAO();
        $idPrestamo = '';

        if(isset($_GET['idPrestamo']))
            $idPrestamo = $_GET['idPrestamo'];

        $presamoSeleccionado = $prestamoDAO->detallePrestamo($idPrestamo);
        return $presamoSeleccionado;
    }

    function reportePrestamo(){

        $prestamoDAO = new PrestamoDAO();
        $tipo = '';

        if(isset($_GET['tipo']))
            $tipo = $_GET['tipo'];

        $listaPrestamo = $prestamoDAO->reportePrestamo($tipo);
        return $listaPrestamo;
    }


    function cambiaFormatoFecha($fecha){

        $modeloPrestamo = new ModeloPrestamo();
        $fechaCorregida = $modeloPrestamo->cambiaFormatoFecha($fecha);

        return $fechaCorregida;
    }

    function comparaFecha($idPrestamo, $fecDevolucion){

        $prestamo = new ModeloPrestamo();
        $prestamoDAO = new PrestamoDAO();

        $prestamo->setFecFin($fecDevolucion); //$prestamo->comparaFechas();

        if($prestamo->comparaFechas())
            $prestamoDAO->cambiaEstadoRetrasado($idPrestamo);
    }


    function show($estado1='', $estado2=''){
        
        $prestamoDAO = new PrestamoDAO();
        $listaPrestamo = null;
        $criterioBusqueda = '';
        $busqueda = '';

        if(isset($_GET['selectFiltroPrestamos']))
            $criterioBusqueda = $_GET['selectFiltroPrestamos'];
        
        if(isset($_GET['txtDatoFiltro']))
            $busqueda = $_GET['txtDatoFiltro'];

        if(isset($_GET['noControl'])){
            $criterioBusqueda = 'alumnonocontrol';
            $busqueda = $_GET['noControl'];
        }

        $listaPrestamoEnCurso = $prestamoDAO->showPrestamo($criterioBusqueda, $busqueda, $estado1, $estado2);

        return $listaPrestamoEnCurso;
    }

}

?>