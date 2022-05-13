<?php
require_once('Controlador/deposito.php');
$error = '';

if(!isset($_SESSION['id_cuenta']) || $_SESSION['id_cuenta'] == ''){
    header("location: dashboard.php");
}

if(!empty($_POST['deposito'])){
    $monto = $_POST['monto'];
    $metodo = $_POST['metodo'];
    $cuenta = $_POST['cuenta'];

    if(strlen(trim($monto)) > 1 && strlen(trim($metodo)) > 1 && strlen(trim($cuenta)) > 1){
        $error = depositoExter($monto,$_SESSION['id_cuenta'],$_SESSION['id_usuario'],$metodo, $cuenta);
    }else{
        $error = "<h2>Por favor llene los campos</h2>";
    }

}

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
    <link rel="stylesheet" href="css/deposito.css">
    <title>Depositar | ValoPoint</title>
</head>
<body>
    <nav id="menu" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a id="text" class="navbar-brand" href="dashboard2.php">
                <img src="img/icono_blanco.png" alt="" width="60" height="60">
            </a>
            <button id="bot" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
              <span id="ham" class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                <h5 id="h5" class="offcanvas-title" id="offcanvasNavbarLabel">ValoPoint</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.loginCuenta.php">Retiro</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.selectDeposito.php">Deposito</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.reporte.php">Reporte</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.saldoCuenta.php">Saldo</a>
                  </li>
                  <li class="nav-item">
                    <a id="text-active" class="nav-link active" href="Controlador/logoutCuenta.php">Cerrar Cuenta</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
    </nav>
    <article>
        <section class="info">
            <form method="post" name="deposito" action="vis.depositoExterno.php">
                <label for="">Monto:</label>
                <input type="text" placeholder="00.00" name="monto">
                <label for="">Metodo</label>
                <select name="metodo" id="">
                    <option value="Efectivo">Efectivo</option>
                    <option value="Cheque">Cheque</option>
                </select>
                <label for="">Cuenta a Depositar:</label>
                <input type="text" name="cuenta" placeholder="XXXXXX-XXXXXX" >
                <div class="boton">
                    <input class="btn" type="submit" name="deposito" value="Depositar">
                </div>
                <div class="errorMsg"><?php echo $error; ?></div>
            </form>
        </section>
        <section class="tit">
            <h1>Deposito Cuenta</h1>
            <h1 class="sub">Externa</h1>
        </section>
    </article>

    
</body>
</html>