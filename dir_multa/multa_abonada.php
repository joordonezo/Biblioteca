<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion;
if (isset($_POST['enviar']) && $_POST['enviar'] == "enviado") {

    $valor = $_POST['valor'];
    $id = $_POST['id'];
    $total = $_POST['to'];
    $id_persona = $_POST['id_p'];
    $fecha = $_POST['fe'];
    $db_conexion->consultar("id, valor", "abono", "multa_id", "=", $id." AND estado = ". 1, TRUE);
    
    while ($row5 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_abono = $row5[0];
        $valor_abo = $row5[1];
    }
    if(isset($id_abono) && $id_abono !=""){
        $total=$total-$valor_abo;
    }
    if (isset($valor) && $valor != "") {
        if ($valor > $total) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>El valor ingresado supera el valor de la multa</b></div>
            <?php
        } else if ($valor <= $total) {
            $nuevafecha = strtotime('+1 day', strtotime($fecha));
            $nuevafecha = date('Y-m-j', $nuevafecha);
            $nuevafecha1 = strtotime('+20 day', strtotime($fecha));
            $nuevafecha1 = date('Y-m-j', $nuevafecha1);
            
            $db_conexion->insertar("multa", "valor, fecha_inicio, fecha_corte, estado, persona_id, prestamo_id", "" . $total . ", '" . $nuevafecha . "', '" . null . "', " . 1 . ", " . $id_persona . ", " . $id);

            $db_conexion->consultar("id", "multa", "prestamo_id", "=", $id . " AND estado = " . 1, TRUE);
            
            while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_multa = $row1[0];
            }
            $db_conexion->insertar("abono", "valor, estado, multa_id", $valor . " , " . 1 . " , " . $id_multa);
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 ">Se ha generado un abono por <b>$ <?php echo $valor; ?></b> a la cuenta total de <b>$ <?php echo $total; ?></b> y queda restando a la cuenta <b>$ <?php echo $total - $valor; ?></b></div>
            <?php
            session_start();
            $db_conexion->insertar("bloqueo_persona", "fecha_inicio, fecha_fin, estado, persona_id, persona_id1", "'" . date("y-m-d") . "', '" . null . "', " . 1 . ", " . $id_persona . ", " . $_SESSION['id']);

             $db_conexion->consultar("*", "prestamo", "id", "=", $id, TRUE);


            while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id = $row['id'];
                $fech_ini_p = $row['fecha_inicio'];
                $fech_cor_p = $row['fecha_corte'];
                $estado_p = $row['estado'];
                $per_p = $row['persona_id'];
                $id_li = $row['libro_id'];
            }
            $db_conexion->consultar("id, fecha_inicio, fecha_corte, numero_renovacion", "renovacion", "prestamo_id", "=", $id . " AND estado = " . 1, TRUE);
            
             while ($row7 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_ren = $row7[0];
                $fecha_ini_ren = $row7[1];
                $fecha_fin_ren = $row7[2];
                $num_ren = $row7[3];
            }
            $db_conexion->consultar("id, nombres, apellidos, mail", "persona", "id", "=", $per_p, TRUE);

            while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_p = $row2[0];
                $nom_p = $row2[1];
                $ape = $row2[2];
                $mail = $row2[3];
            }
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
                $db_conexion->insertar("renovacion", "fecha_inicio, fecha_corte, numero_renovacion, estado, prestamo_id", "'" . $fecha . "', '" . $nuevafecha1 . "', " . $reno_num . ", " . TRUE . ", " . $id);
              
            } else if (isset($id_ren) && $num_ren == 3) {
                ?>
                <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>Se ha alcanzado el maximo de renovaciones</b></div>
                <?php
            }
            //enviar correo
            $total1=$total-$valor;
            $destino = $mail;
            $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
            $asunto = "Renavacion de prestamo realizada";
            $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado recientemente la renovacion de tu prestamo al libro " . $nom_l . " - " . $aut . ", Recuerda que el libro lo has renovado hoy " . $fecha
                    . " y la nueva fecha limite de entrega es " . $nuevafecha1 . " para no hacerte merecedor de multa, esta es tu renovacion N° " . $reno_num . " recuerda solo tienes disponibles 3 renovaciones en total"
                    . "\n\nNOTA: si quieres continuar con el libro no olvides hacer tu renovacion a tiempo y tener "
                    . "presente la nueva fecha de entrega. Gracias por tu atencion Exitos con tu lectura. "
                    . "\n\n\n\nSe agrego ademas un abono del pestamo de $ ".$valor." a una multa de $ ".$total." queda una deuda pendiente de $ ".$total1." recuerda que debes de ponerte a paz y salvo a partir"
                    . "de este momento queda BLOQUEADO tu usuario y no podras volver a prestar libros hasta que tu cuenta quede a paz y salvo.";

            mail($destino, $asunto, $mensaje, $de);
        } else if ($valor < 0) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>El valor Ingresado No cubre la multa</b></div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>Ingresa un valor por favor</b></div>
        <?php
    }
}
if (isset($id_multa) && $id_multa != "") {
    ?>
    <a class="btn btn-warning btn-sm col-xs-4 col-xs-offset-4" href="http://colrosario.edu.co/">Volver</a>    
    <?php
} else {
    ?>
    <form action="" method="post" >
        <div class="col-xs-12">
            <div class="col-xs-4 col-xs-offset-4">
                <div class="input-group">
                    <div class="input-group-addon alert-warning">$</div>
                    <input class="form-control" type="text" name="valor" id="valor" value="" placeholder="Ingrese aca el valor del abono"/>
                </div>
                <input class="btn btn-danger btn-sm col-xs-4 col-xs-offset-4" type="submit" name="abonar" id="abonar" value="Abonar"/>
                <input type="hidden" name="id" value="<?php
                if (isset($_POST['id_pres']) && $_POST['id_pres'] != "") {
                    echo $_POST['id_pres'];
                } else if (isset($id) && $id != "") {
                    echo $id;
                }
                ?>"/>

                <input type="hidden" name="to" value="<?php
                if (isset($_POST['total']) && $_POST['total'] != "") {
                    echo $_POST['total'];
                } else if (isset($total) && $total != "") {
                    echo $total;
                }
                ?>"/>
                <input type="hidden" name="id_p" value="<?php
                if (isset($_POST['id_per']) && $_POST['id_per'] != "") {
                    echo $_POST['id_per'];
                } else if (isset($id_persona) && $id_persona != "") {
                    echo $id_persona;
                }
                ?>"/>
                <input type="hidden" name="fe" value="<?php
                if (isset($_POST['fech_cor']) && $_POST['fech_cor'] != "") {
                    echo $_POST['fech_cor'];
                } else if (isset($fecha) && $fecha != "") {
                    echo $fecha;
                }
                ?>"/>
                <input type="hidden" name="enviar" value="enviado"/>
            </div>
        </div>
    </form>
    <?php
}