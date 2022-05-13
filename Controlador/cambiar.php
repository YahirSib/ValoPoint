<?php

if(!isset($_SESSION['id_trabajador'])){
    header("location: index.html");
}

require_once('Modelo/class.conexion.php');
require_once('Modelo/class.cuenta.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/agregar.css">
    <title>Retiro | ValoPoint</title>
</head>
<body>
    <?php
        function cambiar($id_cuenta){
            $cuenta = new Cuenta();
            $detalles = $cuenta->detallesCuenta($id_cuenta);
            if($detalles->OperaGratis == 5){
                $mensaje = "<h2> Operaciones Gratis ya estan en su numero base </h2>";
            }else{
                $operaciones = 5;
                $intereses = 0;
    
                $update = $cuenta->updateInOp($id_cuenta, $operaciones,$intereses);

                if($update){
                    $mensaje = "<h2> Proceso Exitoso </h2>";
                }else{
                    $mensaje = "<h2> Error </h2>";
                }
            }

            echo'
            
            <article>
            <section class="tit">
                <h1>Reinicio</h1>
                <h1 class="sub">Resultado</h1>
            </section>
            <section class="form">
            <form method="post" action="" name="nueva" enctype="multipart/form-data" >
                ';
            echo $mensaje;
            echo'
                <div class="boton">
                    <a class="btn" href="dashboard3.php"> Regresar </a>
                </div>
                <div class="errorMsg"><?php echo $error; ?></div>
            </form>
        </section>
    </article>

            ';

        }

        function cambiarInte($id_cuenta){
            $intereses = $_POST["intereses"];
            $cuenta = new Cuenta();
            $detalles = $cuenta->detallesCuenta($id_cuenta);
            if($intereses == 1 || $intereses == 1.5 || $intereses == 2 || $intereses == 3 ){
                if($detalles->OperaGratis == 0){
                    $operaciones = 0;
                    $update = $cuenta->updateInOp($id_cuenta, $operaciones,$intereses);
                    $mensaje = "<h2> Proceso Exitoso</h2>";
                }else{
                    $mensaje = "<h2> Aun le quedan operaciones gratis a la cuenta: ".$detalles->Numero."</h2>";
                }
            }else{
                $mensaje = "<h2> Interes ingresado incorrecto </h2>";
            }

            echo'
            
            <article>
            <section class="tit">
                <h1>Cambio</h1>
                <h1 class="sub">Intereses</h1>
            </section>
            <section class="form">
            <form method="post" action="" name="nueva" enctype="multipart/form-data" >
                ';
            echo $mensaje;
            echo'
                <div class="boton">
                    <a class="btn" href="dashboard3.php"> Regresar </a>
                </div>
                <div class="errorMsg"><?php echo $error; ?></div>
            </form>
        </section>
    </article>

            ';

        }
    ?>

</body>
