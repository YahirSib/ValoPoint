<?php

    class Cuenta{

        public function cuentaNueva($id_usuario, $numero, $contrasena, $tipo, $monto, $intereses, $operaGratis){
            try{
                $modelo = new Conexion();
                $db = $modelo -> get_conexion();
                $stmt = $db -> prepare("SELECT Numero FROM cuentas WHERE Numero = :numero");
                $stmt -> bindParam("numero", $numero, PDO::PARAM_STR);
                $stmt -> execute();
                $count = $stmt -> rowCount();

                if($count < 1){
                    $st = $db -> prepare("INSERT INTO cuentas(id_usuario, Numero, Contrasena, Tipo, Monto, Intereses, OperaGratis)
                                            VALUES (:id ,:numero, :contrasena, :tipo, :monto, :intereses, :operaGratis)");
                    $st -> bindParam("id",$id_usuario,PDO::PARAM_INT);
                    $st -> bindParam("numero",$numero,PDO::PARAM_STR);
                    $contra_hash = hash('sha256',$contrasena);
                    $st -> bindParam("contrasena",$contra_hash,PDO::PARAM_STR);
                    $st -> bindParam("tipo",$tipo,PDO::PARAM_STR);
                    $st -> bindParam("monto",$monto,PDO::PARAM_STR);
                    $st -> bindParam("intereses",$intereses,PDO::PARAM_STR);
                    $st -> bindParam("operaGratis",$operaGratis,PDO::PARAM_INT);
                    $st -> execute();
                    return true;
                }

                return false;

            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            }
        }

        public function login($numero,$contrasena,$id_usuario){
            try{
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $contra_hash = hash('sha256',$contrasena);
                $stmt = $db->prepare("SELECT id_cuenta FROM cuentas WHERE Numero = :numero AND Contrasena = :contra AND id_usuario = :id_usuario");
                $stmt->bindParam("numero",$numero,PDO::PARAM_STR);
                $stmt->bindParam("contra",$contra_hash,PDO::PARAM_STR);
                $stmt->bindParam("id_usuario",$id_usuario,PDO::PARAM_INT);
                $stmt->execute();
                $count = $stmt->rowCount();
                $data = $stmt->fetch();
                $db = null;

                if($count){
                    $_SESSION['id_cuenta'] = $data['id_cuenta'];
                    return true;
                }else{
                    return false;
                }

            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function verCuentas($id_usuario){
            try{
                $cuentas = null;
                $modelo = new Conexion();
                $db = $modelo -> get_conexion();
                $stmt = $db->prepare("SELECT Numero, Tipo, Intereses, OperaGratis FROM cuentas WHERE id_usuario = :id_usuario");
                $stmt -> bindParam("id_usuario",$id_usuario,PDO::PARAM_INT);
                $stmt -> execute();

                while($result = $stmt->fetch()){
                    $cuentas[] = $result;
                }

                return $cuentas;

            }catch(Exception $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function detallesCuenta($id){
            try{
                $row = null;
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $stmt = $db->prepare("SELECT Numero, Tipo, Monto, Intereses, OperaGratis FROM cuentas WHERE id_cuenta = :id");
                $stmt->bindParam("id",$id,PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function updateCuenta($monto, $intereses, $operaGratis, $id_cuenta){
            try{
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $stmt = $db->prepare("UPDATE cuentas set Monto = :monto, Intereses = :intereses, OperaGratis = :operaGratis WHERE id_cuenta = :id_cuenta");
                $stmt -> bindParam("monto",$monto,PDO::PARAM_STR);
                $stmt -> bindParam("intereses",$intereses,PDO::PARAM_INT);
                $stmt -> bindParam("operaGratis",$operaGratis,PDO::PARAM_STR);
                $stmt -> bindParam("id_cuenta",$id_cuenta,PDO::PARAM_INT);
                $stmt->execute();
                return true;

            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function verificar($numero){
            try{
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $stmt = $db->prepare("SELECT id_cuenta FROM cuentas WHERE Numero = :numero");
                $stmt->bindParam("numero",$numero,PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $data = $stmt->fetch();
                $db = null;

                if($count){
                    return $data['id_cuenta'];
                }else{
                    return false;
                }

            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function reporteCuenta($id_cuenta){
            try{
                $fechas = null;
                $modelo = new Conexion();
                $db = $modelo -> get_conexion();
                $stmt = $db->prepare("SELECT Proceso, Monto, FechaHora, Metodo, CuentaExter FROM operaciones WHERE id_cuenta = :id_cuenta");
                $stmt -> bindParam("id_cuenta",$id_cuenta,PDO::PARAM_INT);
                $stmt -> execute();

                while($result = $stmt->fetch()){
                    $fechas[] = $result;
                }

                return $fechas;
            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function ahorroCuentas(){
            try{
                $cuentas = null;
                $modelo = new Conexion();
                $db = $modelo -> get_conexion();
                $stmt = $db->prepare("SELECT id_cuenta ,Numero, Tipo, Intereses, OperaGratis FROM cuentas WHERE Tipo = 'Ahorro'");
                $stmt -> execute();

                while($result = $stmt->fetch()){
                    $cuentas[] = $result;
                }

                return $cuentas;

            }catch(Exception $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function updateInOp($id_cuenta, $operaGratis, $intereses){
            try{
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $stmt = $db->prepare("UPDATE cuentas set Intereses = :intereses, OperaGratis = :operaGratis WHERE id_cuenta = :id_cuenta");
                $stmt -> bindParam("operaGratis",$operaGratis,PDO::PARAM_STR);
                $stmt -> bindParam("intereses",$intereses,PDO::PARAM_STR);
                $stmt -> bindParam("id_cuenta",$id_cuenta,PDO::PARAM_INT);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

    }

?>