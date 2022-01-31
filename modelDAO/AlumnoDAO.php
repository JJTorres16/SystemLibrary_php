<?php

require_once 'libs/model.php';

class AlumnoDAO extends Model{

    function add($alumno){

        $habilitado = true;

        $query = parent::getConnection()->prepare("INSERT INTO alumno (nocontrol, nombre, appaterno, apmaterno, carrera, email, telefono, sexo, prestamosactuales, habilitado)
                                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");

        $query->execute(array(
            $alumno->getNoControl(),
            $alumno->getNombre(),
            $alumno->getApellidoPaterno(),
            $alumno->getApellidoMaterno(),
            $alumno->getCarrera(),
            $alumno->getEmail(),
            $alumno->getTelefono(),
            $alumno->getSexo(),
            $alumno->getNoPrestamos(),
        ));
        
        
        $result =  false;
    }

    function delete($noControl){

        $query = parent::getConnection()->prepare("UPDATE alumno SET habilitado = false WHERE nocontrol = ?");

        $query->execute(array(
            $noControl
        ));
    }

    function edit($alumno){

        $query = parent::getConnection()->prepare("UPDATE alumno SET nombre = ?, appaterno = ?, apmaterno = ?, carrera = ?, email = ?, telefono = ?,
                                                   sexo = ? WHERE nocontrol = ?;");

        $query->execute(array(
            $alumno->getNombre(),
            $alumno->getApellidoPaterno(),
            $alumno->getApellidoMaterno(),
            $alumno->getCarrera(),
            $alumno->getEmail(),
            $alumno->getTelefono(),
            $alumno->getSexo(),
            $alumno->getNoControl()
        ));

        $result = false;
    }

    function show($noControl){
        
        $query = parent::getConnection()->prepare("SELECT * FROM alumno WHERE nocontrol LIKE ? ORDER BY appaterno, nombre");

        $query->execute(array(
            '%'.$noControl.'%'
        ));

        $listaAlumnos = $query->fetchAll();
        return $listaAlumnos;
    }

}

?>