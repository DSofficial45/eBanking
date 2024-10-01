<?php

require_once __DIR__ . '/../conexion/conexion.php';
require_once __DIR__ . '/../dao/sesionDAO.php';
require_once __DIR__ . '/../dao/respuesta.php';

    session_start();

    class SesionDAO{
        public $email;
        public $password;

        public function iniciarSesion($email, $password){
            $conection = getConector();
            $sql = "SELECT * FROM usuario WHERE email = '$email' AND contraseña = '$password'";
            $respuesta = $conection->query($sql);
            $fila = $respuesta->fetch_assoc();
            if ($fila !=null){
                $respuesta = new Respuesta(estado: true,mensaje: "Sesion Iniciada", datos: null);
                $_SESSION['sesion']=["usuario"=>$fila];                    
            }else{
                $respuesta = new Respuesta(estado: false,mensaje: "Error al iniciar", datos: null);
                $_SESSION['sesion']=["usuario"=>$fila];
            }
            return $respuesta;
            
        }

        public function registrarUsuario($email, $nombre, $password) {
            try {
                $conection = getConector();
                $sql = "INSERT INTO usuario(nombreCompleto, email, contraseña) 
                        VALUES ('$nombre', '$email', '$password');";
                $respuesta = $conection->query($sql);
               return new Respuesta(true, "Usuario registrado correctamente", $respuesta);
              // return "usuario A";
            } catch (Exception $e) {
               return new Respuesta(false, "Error al registrar Usuario: " . $e->getMessage(), null);
                //return "error";
            }
            
        }
    }


?>