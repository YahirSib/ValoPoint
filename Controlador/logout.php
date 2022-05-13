<?php

    require_once('../Modelo/class.conexion.php');
    session_start();
    $session_id = '';
    $_SESSION['id_usuario'] = '';
    session_destroy();

    if(empty($session_id) && empty($_SESSION['id_usuario'])){
        $url=BASE_URL.'index.html';
	    header("Location: $url");
    }

?>