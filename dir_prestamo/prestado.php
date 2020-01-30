<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if(isset($_POST['id_res']) && $_POST['id_res'] !=""){
    $db_conexion->actualizar("reservacion_libro", "estado", 2, "id", "=", $_POST['id_res'], TRUE);
}

if (isset($_POST['id_1']) && $_POST['id_1'] != "" && isset($_POST['id_2']) && $_POST['id_2'] != "") {
    session_start();
    $id_lib = $_POST['id_2'];
    $id_per = $_POST['id_1'];
    $fecha = date('Y-m-j');
    $nuevafecha = strtotime('+20 day', strtotime($fecha));
    $nuevafecha = date('Y-m-j', $nuevafecha);

    $db_conexion->insertar("prestamo", "fecha_inicio, fecha_corte, estado, libro_id, persona_id, persona_id1", "'" . date("y-m-d") . "', '" . $nuevafecha . "', " . TRUE . ", " . $id_lib . ", " . $id_per . ", " . $_SESSION['id']);

    $db_conexion->consultar("nombre, autor", "libro", "id", "=", $id_lib, TRUE);
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $nom_l = $row[0];
        $aut = $row[1];
    }
    $db_conexion->consultar("fecha_inicio, fecha_corte", "prestamo", "persona_id", "=", $id_per, TRUE);

    while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $fec_ini = $row1[0];
        $fec_cor = $row1[1];
    }
    $db_conexion->consultar("nombres, apellidos, mail", "persona", "id", "=", $id_per, TRUE);

    while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $nom_p = $row2[0];
        $ape = $row2[1];
        $mail = $row2[2];
    }
    $db_conexion->consultar("mail, nombres, apellidos", "persona", "id", "=", $_SESSION['id'], TRUE);
 while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
     $e_mail = $row3[0];
     $nombr = $row3[1];
     $apelli =  $row3[2];
}
    $destino = $mail;
        $de = "Biblioteca BRM usuario " .$nombr . " " . $apelli . " Administrador de Biblioteca, Correo de contacto " . $e_mail;
        $asunto = "Prestamo Realizado";
        $mensaje = "Hola!!! ".$nom_p." ".$ape." Se ha registrado recientemente un prestamo en biblioteca "
                ."del libro ".$nom_l." - ".$aut.", Recuerda que el libro lo has prestado hoy ".$fec_ini
                ." y debes devolverlo antes de ".$fec_cor." para no hacerte merecedor de multa, "
                ."\n\nNOTA: si quieres continuar con el libro no olvides hacer tu renovacion a tiempo y tener "
                ."presente la nueva fecha de entrega. Gracias por tu atencion Exitos con tu lectura. ";

        mail($destino, $asunto, $mensaje, $de);
    
}
?>


<h3 class="col-xs-4 col-xs-offset-4">Prestamo realizado con exito!!!</h3>

<div class="col-xs-12">

    <div class="col-xs-8 col-xs-offset-4"><span class="badge"><?php
if (isset($nom_l) && $nom_l != "" && isset($aut) && $aut != "") {
    echo $nom_l . " - " . $aut;
} else {
    echo '-';
}
?></span> - <span class="badge"><?php
            if (isset($nom_p) && $nom_p != "" && isset($ape) && $ape != "") {
                echo $nom_p . " - " . $ape;
            } else {
                echo '-';
            }
            ?></span></div>
    <div class="col-xs-4 col-xs-offset-4">
        <div class="jumbotron">
            <div class="col-xs-12"><b>Fecha de prestamo: </b><span class="badge"><?php
                    if (isset($fec_ini) && $fec_ini != "") {
                        echo $fec_ini;
                    } else {
                        echo '-';
                    }
                    ?></span></div>
            <div class="col-xs-12"><b>Fecha de entrega: </b><span class="badge"><?php
                    if (isset($fec_cor) && $fec_cor != "") {
                        echo $fec_cor;
                    } else {
                        echo '-';
                    }
                    ?></span></div>
            <div class="clearfix"></div>
            <a class="btn btn-warning btn-lg col-xs-12" href="#" role="button">OK Volver</a>
        </div>
    </div>

</div>

