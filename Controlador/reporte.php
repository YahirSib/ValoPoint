<?php
    require_once("Modelo/class.conexion.php");
    require_once("Modelo/class.cuenta.php");
    require_once("Modelo/class.operaciones.php");

    function reporte($fecha1,$fecha2,$id){
        $cuenta = new Cuenta();
        $datos = $cuenta -> reporteCuenta($id);
        $i = 0;
        $tabla = "";
        $fecha1 = strtotime($fecha1);
        $fecha2 = strtotime($fecha2);
        if($datos == null){
            return '<h1>No tienes operaciones realizadas</h1>';
        }else{
            foreach($datos as $ope){
                $fecha = explode(" ",$ope['FechaHora']);
                $fecha = strtotime($fecha[0]);
                if($fecha >= $fecha1 && $fecha <= $fecha2){
                    if($ope['Proceso'] == "Consulta de Saldo"){
                        $tabla .= " <tr>
                                        <td>".$ope['Proceso']."</td>
                                        <td>".$ope['FechaHora']."</td>
                                        <td>Consulta del monto de la cuenta</td>
                                    </tr>";
                    }else if($ope['Proceso'] == "Deposito en Cuenta Propia"){
                        $tabla .= " <tr>
                                        <td>".$ope['Proceso']."</td>
                                        <td>".$ope['FechaHora']."</td>
                                        <td>Se realizo un deposito en la propia cuenta con un monto de ".$ope["Monto"].", 
                                            realizando el proceso por medio de: ".$ope["Metodo"]."</td>
                                    </tr>";
                    }else if($ope['Proceso'] == "Deposito en Cuenta Externa"){
                        $detalles = $cuenta->detallesCuenta($ope['CuentaExter']);
                        $tabla .= " <tr>
                                        <td>".$ope['Proceso']."</td>
                                        <td>".$ope['FechaHora']."</td>
                                        <td>Se realizo un deposito en la cuenta: ".$detalles->Numero." con un monto de: ".$ope["Monto"].", 
                                            realizando el proceso por medio de: ".$ope["Metodo"]."</td>
                                    </tr>";
                    }else if($ope['Proceso'] == "Retiro en Cuenta Propia"){
                        $tabla .= " <tr>
                                        <td>".$ope['Proceso']."</td>
                                        <td>".$ope['FechaHora']."</td>
                                        <td>Se realizo un retiro con un monto de: ".$ope["Monto"].", 
                                            realizando el proceso por medio de: ".$ope["Metodo"]."</td>
                                    </tr>";
                    }
                }else{
                    $i++;
                }
            }
            if(sizeof($datos) == $i){
                $tabla .= " <tr>
                                <td colspan='3'>No hay operaciones en el intervalo de fechas ingresado</td>
                            </tr>";
            }
            return $tabla;
        }
    }

?>