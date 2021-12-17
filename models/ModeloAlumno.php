<?php

    class ModeloAlumno {

        private $noControl;
        private $nombre;
        private $carrera;
        private $email;
        private $telefono;
        private $sexo;
        private $noPrestamos;

        // Métodos getter y setter

        //Número de Control:
        function setNoControl($noControl){
            $this->noControl = $noControl;
        }

        function getNoControl(){
            return $noControl;
        }

        // Nombre del alumno:
        function setNombre($nombre){
            $this->nombre = $nombre;
        }

        function getNombre(){
            return $nombre;
        }

        //Carrera
        function setCarrera($carrera){
            $this->carrera = $carrera;
        }

        function getCarrera(){
            return $carrera;
        }

        //E-mail
        function setEmail($email){
            $this->email = $email;
        }

        function getEmail(){
            return $email;
        }

        //Teléfono
        function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        function getTelefono(){
            return $telefono;
        }

        //Sexo
        function setSexo($sexo){
            $this->sexo = $sexo;
        }
        
        function getSexo(){
            return $sexo;
        }

        //Número de préstamos:
        function setNoPrestamos($noPrestamos){
            $this->noPrestamos = $noPrestamos;
        }

        function getNoPrestamos(){
            return $noPrestamos;
        }

    }

?>