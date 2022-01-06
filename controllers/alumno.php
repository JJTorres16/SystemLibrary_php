<?php

require_once 'models/ModeloAlumno.php';
require_once 'modelDAO/AlumnoDAO.php';

class Alumno extends Controller {
    function __construct(){
        parent::__construct();
    }

    function irVistaMain(){
        $this->view->render('alumno/index');
    }

    function irVistaAdd(){
        $this->view->render('alumno/add');
    }

    function irVistaEdit(){
        $this->view->render('alumno/edit');
    }

    function agregar(){

        $modeloAlumno = new ModeloAlumno();
        $alumnoDAO = new AlumnoDAO();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $apPaternoAlumno = $_POST['txtPaternoAlumno'];
            $apMaternoAlumno = $_POST['txtMaternoAlumno'];
            $nombreAlumno = $_POST['txtNameAlumno'];
            $noControl = $_POST['txtNCAlumno'];
            $telAlumno = $_POST['txtTelAlumno'];
            $emailAlumno = $_POST['txtEmailAlumno'];
            $carreraAlumno = $_POST['txtCarreraAlumno'];
            $sexoAlumno = $_POST['txtSexoAlumno'];
            $cantidadPrestamos = 0;

            // Asigamos las variables al objeto $modeloAlumno
            $modeloAlumno->setNombre($nombreAlumno);
            $modeloAlumno->setApellidoPaterno($apPaternoAlumno);
            $modeloAlumno->setApellidoMaterno($apMaternoAlumno);
            $modeloAlumno->setNoControl($noControl);
            $modeloAlumno->setTelefono($telAlumno);
            $modeloAlumno->setEmail($emailAlumno);
            $modeloAlumno->setCarrera($carreraAlumno);
            $modeloAlumno->setSexo($sexoAlumno);
            $modeloAlumno->setNoPrestamos($cantidadPrestamos);

            // Del objeto alumnoDAO ejecutamos el método add pasando como parámetro el objeto $modeloAlumno:
            $alumnoDAO -> add($modeloAlumno);
        }

        header ('Location: /SystemLibrary/alumno');
    }

    function eliminar(){

        $alumnoDAO = new AlumnoDAO();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Obtenemos el número de control del alumno a eliminar:
            $noControl = $_POST['txtnoControlBaja'];

            // Función para eliminar al alumno:
            $alumnoDAO->delete($noControl);
        }

        header('Location: /SystemLibrary/alumno');

    }

    function editar(){

        $modeloAlumno = new ModeloAlumno();
        $alumnoDAO = new AlumnoDAO();

        if($_SERVER['REQUEST_METHOD'] = 'POST'){
            $apPaternoAlumno = $_POST['txtPaternoAlumno'];
            $apMaternoAlumno = $_POST['txtMaternoAlumno'];
            $nombreAlumno = $_POST['txtNameAlumno'];
            $noControl = $_POST['txtNCAlumno'];
            $telAlumno = $_POST['txtTelAlumno'];
            $emailAlumno = $_POST['txtEmailAlumno'];
            $carreraAlumno = $_POST['txtCarreraAlumno'];
            $sexoAlumno = $_POST['txtSexoAlumno'];

            // Asigamos las variables al objeto $modeloAlumno
            $modeloAlumno->setNombre($nombreAlumno);
            $modeloAlumno->setApellidoPaterno($apPaternoAlumno);
            $modeloAlumno->setApellidoMaterno($apMaternoAlumno);
            $modeloAlumno->setNoControl($noControl);
            $modeloAlumno->setTelefono($telAlumno);
            $modeloAlumno->setEmail($emailAlumno);
            $modeloAlumno->setCarrera($carreraAlumno);
            $modeloAlumno->setSexo($sexoAlumno);

            $alumnoDAO->edit($modeloAlumno);

        }

        header ('Location: /SystemLibrary/alumno');
    }

    function show($noControl){

        $listaAlumno = array();
        $alumnoDAO = new AlumnoDAO();

        // Generamos las consultas
        $queryAlumno = $alumnoDAO->show($noControl);

        foreach($queryAlumno as $alumno){
            // Creamos el objeto de alumno:
            $modeloAlumno = new ModeloAlumno();

            $modeloAlumno->setNoControl($alumno['nocontrol']);
            $modeloAlumno->setNombre($alumno['nombre']);
            $modeloAlumno->setApellidoPaterno($alumno['appaterno']); 
            $modeloAlumno->setApellidoMaterno($alumno['apmaterno']);  
            $modeloAlumno->setCarrera($alumno['carrera']);
            $modeloAlumno->setEmail($alumno['email']);
            $modeloAlumno->setTelefono($alumno['telefono']);
            $modeloAlumno->setSexo($alumno['sexo']);
            $modeloAlumno->setHabilitado($alumno['habilitado']);
            array_push($listaAlumno, $modeloAlumno);
        }

        return $listaAlumno;
    }
}
?>