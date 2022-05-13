<?php
    require_once('Modelo/class.conexion.php');
    require_once('Modelo/class.usuarios.php');
    require_once('Modelo/class.cuenta.php');
    require_once('Modelo/class.trabajador.php');

    function registroUsuario($nombres,$apellidos,$username,$contrasena,$correo,$dui){

        $usuario = new Usuarios();
        $nombres_check = preg_match('~^(?=.{3,40}$)[a-zñáéíóúA-ZÑÁÉÍÓÚ](\s?[a-zñáéíóúA-ZÑÁÉÍÓÚ])*$~',$nombres);
        $apellidos_check = preg_match('~^(?=.{3,40}$)[a-zñáéíóúA-ZÑÁÉÍÓÚ](\s?[a-zñáéíóúA-ZÑÁÉÍÓÚ])*$~',$apellidos);
        $username_check = preg_match('~^[A-ZÑa-zñ0-9_]{3,20}$~i',$username);
        $contrasena_check = preg_match('~^[A-ZÑa-zñ0-9!@#$%^&*.()_]{2,20}$~i', $contrasena);
        $correo_check = preg_match('~^(((([a-z\d][\.\-\+_]?)*)[a-z0-9])+)\@(((([a-z\d][\.\-_]?){0,62})[a-z\d])+)\.([a-z\d]{2,6})$~i',$correo);
        $dui_check = preg_match('~(^\d{8})-(\d$)~',$dui);

        if($nombres_check && $apellidos_check && $username_check && $contrasena_check && $correo_check && $dui_check){
            $conf = $usuario->registro($nombres,$apellidos,$username,$contrasena,$correo,$dui);
            if(!$conf){
                echo '<h2>Username ya previamente registrado</h2>';
            }else{
                $url=BASE_URL.'dashboard.php';
				header("Location: $url"); 
            }
        }else{
            if(!$nombres_check){
                return "<h2>Verifique los nombres del usuario</h2>";
            }
            if(!$apellidos_check){
                return "<h2>Verifique los apellidos del usuario</h2>";
            }
            if(!$username_check){
                return "<h2>Verifique el username del usuario</h2>";
            }
            if(!$contrasena_check){
                return "<h2>Verifique la contraseña ingresada</h2>";
            }
            if(!$correo_check){
                return "<h2>Verifique el correo ingresada</h2>";
            }
            if(!$dui_check){
                return "<h2>Verifique lel dui ingresada</h2>";
            }
        }

    }


    function registroCuenta($numero, $contra, $tipo, $monto){

        $cuenta = new Cuenta();
        $numero_check = preg_match('~(^\d{6})-(\d{6}$)~',$numero);
        $contra_check = preg_match('~^[A-ZÑa-zñ0-9!@#$%^&*.()_]{2,20}$~i', $contra);
        
        if ($tipo == "Ahorro" || $tipo == "Empresarial" || $tipo == "Personal"){
            $tipo_check = true;
        }else{
            $tipo_check = false;
        }

        $monto_check = preg_match('~^([0-9]{0,}).([0-9]{0,})$~', $monto);

        if($numero_check && $contra_check && $tipo_check && $monto_check){
            $id_usuario = $_SESSION['id_usuario'];

            if($tipo != "Ahorro"){
                $intereses = null;
                $operaGratis = null;
            }else{
                $intereses = "0";
                $operaGratis = 5;
            }

            $conf = $cuenta->cuentaNueva($id_usuario, $numero, $contra, $tipo, $monto, $intereses, $operaGratis);

            if(!$conf){
                echo '<h2>Numero de cuenta ya previamente registrado</h2>';
            }else{
                $url=BASE_URL.'dashboard.php';
				header("Location: $url"); 
            }

        }else{
            if(!$numero_check){
                return "<h2>Verifique el numero de la cuenta</h2>";
            }
            if(!$contra_check){
                return "<h2>Verifique la contraseña de la cuenta</h2>";
            }
            if(!$tipo_check){
                return "<h2>Verifique el tipo de la cuenta</h2>";
            }
            if(!$monto_check){
                return "<h2>Verifique el monto inicial de la cuenta</h2>";
            }
        }


    }

    function registroTrabajador($nombre, $apellido, $cargo, $contrasena){

        $cuenta = new Trabajador();
        $nombre_check = preg_match('~^(?=.{3,40}$)[a-zñáéíóúA-ZÑÁÉÍÓÚ](\s?[a-zñáéíóúA-ZÑÁÉÍÓÚ])*$~',$nombre);
        $apellido_check = preg_match('~^(?=.{3,40}$)[a-zñáéíóúA-ZÑÁÉÍÓÚ](\s?[a-zñáéíóúA-ZÑÁÉÍÓÚ])*$~',$apellido);
        $contrasena_check = preg_match('~^[A-ZÑa-zñ0-9!@#$%^&*.()_]{2,20}$~i', $contrasena);

        if ($cargo == "Jefe" || $cargo == "Administrador" ){
            $cargo_check = true;
        }else{
            $cargo_check = false;
        }

        if($nombre_check && $apellido_check && $cargo_check && $contrasena_check){


            $conf = $cuenta->registro($nombre, $apellido, $cargo, $contrasena);

            if(!$conf){
                echo '<h2>Trabajador previamente creado</h2>';
            }else{
                $url=BASE_URL.'dashboard3.php';
				header("Location: $url"); 
            }

        }else{
            if(!$nombre_check){
                return "<h2>Verifique el nombre del trabajador</h2>";
            }
            if(!$apellido_check){
                return "<h2>Verifique el apellido del trabajador</h2>";
            }
            if(!$cargo_check){
                return "<h2>Verifique el cargo del trabajador</h2>";
            }
            if(!$contrasena_check){
                return "<h2>Verifique la contraseña del trabajador</h2>";
            }
        }


    }



?>