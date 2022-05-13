<?php

require_once("Modelo/class.conexion.php");
require_once("Modelo/class.cuenta.php");
require_once("Modelo/class.operaciones.php");

function saldo($id_cuenta, $id_usuario){
    $cuenta = new Cuenta();
    $detalles = $cuenta->detallesCuenta($id_cuenta);

    if(empty($detalles)){
        echo "<h2> No hay nada en el objeto. </h2>";
    }else{
        date_default_timezone_set('America/El_Salvador');
        $fecha = date("d-m-Y (g:i A)");
        echo '
        <div class="caja">
            <p>Le cuenta <span>'.$detalles->Numero.'</span> tiene un saldo de 
                <span>'.$detalles->Monto.'</span> en la fecha <span>'.$fecha.'</span>.</p>
            <div class="boton">
                <a href="dashboard2.php" class="btn">Regresar</a>
            </div>    
        </div>
        ';
        $operacion = new Operaciones();
        $metodo = null;
        $proceso = "Consulta de Saldo";
        $monto = null;
        $numero = null;
        $save = $operacion -> guardarOpe($id_usuario, $id_cuenta, $proceso, $monto, $fecha,$metodo, $numero);
    }

}

?>

