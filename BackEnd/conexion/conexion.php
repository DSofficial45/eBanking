<?php

function getConector() {
       $conexion = new mysqli("localhost", "root", "", "ebaking");
       return $conexion;
}
    
?>