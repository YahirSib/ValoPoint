<?php
    session_start();
    require_once("Modelo/class.conexion.php");
    require_once("Modelo/class.usuarios.php");
    require_once("Modelo/class.cuenta.php");
    require_once("Modelo/class.trabajador.php");

    function loginUsuario($username, $contrasena){
        $usuario = new Usuarios();
        $id = $usuario->login($username, $contrasena);

        if($id){
            $url = BASE_URL.'dashboard.php';
            header("Location: $url");
        }else{
            return "<h2> Por favor, revise sus credenciales. </h2>";
        }

    }

    function loginCuenta($numero,$contrasena,$id_usuario){
        $cuenta = new Cuenta();
        $id = $cuenta->login($numero,$contrasena,$id_usuario);

        if($id){
            $url = BASE_URL.'dashboard2.php';
            header("Location: $url");
        }else{
            return "<h2> Por favor, revise sus credenciales. </h2>";
        }

    }

    function loginTraba($nombre,$contrasena){
        $traba = new Trabajador();
        $id = $traba->login($nombre,$contrasena);

        if($id){
            $url = BASE_URL.'dashboard3.php';
            header("Location: $url");
        }else{
            return "<h2> Por favor, revise sus credenciales. </h2>";
        }

    }

?>