<?php

    require_once('../Modelo/class.conexion.php');
    session_start();
    $session_id = '';
    $_SESSION['id_cuenta'] = '';

    if(empty($session_id) && empty($_SESSION['id_cuenta'])){
        $url=BASE_URL.'dashboard.php';
	    header("Location: $url");
    }

?>