<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if (isset($_POST['id_pre']) && $_POST['id_pre'] != "") {
    $id = $_POST['id_pre'];
    $db_conexion->consultar("id, fecha_inicio, fecha_corte, numero_renovacion", "renovacion", "prestamo_id", "=", $id . " AND estado = " . 1, TRUE);

    while ($row7 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_ren = $row7[0];
        $fecha_ini_ren = $row7[1];
        $fecha_fin_ren = $row7[2];
        $num_ren = $row7[3];
    }
    $db_conexion->consultar("*", "prestamo", "id", "=", $id, TRUE);

   
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

    $fecha = date('Y-m-j');
    $nuevafecha = strtotime('+20 day', strtotime($fecha));
    $nuevafecha = date('Y-m-j', $nuevafecha);
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
                        if (isset($fech_cor_p) && $fech_cor_p != "") {
                            echo $fech_cor_p;
                        }
                        ?></b> y presenta <b><?php
                        if (isset($id) && $id != "") {

                            list($ano2, $mes2, $dia2) = explode("-", $fecha);
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
                    ?></b><br><h4> ¿aún asi quiere continuar con la renovación?</h4></div> 
            <div class="col-xs-12">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="btn-group col-xs-6">
                        <button type="button" class="btn btn-default col-xs-12" id="no" name="no">NO</button> 
                    </div>
                    <div class="btn-group-vertical col-xs-6" role="group" aria-label="...">
                        <button type="button" class="btn btn-default col-xs-12" id="pagar" name="pagar">SI, Pagar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="condonar" name="condonar">SI, Condonar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="bloquear" name="bloquear">SI, Bloquear</button>
                    </div>

                </div>
            </div>
            <?php
        } else if ($fecha_actual <= $fecha_corte_ren) {
            $reno_num = 1;
            if (isset($id_ren) && $id_ren != "" && isset($num_ren) && $num_ren == 1) {
                $reno_num = 2;
                $db_conexion->actualizar("renovacion", "estado", 2, "prestamo_id", "=", $id . " AND estado = " . 1 . " AND numero_renovacion = " . 1, TRUE);
            } else if (isset($id_ren) && $id_ren != "" && isset($num_ren) && $num_ren == 2) {
                $reno_num = 3;
                $db_conexion->actualizar("renovacion", "estado", 2, "prestamo_id", "=", $id . " AND estado = " . 1 . " AND numero_renovacion = " . 2, TRUE);
            } else if (!isset($id_ren)) {
                $num_ren = "";
            }

            if (!isset($num_ren) && $num_ren != 3 || isset($num_ren) && $num_ren != 3) {
                $db_conexion->insertar("renovacion", "fecha_inicio, fecha_corte, numero_renovacion, estado, prestamo_id", "'" . $fecha . "', '" . $nuevafecha . "', " . $reno_num . ", " . TRUE . ", " . $id);
                //enviar correo
                $destino = $mail;
                $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
                $asunto = "Renavacion de prestamo realizada";
                $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado recientemente la renovacion de tu prestamo al libro " . $nom_l . " - " . $aut . ", Recuerda que el libro lo has renovado hoy " . $fecha
                        . " y la nueva fecha limite de entrega es " . $nuevafecha . " para no hacerte merecedor de multa, esta es tu renovacion N° " . $reno_num . " recuerda solo tienes disponibles 3 renovaciones en total"
                        . "\n\nNOTA: si quieres continuar con el libro no olvides hacer tu renovacion a tiempo y tener "
                        . "presente la nueva fecha de entrega. Gracias por tu atencion Exitos con tu lectura. ";

                mail($destino, $asunto, $mensaje, $de);
                ?>

                <h3 class="col-xs-4 col-xs-offset-4">Renovacion realizada con exito!!!</h3>
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="col-xs-12">

                        <div class="jumbotron">
                            <div class="col-xs-12"><b>Fecha de Renovacion: </b><span class="badge"><?php
                                    if (isset($fecha) && $fecha != "") {
                                        echo $fecha;
                                    } else {
                                        echo '-';
                                    }
                                    ?></span></div>
                            <div class="col-xs-12"><b>Nueva fecha de entrega: </b><span class="badge"><?php
                                    if (isset($nuevafecha) && $nuevafecha != "") {
                                        echo $nuevafecha;
                                    } else {
                                        echo '-';
                                    }
                                    ?></span></div>
                            <div class="clearfix"></div>
                            <a class="btn btn-warning btn-lg col-xs-12" href="#" role="button">OK Volver</a>
                        </div>
                    </div>


                </div>
                <?php
            } else if (isset($id_ren) && $num_ren == 3) {
                ?>
                <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>Se ha alcanzado el maximo de renovaciones</b></div>
                <?php
            }
        }
    } else if (!isset($id_ren)) {

        $fecha_actual = strtotime(date("d-m-Y"));
        $fecha_corte_p = strtotime($fech_cor_p);
        if ($fecha_actual > $fecha_corte_p) {
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

                            list($ano2, $mes2, $dia2) = explode("-", $fecha);
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
                    ?></b><br><h4> ¿aún asi quiere continuar con la renovación?</h4></div> 
            <div class="col-xs-12">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="btn-group col-xs-6">
                        <button type="button" class="btn btn-default col-xs-12" id="no" name="no">NO</button> 
                    </div>
                    <div class="btn-group-vertical col-xs-6" role="group" aria-label="...">
                        <button type="button" class="btn btn-default col-xs-12" id="pagar" name="pagar">SI, Pagar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="condonar" name="condonar">SI, Condonar</button>
                        <button type="button" class="btn btn-default col-xs-12" id="bloquear" name="bloquear">SI, Bloquear</button>
                    </div>

                </div>
            </div>
            <?php
        } else if ($fecha_actual <= $fecha_corte_p) {
            $reno_num = 1;
            if (isset($id_ren) && $id_ren != "" && isset($num_ren) && $num_ren == 1) {
                $reno_num = 2;
                $db_conexion->actualizar("renovacion", "estado", 2, "prestamo_id", "=", $id . " AND estado = " . 1 . " AND numero_renovacion = " . 1, TRUE);
            } else if (isset($id_ren) && $id_ren != "" && isset($num_ren) && $num_ren == 2) {
                $reno_num = 3;
                $db_conexion->actualizar("renovacion", "estado", 2, "prestamo_id", "=", $id . " AND estado = " . 1 . " AND numero_renovacion = " . 2, TRUE);
            } else if (!isset($id_ren)) {
                $num_ren = "";
            }

            if (!isset($num_ren) && $num_ren != 3 || isset($num_ren) && $num_ren != 3) {
                $db_conexion->insertar("renovacion", "fecha_inicio, fecha_corte, numero_renovacion, estado, prestamo_id", "'" . $fecha . "', '" . $nuevafecha . "', " . $reno_num . ", " . TRUE . ", " . $id);
               
            } else if (isset($id_ren) && $num_ren == 3) {
                ?>
                <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>Se ha alcanzado el maximo de renovaciones</b></div>
                <?php
            }
            //enviar correo
            $destino = $mail;
            $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
            $asunto = "Renavacion de prestamo realizada";
            $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado recientemente la renovacion de tu prestamo al libro " . $nom_l . " - " . $aut . ", Recuerda que el libro lo has renovado hoy " . $fecha
                    . " y la nueva fecha limite de entrega es " . $nuevafecha . " para no hacerte merecedor de multa, esta es tu renovacion N° " . $reno_num . " recuerda solo tienes disponibles 3 renovaciones en total"
                    . "\n\nNOTA: si quieres continuar con el libro no olvides hacer tu renovacion a tiempo y tener "
                    . "presente la nueva fecha de entrega. Gracias por tu atencion Exitos con tu lectura. ";

            mail($destino, $asunto, $mensaje, $de);
            ?>

            <h3 class="col-xs-4 col-xs-offset-4">Renovacion realizada con exito!!!</h3>
            <div class="col-xs-4 col-xs-offset-4">
                <div class="col-xs-12">

                    <div class="jumbotron">
                        <div class="col-xs-12"><b>Fecha de Renovacion: </b><span class="badge"><?php
                                if (isset($fecha) && $fecha != "") {
                                    echo $fecha;
                                } else {
                                    echo '-';
                                }
                                ?></span></div>
                        <div class="col-xs-12"><b>Nueva fecha de entrega: </b><span class="badge"><?php
                                if (isset($nuevafecha) && $nuevafecha != "") {
                                    echo $nuevafecha;
                                } else {
                                    echo '-';
                                }
                                ?></span></div>
                        <div class="clearfix"></div>
                        <a class="btn btn-warning btn-lg col-xs-12" href="http://colrosario.edu.co/" role="button">OK Volver</a>
                    </div>
                </div>


            </div>
            <?php
        }
    }
}
?>
<script type="text/javascript">
    $(document).on("ready", function () {
        $("#pagar").click(function () {
            document.form_pag.submit();

        });
        $("#condonar").click(function () {
            document.form_cond.submit();

        });
        $("#bloquear").click(function () {
            document.form_bloq.submit();

        });
        $("#no").click(function () {
            document.form_no.submit();

        });
    });
</script>
<form action="../dir_multa/multa_paga.php" method="post" target="contenedor" name="form_pag">

    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="id_per" name="id_per" value="<?php echo $per_p; ?>">
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
    <input type="hidden" id="fech_cor" name="fech_cor" value="<?php echo $fech_cor_p; ?>">

</form>
<form action="../dir_multa/multa_condonada.php" method="post" target="contenedor" name="form_cond">

    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="id_per" name="id_per" value="<?php echo $per_p; ?>">
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
    <input type="hidden" id="fech_cor" name="fech_cor" value="<?php echo $fech_cor_p; ?>">

</form>
<form action="../dir_multa/multa_bloqueo.php" method="post" target="contenedor" name="form_bloq">

    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
    <input type="hidden" id="id_per" name="id_per" value="<?php echo $per_p; ?>">
    <input type="hidden" id="dias" name="dias" value="<?php echo $dias_diferencia; ?>">
    <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
    <input type="hidden" id="fech_cor" name="fech_cor" value="<?php echo $fech_cor_p; ?>">

</form>
<form action="../dir_res_bus/info_prestamo.php" method="post" target="contenedor" name="form_no">
    <input type="hidden" id="id_pres" name="id_pres" value="<?php echo $id; ?>">
</form> 
