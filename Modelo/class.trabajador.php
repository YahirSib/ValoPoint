<?php

    class Trabajador{

        public function login($nombre,$contrasena){
            try{
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $contra_hash = hash('sha256',$contrasena);
                $stmt = $db->prepare("SELECT id_traba FROM trabajadores WHERE Nombre = :nombre AND Contrasena = :contra_hash");
                $stmt->bindParam("nombre",$nombre,PDO::PARAM_STR);
                $stmt->bindParam("contra_hash",$contra_hash,PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $data = $stmt->fetch();
                $db = null;

                if($count){
                    $_SESSION['id_trabajador'] = $data['id_traba'];
                    return true;
                }else{
                    return false;
                }

            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

        public function registro($nombre,$apellido,$cargo,$contrasena){
            try{
                $modelo = new Conexion();
                $db = $modelo -> get_conexion();
                $stmt = $db->prepare("SELECT id_traba FROM trabajadores WHERE Nombre = :nombre AND Apellido = :apellido");
                $stmt->bindParam("nombre", $nombre,PDO::PARAM_STR);
                $stmt->bindParam("apellido", $apellido,PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
    
                if($count<1){
                    $st = $db->prepare("INSERT INTO trabajadores(Nombre, Apellido, Cargo, Contrasena) VALUES (:nombre, :apellido, :cargo, :contra_hash)");
                    $st->bindParam("nombre",$nombre,PDO::PARAM_STR);
                    $st->bindParam("apellido",$apellido,PDO::PARAM_STR);
                    $st->bindParam("cargo",$cargo,PDO::PARAM_STR);
                    $contra_hash = hash('sha256',$contrasena);
                    $st->bindParam("contra_hash",$contra_hash,PDO::PARAM_STR);
                    $st->execute();
                    $id = $db->lastInsertId();
                    $db = null;
                    return true;
                }else{
                    $db = null;
                }
                
                return false;
            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
    
        }

        public function detallesTraba($id){
            try{
                $modelo = new Conexion();
                $db = $modelo->get_conexion();
                $stmt = $db->prepare("SELECT Nombre, Apellido, Cargo FROM trabajadores WHERE id_traba = :id");
                $stmt->bindParam("id",$id,PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            }catch(PDOException $e){
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }

    }

?>