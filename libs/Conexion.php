<?php

    //Conexión a base de datos con postgres:
    class Conexion{

        static function conexionBD(){

            $conn = "";
            $host = "localhost";
            $dbName = "Biblioteca";
            $username = "postgres";
            $pasword = "JJTV97";

            try{
                $conn = new PDO("pgsql:host = $host; dbname = $dbName", $username, $pasword);

            } catch(PDOException $e){
                echo "<script language= javascript type= text/javascript >";
                echo "alert('Error de conexión a la base de datos');";
                echo "</script>";
            }

            return $conn;
        }        
    }

?>
