<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if (isset($_POST['id_pre']) && $_POST['id_pre'] != "") {
    $db_conexion->consultar("id, fecha_inicio, fecha_corte, numero_renovacion", "renovacion", "prestamo_id", "=", $_POST['id_pre'] . " AND estado = " . 1, TRUE);

    while ($row7 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_ren = $row7[0];
        $fecha_ini_ren = $row7[1];
        $fecha_fin_ren = $row7[2];
        $num_ren = $row7[3];
    }
    $db_conexion->consultar("*", "prestamo", "id", "=", $_POST['id_pre'], TRUE);


    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row['id'];
        $fech_ini_p = $row['fecha_inicio'];
        $fech_cor_p = $row['fecha_corte'];
        $estado_p = $row['estado'];
        $per_p = $row['persona_id'];
        $id_li = $row['libro_id'];
    }
    $db_conexion->consultar("id, nombres, apellidos, mail", "persona", "id", "=", $per_p, TRUE);

    while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_p = $row2[0];
        $nom_p = $row2[1];
        $ape = $row2[2];
        $mail = $row2[3];
    }
    session_start();
    $db_conexion->consultar("id, nombres, apellidos, mail", "persona", "id", "=", $_SESSION['id'], TRUE);

    while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_p_s = $row3[0];
        $nom_p_s = $row3[1];
        $ape_s = $row3[2];
        $mail_s = $row3[3];
    }
    $db_conexion->consultar("id, nombre, autor", "libro", "id", "=", $id_li, TRUE);

    while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_l = $row4[0];
        $nom_l = $row4[1];
        $aut = $row4[2];
    }

    if (isset($id_ren) && $id_ren != "") {
        $fecha_actual = strtotime(date("d-m-Y"));
        $fecha_corte_ren = strtotime($fecha_fin_ren);


        if ($fecha_actual > $fecha_corte_ren) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4" id="renovar" name="renovar"><b><?php
                    if (isset($id_p) && $id_p != "") {
                        echo $nom_p . " " . $ape;
                    }
                    ?> </b>tiene el prestamo vencido porque se debia entregar el libro <b><?php
                    if (isset($id_l) && $id_l != "") {
                        echo $nom_l . " - " . $aut;
                    }
                    ?></b> en la fecha <b><?php
                        if (isset($fecha_fin_ren) && $fecha_fin_ren != "") {
                            echo $fecha_fin_ren;
                        }
                        ?></b> y presenta <b><?php
                        if (isset($id) && $id != "") {

                            list($ano2, $mes2, $dia2) = explode("-", date("y-m-d"));
                            $fecha1 = $fecha_fin_ren;
                            list($ano1, $mes1, $dia1) = explode("-", $fecha1);
                            $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
                            $timestamp2 = mktime(4, 12, 0, $mes2, $dia2, $ano2);
                            $segundos_diferencia = $timestamp1 - $timestamp2;
                            $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
                            $dias_diferencia = abs($dias_diferencia);
                            $dias_diferencia = floor($dias_diferencia);

                            echo $dias_diferencia;
                        }
                        ?></b> dias de atraso.
                <br>En total debe cancelar <b>$ <?php
                    if (isset($id) && $id != "") {
                        echo $total = $dias_diferencia * 200;
                    }
                    ?></b><br><h4> ¿aún asi quiere continuar?</h4></div> 
            <div class="col-xs-12">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="btn-group col-xs-6">
                        <button type="button" class="btn btn-default col-xs-12" id="no" name="no">NO</button> 
                    </div>
                    <div class="btn-group-vertical col-xs-6" role="group" aria-label="...">
                        <button type="button" class="btn btn-default col-xs-12" id="pagar" name="pagar">SI, Pagar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="abonar" name="abonar">SI, Abonar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="condonar" name="condonar">SI, Condonar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="bloquear" name="bloquear">SI, Bloquear</button>
                    </div>

                </div>
            </div>
            <?php
        } else if ($fecha_actual <= $fecha_corte_ren) {


            $db_conexion->actualizar("prestamo", "estado", "2", "id", "=", $id, TRUE);

            $db_conexion->actualizar("renovacion", "estado", "2", "prestamo_id ", "=", $id, TRUE);
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><b>Libro devuelto correctamente</b></div>
            <?php
//enviar correo
            $destino = $mail;
            $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
            $asunto = "Entrega De Libro";
            $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado la entrega del libro " . $nom_l . " - " . $aut . ", agradecemos tu puntualidad en la entrega cuando quieras puedes prestar otro libro :) ";
            mail($destino, $asunto, $mensaje, $de);
            ?>
            <div class="btn-group col-xs-10 col-xs-offset-1" role="group" aria-label="...">
                <button type="button" class="btn btn-default col-xs-6" id="vol_lib" name="vol_lib"><b>Prestar el libro:</b> <?php echo $nom_l . " - " . $aut; ?> <b>A otra persona</b></button>
                <button type="button" class="btn btn-default col-xs-6" id="vol_per" name="vol_per"><b>Prestar a:</b> <?php echo $nom_p . " - " . $ape; ?> <b>Otro libro</b></button>
                <a class="btn btn-default col-xs-12" href="#" role="button"><b>Volver</b></a>
            </div>
            <?php
        }
    } else if (!isset($id_ren)) {

        $fecha_actual = strtotime(date("d-m-Y"));
        $fecha_corte_pre = strtotime($fech_cor_p);


        if ($fecha_actual > $fecha_corte_pre) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4" id="renovar" name="renovar"><b><?php
            if (isset($id_p) && $id_p != "") {
                echo $nom_p . " " . $ape;
            }
            ?> </b>tiene el prestamo vencido porque se debia entregar el libro <b><?php
            if (isset($id_l) && $id_l != "") {
                echo $nom_l . " - " . $aut;
            }
            ?></b> en la fecha <b><?php
                    if (isset($fech_cor_p) && $fech_cor_p != "") {
                        echo $fech_cor_p;
                    }
                    ?></b> y presenta <b><?php
                        if (isset($id) && $id != "") {

                            list($ano2, $mes2, $dia2) = explode("-", date("y-m-d"));
                            $fecha1 = $fech_cor_p;
                            list($ano1, $mes1, $dia1) = explode("-", $fecha1);
                            $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
                            $timestamp2 = mktime(4, 12, 0, $mes2, $dia2, $ano2);
                            $segundos_diferencia = $timestamp1 - $timestamp2;
                            $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
                            $dias_diferencia = abs($dias_diferencia);
                            $dias_diferencia = floor($dias_diferencia);

                            echo $dias_diferencia;
                        }
                        ?></b> dias de atraso.
                <br>En total debe cancelar <b>$ <?php
                        if (isset($id) && $id != "") {
                            echo $total = $dias_diferencia * 200;
                        }
                        ?></b><br><h4> ¿aún asi quiere continuar?</h4></div> 
            <div class="col-xs-12">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="btn-group col-xs-6">
                        <button type="button" class="btn btn-default col-xs-12" id="no" name="no">NO</button> 
                    </div>
                    <div class="btn-group-vertical col-xs-6" role="group" aria-label="...">
                        <button type="button" class="btn btn-default col-xs-12" id="pagar" name="pagar">SI, Pagar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="abonar" name="abonar">SI, Abonar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="condonar" name="condonar">SI, Condonar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="bloquear" name="bloquear">SI, Bloquear</button>
                    </div>

                </div>
            </div>
            <?php
        } else if ($fecha_actual <= $fecha_corte_pre) {


            $db_conexion->actualizar("prestamo", "estado", "2", "id", "=", $id, TRUE);

            $db_conexion->actualizar("renovacion", "estado", "2", "prestamo_id ", "=", $id, TRUE);
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><b>Libro devuelto correctamente</b></div>
            <?php
//enviar correo
            $destino = $mail;
            $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
            $asunto = "Entrega De Libro";
            $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado la entrega del libro " . $nom_l . " - " . $aut . ", agradecemos tu puntualidad en la entrega cuando quieras puedes prestar otro libro :) ";
            mail($destino, $asunto, $mensaje, $de);
            ?>
            <div class="btn-group col-xs-10 col-xs-offset-1" role="group" aria-label="...">
                <button type="button" class="btn btn-default col-xs-6" id="vol_lib" name="vol_lib"><b>Prestar el libro:</b> <?php echo $nom_l . " - " . $aut; ?> <b>A otra persona</b></button>
                <button type="button" class="btn btn-default col-xs-6" id="vol_per" name="vol_per"><b>Prestar a:</b> <?php echo $nom_p . " - " . $ape; ?> <b>Otro libro</b></button>
                <a class="btn btn-default col-xs-12" href="#" role="button"><b>Volver</b></a>
            </div>
            <?php
        }
    }
}
?>
<script type="text/javascript">
    $(document).on("ready", function () {
        $("#vol_lib").click(function () {
            document.form_lib.submit();

        });
        $("#vol_per").click(function () {
            document.form_per.submit();

        });
        $("#no").click(function () {
            document.form_no.submit();

        });
        $("#pagar").click(function () {
            document.form_pag.submit();

        });
        $("#abonar").click(function () {
            document.form_abo.submit();

        });
        $("#condonar").click(function () {
            document.form_con.submit();

        });
        $("#bloquear").click(function () {
            document.form_blo.submit();

        });
    });
