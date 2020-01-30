<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if(isset($_POST['id_pres']) && $_POST['id_pres'] !=""){
    $id = $_POST['id_pres'];
    $id_persona = $_POST['id_per'];
    $dias = $_POST['dias'];
    $total = $_POST['total'];
    $fecha = $_POST['fech_cor'];
    $nuevafecha = strtotime('+1 day', strtotime($fecha));
    $nuevafecha = date('Y-m-j', $nuevafecha);
    $hoy = date('Y-m-j');
    $db_conexion->insertar("multa", "valor, fecha_inicio, fecha_corte, estado, persona_id, prestamo_id", "".$total.", '".$nuevafecha."', '".$hoy."', ". 2 .", ".$id_persona.", ".$id);
    ?>
<div class="alert alert-warning col-xs-4 col-xs-offset-4" id="">Se ha pagado correctamente la multa de:<b> $ <?php echo $total; ?></b> correspondientes a <b><?php echo $dias; ?> </b>dias de atraso</div>
<?php

    $db_conexion->consultar("*", "prestamo", "id", "=", $id, TRUE);
    
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $per_p = $row['persona_id'];
        $id_li = $row['libro_id'];
        
    }
   $db_conexion->consultar("id, numero_renovacion", "renovacion", "prestamo_id", "=", $id . " AND estado = " . TRUE, TRUE);

            while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_r = $row1[0];
                $num_r = $row1[1];
            }
            $reno_num = 1;
            if (isset($id_r) && $id_r != "" && isset($num_r) && $num_r == 1) {
                $reno_num = 2;
                $db_conexion->actualizar("renovacion", "estado", 2, "prestamo_id", "=", $id . " AND estado = " . 1 . " AND numero_renovacion = " . 1, TRUE);
            } else if (isset($id_r) && $id_r != "" && isset($num_r) && $num_r == 2) {
                $reno_num = 3;
                $db_conexion->actualizar("renovacion", "estado", 2, "prestamo_id", "=", $id . " AND estado = " . 1 . " AND numero_renovacion = " . 2, TRUE);
            } else if (!isset($id_r)) {
                $num_r = "";
            }
            $fecha = date('Y-m-j');
            $nuevafecha = strtotime('+20 day', strtotime($fecha));
            $nuevafecha = date('Y-m-j', $nuevafecha);

            if (!isset($num_r) && $num_r != 3 || isset($num_r) && $num_r != 3) {
                $db_conexion->insertar("renovacion", "fecha_inicio, fecha_corte, numero_renovacion, estado, prestamo_id", "'" . $fecha . "', '" . $nuevafecha . "', " . $reno_num . ", " . TRUE . ", " . $id);

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
            } else if (isset($id_r) && $num_r == 3) {
                ?>
                <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>Se ha alcanzado el maximo de renovaciones</b></div>
                <?php
            }
        }
    

?>
