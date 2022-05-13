<?php
session_start();
require_once("Modelo/class.conexion.php");
require_once("Modelo/class.cuenta.php");
require_once("Modelo/class.operaciones.php");

    function retiro($monto, $id_cuenta, $id_usuario, $metodo){
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
            if($detalles->Monto > $monto){
                if($detalles->Tipo == "Ahorro"){
                    if($detalles->OperaGratis == 0){
                        $x = ($detalles->Intereses / 100);
                        $montoFin = $monto - ($monto * $x);
                        $interes = $detalles->Intereses;
                        $montoFin = $detalles->Monto - $montoFin;
                    }else{
                        $opeCant = ($detalles->OperaGratis - 1);
                        if($opeCant == 0 ){
                            $interes = 1;
                        }
                        $montoFin = $detalles->Monto - $monto;
                    }
                }else{
                    $montoFin = $detalles->Monto - $monto;
                    $opeCant = null;
                    $interes = null;
                }

                $deposito = $cuenta->updateCuenta($montoFin,$interes,$opeCant,$id_cuenta);

                date_default_timezone_set('America/El_Salvador');
                $fecha = date("d-m-Y (g:i A)");
                $operacion = new Operaciones();
                $proceso = "Retiro en Cuenta Propia";
                $numero = null;
                $operacion -> guardarOpe($id_usuario, $id_cuenta, $proceso, $monto, $fecha, $metodo, $numero);

                if($deposito){
                    return "<h2> Proceso Exitoso </h2>";
                }else{
                    return "<h2> Error </h2>";
                }

            }else{
                return "<h2> El monto a retirar excede el monto que existe en la cuenta </h2>";
            }
        }else{
            if(!$monto_check){
                return "<h2>Verifique el monto a retirar</h2>";
            }
            if(!$metodo_check){
                return "<h2>Verifique la metodo de retiro</h2>";
            }
        }

    }

?>