</script>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_per">
    <input type="hidden" id="id_per" name="id_per" value="<?php echo $id_p; ?>">
</form>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_lib">
    <input type="hidden" id="id_libr" name="id_libr" value="<?php echo $id_l; ?>">
</form>
<form action="../dir_res_bus/info_prestamo.php" method="post" target="contenedor" name="form_no">
    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
</form>
<form action="../dir_devolver/devolver_pago.php" method="post" target="contenedor" name="form_pag">
    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="fecha" name="fecha" value="<?php if(isset($fecha_fin_ren) && $fecha_fin_ren !=""){
        
        echo $fecha_fin_ren;
    }else if(isset($fech_cor_p) && $fech_cor_p !=""){
        echo $fech_cor_p;
    }
?>">
    
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
</form>
<form action="../dir_devolver/devolver_abono.php" method="post" target="contenedor" name="form_abo">
    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="fech_cor_p" name="fech_cor_p" value="<?php if(isset($fecha_fin_ren) && $fecha_fin_ren !=""){
        
        echo $fecha_fin_ren;
    }else if(isset($fech_cor_p) && $fech_cor_p !=""){
        echo $fech_cor_p;
    }
?>">
    
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
    <input type="hidden" id="id_per" name="id_per" value="<?php echo $id_p; ?>">
</form>
<form action="../dir_devolver/devolver_condonado.php" method="post" target="contenedor" name="form_con">
    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="fecha" name="fecha" value="<?php if(isset($fecha_fin_ren) && $fecha_fin_ren !=""){
        
        echo $fecha_fin_ren;
    }else if(isset($fech_cor_p) && $fech_cor_p !=""){
        echo $fech_cor_p;
    }
?>">
    
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
</form>
<form action="../dir_devolver/devolver_bloqueado.php" method="post" target="contenedor" name="form_blo">
    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="fecha" name="fecha" value="<?php if(isset($fecha_fin_ren) && $fecha_fin_ren !=""){
        
        echo $fecha_fin_ren;
    }else if(isset($fech_cor_p) && $fech_cor_p !=""){
        echo $fech_cor_p;
    }
?>">
    
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
</form>