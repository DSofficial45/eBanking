<?php
    require_once __DIR__ . '/../dao/sesionDAO.php';

    $funcion = $_GET['funcion'];
    switch ($funcion) {
        case "iniciar":
            iniciarSesion();
        break;
    
        case "registrar":
            registrarUsuario();
        break;
    
        case "crear":
            crearCuenta();
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

    function crearCuenta(){
        $saldo = $_POST['saldo'];
        $emailUsuario = $_POST['emailUsuario'];
        $resultado = (new SesionDAO())->crearCuenta($saldo, $emailUsuario);
        echo json_encode($resultado);
    }
?>