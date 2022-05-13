<?php
 session_start();
 require_once("Modelo/class.conexion.php");
 require_once("Modelo/class.cuenta.php");
 require_once("Modelo/class.operaciones.php");

    function depositoCuenta($monto, $id_cuenta, $id_usuario, $metodo){
        $cuenta = new Cuenta();
        $detalles = $cuenta -> detallesCuenta($id_cuenta);
        $monto_check = preg_match('~^([0-9]{0,}).([0-9]{0,})$~', $monto);

        if ($metodo == "Efectivo" || $metodo == "Cheque" ){
            $metodo_check = true;
        }else{
            $metodo_check = false;
        }

        $opeCant = 0;
        $interes = 0;

        if($monto_check && $metodo_check){
            if($detalles->Tipo == "Ahorro"){
                if($detalles->OperaGratis == 0){
                    $x = ($detalles->Intereses / 100);
                    $montoFin = $monto - ($monto * $x);
                    $interes = $detalles->Intereses;
                    $montoFin = $detalles->Monto + $montoFin;
                }else{
                    $opeCant = ($detalles->OperaGratis - 1);
                    if($opeCant == 0 ){
                        $interes = 1;
                    }
                    $montoFin = $monto + $detalles->Monto;
                }
            }else{
                $montoFin = $monto + $detalles->Monto;
                $opeCant = null;
                $interes = null;
            }

            $deposito = $cuenta->updateCuenta($montoFin,$interes,$opeCant,$id_cuenta);

            date_default_timezone_set('America/El_Salvador');
            $fecha = date("d-m-Y (g:i A)");
            $operacion = new Operaciones();
            $proceso = "Deposito en Cuenta Propia";
            $numero = null;
            $operacion -> guardarOpe($id_usuario, $id_cuenta, $proceso, $monto, $fecha, $metodo, $numero);

            if($deposito){
                return "<h2> Proceso Exitoso </h2>";
            }else{
                return "<h2> Error </h2>";
            }

        }else{
            if(!$monto_check){
                return "<h2>Verifique el monto a depositar</h2>";
            }
            if(!$metodo_check){
                return "<h2>Verifique la metodo de deposito</h2>";
            }
        }

        
    }


    function depositoExter($monto, $id_cuenta, $id_usuario, $metodo, $numero){
        $objeto = new Cuenta();
        
            $monto_check = preg_match('~^([0-9]{0,}).([0-9]{0,})$~', $monto);
            $numero_check = preg_match('~(^\d{6})-(\d{6}$)~',$numero);
    
            if ($metodo == "Efectivo" || $metodo == "Cheque" ){
                $metodo_check = true;
            }else{
                $metodo_check = false;
            }

            $opeCant = 0;
            $interes = 0;

            if($monto_check && $numero_check && $metodo_check){
                $check = $objeto -> verificar($numero);
                if($check){
                    $numero = $check;
                    $detalles = $objeto -> detallesCuenta($numero);
                    if($detalles->Tipo == "Ahorro"){
                        if($detalles->OperaGratis == 0){
                            $x = ($detalles->Intereses / 100);
                            $montoFin = $monto - ($monto * $x);
                            $interes = $detalles->Intereses;
                            $montoFin = $detalles->Monto + $montoFin;
                        }else{
                            $opeCant = ($detalles->OperaGratis - 1);
                            if($opeCant == 0 ){
                                $interes = 1;
                            }
                            $montoFin = $monto + $detalles->Monto;
                        }
                    }else{
                        $montoFin = $monto + $detalles->Monto;
                        $opeCant = null;
                        $interes = null;
                    }
    
                    $deposito = $objeto->updateCuenta($montoFin,$interes,$opeCant,$numero);
    
                    date_default_timezone_set('America/El_Salvador');
                    $fecha = date("d-m-Y (g:i A)");
                    $operacion = new Operaciones();
                    $proceso = "Deposito en Cuenta Externa";
                    $operacion -> guardarOpe($id_usuario, $id_cuenta, $proceso, $monto, $fecha, $metodo, $numero);
    
                    if($deposito){
                        return "<h2> Proceso Exitoso </h2>";
                    }else{
                        return "<h2> Error </h2>";
                    }
                }else{
                    return "<h2>La cuenta a depositar no existe</h2>";
                }  
            }else{
                if(!$monto_check){
                    return "<h2>Verifique el monto a depositar</h2>";
                }
                if(!$metodo_check){
                    return "<h2>Verifique la metodo de deposito</h2>";
                }
                if(!$numero_check){
                    return "<h2>Verifique el formato de la cuenta ingresada</h2>";
                }
            }
    }

?>