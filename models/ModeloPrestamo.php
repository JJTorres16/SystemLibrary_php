<?php

    class ModeloPrestamo {

        private $idPrestamo;
        private $alumnoNoControl;
        private $fecInit;
        private $fecFin;
        private $refrendo;
        private $noRefrendo;
        private $tipo;
        private $idLibro;
        private $observaciones;
        private $retraso;
        private $estado;

        // Métodos getter y setter

        // Id del préstamo
        function setIdPrestamo($idPrestamo){
            $this->idPrestamo = $idPrestamo;
        }

        function getIdPrestamo(){
            return $this->idPrestamo;
        }

        //Número de control del alumno
        function setNoControlAlumno($alumnoNoControl){
            $this->alumnoNoControl = $alumnoNoControl;
        }

        function getNoControlAlumno(){
            return $this->alumnoNoControl;
        }

        //Fecha de inicio
        function setFecInit($fecInit){
            $this->fecInit = $fecInit;
        }

        function getFecInit(){
            return $this->fecInit;
        }

        //Fecha de retorno:
        function setFecFin($fecFin){
            $this->fecFin = $fecFin;
        }

        function getFecFin(){
            return $this->fecFin;
        }

        //Refrendo
        function setRefrendo($refrendo){
            $this->refrendo = $refrendo;
        }

        function getRefrendo(){
            return $this->refrendo;
        }

        //Número de refrendos
        function setNoRefrendos($noRefrendo){
            $this->noRefrendo = $noRefrendo;
        }

        function getNoRefrendo(){
            return $this->noRefrendo;
        }

        //Tipo de préstamo (Casa o a Sala)
        function setTipo($tipo){
            $this->tipo = $tipo;
        }

        function getTipo(){
            return $this->tipo;
        }

        //Id del libro:
        function setIdLibro($idLibro){
            $this->idLibro = $idLibro;
        }

        function getIdLibro(){
            return $this->idLibro;
        }

        //Observaciones
        function setObservaciones($observaciones){
            $this->observaciones = $observaciones;
        }

        function getObservaciones(){
            return $this->observaciones;
        }

        //¿Hay retraso?
        function setRetraso($retraso){
            $this->retraso = $retraso;
        }

        function getRetraso(){
            return $this->retraso;
        }

        //Estado (Nuevo, En curso, Retraso)
        function setEstado($estado){
            $this->estado = $estado;
        }

        function getEstado(){
            return $this->estado;
        }

        function comparaFechas(){
            
            //Crear un objeto de tipo DateTime():
            $objDateTime = new DateTime();
            $objDateTimeDevolucion = new DateTime($this->fecFin);

            $fechaActual = $objDateTime->format('Y-m-d');
            $fechaDevolucion = $objDateTimeDevolucion->format('Y-m-d');

            if($fechaActual > $fechaDevolucion)
                return true;
            else    
                return false;
        }

    }

?>