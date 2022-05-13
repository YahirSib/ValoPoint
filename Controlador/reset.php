<?php

function resetear(){
    if(isset($_GET["id_cuenta"])){
        $cuenta = new Cuenta();
        $id_cuenta = $_GET["id_cuenta"];
        $detalles = $cuenta->detallesCuenta($id_cuenta);
        if(isset($_POST["confirmar"])){
            cambiar($id_cuenta);
        }else{
            echo '
        <section class="tit">
            <h1>Resetear</h1>
            <h1 class="sub">Operaciones</h1>
        </section>
        <section class="form">
            <form method="post" action="" name="nueva" enctype="multipart/form-data" >
                <label for="numero">¿Esta seguro de querer reiniciar las operaciones gratis de la cuenta: <br> '.$detalles->Numero.'?</label>
                <label for="tipo">Información actual</label>
            <table>
            <thead>
                <tr>
                    <th>Numero de Cuenta</th>
                    <th>Operaciones Gratis</th>
                    <th>% de Recargo</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>'.$detalles->Numero.'</td>
                        <td>'.$detalles->OperaGratis.'</td>
                        <td>'.$detalles->Intereses.'%</td>
                        <?php
                    </tr>
            </tbody>
        </table>
                <div class="boton">
                    <input class="btn" type="submit" name="confirmar" value="Si">
                    <a class="btn" href="dashboard3.php">No</a>
                </div>
                <div class="errorMsg"><?php echo $error; ?></div>
            </form>
        </section>
        ';
        }
    }
}

function interes(){
    if(isset($_GET["id_cuenta"])){
        $cuenta = new Cuenta();
        $id_cuenta = $_GET["id_cuenta"];
        $detalles = $cuenta->detallesCuenta($id_cuenta);
        if(isset($_POST["confirmar"])){
            cambiarInte($id_cuenta);
        }else{
            echo '
        <section class="tit">
            <h1>Cambio % de</h1>
            <h1 class="sub">intereses</h1>
        </section>
        <section class="form">
            <form method="post" action="" name="nueva" enctype="multipart/form-data" >
                <label for="numero">Cambio de porcentaje de interes de la cuenta: '.$detalles->Numero.'</label>
                <label for="tipo">Información actual</label>
            <table>
            <thead>
                <tr>
                    <th>Numero de Cuenta</th>
                    <th>Operaciones Gratis</th>
                    <th>% de Recargo</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>'.$detalles->Numero.'</td>
                        <td>'.$detalles->OperaGratis.'</td>
                        <td>'.$detalles->Intereses.'%</td>
                        <?php
                    </tr>
            </tbody>
        </table>
            <select name="intereses" id="">
                <option value="1">1%</option>
                <option value="1.5">1.5%</option>
                <option value="2">2%</option>
                <option value="3">3%</option>
            </select>
                <div class="boton">
                    <input class="btn" type="submit" name="confirmar" value="Cambiar">
                    <a class="btn" href="dashboard3.php">Cancelar</a>
                </div>
                <div class="errorMsg"><?php echo $error; ?></div>
            </form>
        </section>
        ';
        }
    }
}

?>