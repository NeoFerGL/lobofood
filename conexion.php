<?php
    $host="localhost";
    $user="root";
    $pass="";
    $db="lobofood";

    $conex= new mysqli($host,$user,$pass,$db);
    
    if(!$conex){
        echo 'Conexion fallida';
    }
?>