<?php
    require_once __DIR__ . '/../dao/sesionDAO.php';

    $funcion = $_GET['funcion'];
    switch ($funcion) {
        case "":
            iniciarSesion();
        break;
    
        case "registrar":
            registrarUsuario();
        break;
    }
    
    function registrarUsuario(){
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $resultado = (new SesionDAO())->registrarUsuario($email, $nombre, $password);
        echo json_encode($resultado);
    }

    function iniciarSesion(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $resultado = (new SesionDAO())->iniciarSesion($email, $password);
        echo json_encode($resultado);
    }
?>