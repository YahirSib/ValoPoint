<?php

    class Operaciones{

        public function guardarOpe($id_usuario, $id_cuenta, $proceso, $monto, $fecha, $metodo, $numero){
            try{
                
                $modelo = new Conexion();
                $db = $modelo -> get_conexion();
                $stmt = $db -> prepare("INSERT INTO operaciones(id_cuenta, id_usuario, Proceso, Monto, FechaHora, Metodo, CuentaExter)
                                        VALUES (:id_cuenta, :id_usuario, :Proceso, :Monto, :FechaHora, :Metodo, :Numero)");
                $stmt -> bindParam("id_cuenta",$id_cuenta,PDO::PARAM_INT);
                $stmt -> bindParam("id_usuario",$id_usuario,PDO::PARAM_INT);
                $stmt -> bindParam("Proceso",$proceso,PDO::PARAM_STR);
                $stmt -> bindParam("Monto",$monto,PDO::PARAM_STR);
                $stmt -> bindParam("FechaHora",$fecha,PDO::PARAM_STR);
                $stmt -> bindParam("Metodo",$metodo,PDO::PARAM_STR);
                $stmt -> bindParam("Numero",$numero,PDO::PARAM_STR);
                $stmt -> execute();
                return true;

            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            }
        }

    }

?>