<?php

function getConector() {
       $conexion = new mysqli("localhost", "root", "", "ebanking");
       return $conexion;
}
    
?>