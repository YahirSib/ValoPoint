<?php

class Usuarios{

    public function login($nombre,$contrasena){
        try{
            $modelo = new Conexion();
            $db = $modelo -> get_conexion();
            $contra_hash = hash('sha256', $contrasena);
            $stmt = $db->prepare("SELECT id_usuario FROM usuarios WHERE Username = :nombre AND Contrasena = :contra_hash");
            $stmt->bindParam("nombre",$nombre,PDO::PARAM_STR);
            $stmt->bindParam("contra_hash",$contra_hash,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $data = $stmt->fetch();
            $db = null;

            if($count){
                $_SESSION['id_usuario'] = $data['id_usuario'];
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function registro($nombres,$apellidos,$username,$contrasena,$correo,$dui){
        try{
            $modelo = new Conexion();
            $db = $modelo -> get_conexion();
            $stmt = $db->prepare("SELECT id_usuario FROM usuarios WHERE Username = :username");
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();

            if($count<1){
                $st = $db->prepare("INSERT INTO usuarios(Nombres, Apellidos, Username, Contrasena, Correo, DUI) VALUES (:nombres, :apellidos, :username, :contra_hash, :correo, :dui)");
                $st->bindParam("nombres",$nombres,PDO::PARAM_STR);
                $st->bindParam("apellidos",$apellidos,PDO::PARAM_STR);
                $st->bindParam("username",$username,PDO::PARAM_STR);
                $contra_hash = hash('sha256',$contrasena);
                $st->bindParam("contra_hash",$contra_hash,PDO::PARAM_STR);
                $st->bindParam("correo",$correo,PDO::PARAM_STR);
                $st->bindParam("dui",$dui,PDO::PARAM_STR);
                $st->execute();
                $id = $db->lastInsertId();
                $db = null;
                session_start();
                $_SESSION['id_usuario'] = $id;
                return true;
            }else{
                $db = null;
            }
            
            return false;
        }catch(PDOException $e){
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }

    public function detallesUsuario($id){
        try{
            $modelo = new Conexion();
            $db = $modelo->get_conexion();
            $stmt = $db->prepare("SELECT Nombres, Apellidos, Username, Correo, DUI FROM usuarios WHERE id_usuario = :id");
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