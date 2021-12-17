<?php

    class ModeloPrestamo {

        private $idPrestamo;
        private $almunoNoControl;
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
            return $idPrestamo;
        }

        //Número de control del alumno
        function setNoControlAlumno($almunoNoControl){
            $this->alumnoNoControl = $almunoNoControl;
        }

        function getNoControlAlumno(){
            return $almunoNoControl;
        }

        //Fecha de inicio
        function setFecInit($fecInit){
            $this->fecInit = $fecInit;
        }

        function getFecInit(){
            return $fecInit;
        }

        //Fecha de retorno:
        function setFecFin($fecFin){
            $this->fecFin = $fecFin;
        }

        //Refrendo
        function setRefrendo($refrendo){
            $this->refrendo = $refrendo;
        }

        function getRefrendo(){
            return $refrendo;
        }

        //Número de refrendos
        function setNoRefrendos($noRefrendo){
            $this->noRefrendo = $noRefrendo;
        }

        function getNoRefrendo(){
            return $noRefrendo;
        }

        //Tipo de préstamo (Casa o a Sala)
        function setTipo($tipo){
            $this->tipo = $tipo;
        }

        function getTipo(){
            return $tipo;
        }

        //Id del libro:
        function setIdLibro($idLibro){
            $this->idLibro = $idLibro;
        }

        function getIdLibro(){
            return $idLibro;
        }

        //Observaciones
        function setObservaciones($observaciones){
            $this->observaciones = $observaciones;
        }

        function getObservaciones(){
            return $observaciones;
        }

        //¿Hay retraso?
        function setRetraso($retraso){
            $this->retraso($retraso);
        }

        function getRetraso(){
            return $retraso;
        }

        //Estado (Nuevo, En curso, Retraso)
        function setEstado($estado){
            $this->estado = $estado;
        }

        function getEstado(){
            return $estado;
        }

    }

?>