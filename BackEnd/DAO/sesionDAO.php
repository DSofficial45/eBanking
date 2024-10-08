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

        public function registrarUsuario($email, $nombre, $password, $saldo) {
            try {
                $conection = getConector();
                $sql = "INSERT INTO usuario(nombreCompleto, email, contraseña) 
                        VALUES ('$nombre','$email', '$password');";
                $respuesta = $conection->query($sql);
                if ($respuesta){
                    $this ->crearCuenta($saldo, $email);
                }
                
                
               
              // return "usuario A";
            } catch (Exception $e) {
               return new Respuesta(false, "Error al registrar Usuario: " . $e->getMessage(), null);
                //return "error";
            }
            
        }

        public function crearCuenta($saldo, $emailUsuario) {
            try {
                $conection = getConector();
                $sql = "INSERT INTO cuenta(saldo, emailUsuario) 
                        VALUES ('$saldo', '$emailUsuario');";
                $respuesta = $conection->query($sql);
              if ($respuesta){
                return new Respuesta(true, "cuenta creada correctamente", $respuesta);
              }
              else{

                return new Respuesta(false, "Error al crear cuenta: " ,$respuesta);
              }
              // return "usuario A";
            } catch (Exception $e) {
            //   return new Respuesta(false, "Error en la operacion: " . $e->getMessage(), null);
                //return "error";
            }
            
        }
    }


?>