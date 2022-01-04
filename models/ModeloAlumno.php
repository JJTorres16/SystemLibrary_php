<?php

    class ModeloAlumno {

        private $noControl;
        private $nombre;
        private $apPaterno;
        private $apMaterno;
        private $carrera;
        private $email;
        private $telefono;
        private $sexo;
        private $noPrestamos;
        private $habilitado;

        // Métodos getter y setter

        //Número de Control:
        function setNoControl($noControl){
            $this->noControl = $noControl;
        }

        function getNoControl(){
            return $this->noControl;
        }

        // Nombre del alumno:
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        function getNombre(){
            return $this->nombre;
        }

        // Apellido paterno del alumno:
        function setApellidoPaterno($apPaterno){
            $this->apPaterno = $apPaterno;
        }

        function getApellidoPaterno(){
            return $this->apPaterno;
        }

        // Apellido materno del alumno:
        function setApellidoMaterno($apMaterno){
            $this->apMaterno = $apMaterno;
        }

        function getApellidoMaterno(){
            return $this->apMaterno;
        }

        //Carrera
        function setCarrera($carrera){
            $this->carrera = $carrera;
        }

        function getCarrera(){
            return $this->carrera;
        }

        //E-mail
        function setEmail($email){
            $this->email = $email;
        }

        function getEmail(){
            return $this->email;
        }

        //Teléfono
        function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        function getTelefono(){
            return $this->telefono;
        }

        //Sexo
        function setSexo($sexo){
            $this->sexo = $sexo;
        }
        
        function getSexo(){
            return $this->sexo;
        }

        //Número de préstamos:
        function setNoPrestamos($noPrestamos){
            $this->noPrestamos = $noPrestamos;
        }

        function getNoPrestamos(){
            return $this->noPrestamos;
        }

        // Alumno Habilitado:
        function setHabilitado($habilitado){
            $this->habilitado = $habilitado;
        }

        function getHabilitado(){
            return $this->habilitado;
        }

    }

?>