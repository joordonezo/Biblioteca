<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';

$db_conexion = new db_conexion();

if (isset($_POST['id_pres']) && $_POST['id_pres'] != "") {
    $db_conexion->consultar("*", "prestamo", "id", "=", $_POST['id_pres'], TRUE);


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
    
    $id = $_POST['id_pres'];
    $fecha = $_POST['fecha'];
    $dias = $_POST['dias'];
    $total = $_POST['total'];

    $nuevafecha = strtotime('+1 day', strtotime($fecha));
    $nuevafecha = date('Y-m-j', $nuevafecha);
    $hoy = date('Y-m-j');
    $db_conexion->insertar("multa", "valor, fecha_inicio, fecha_corte, estado, persona_id, prestamo_id", "" . $total . ", '" . $nuevafecha . "', '" . $hoy . "', " . 2 . ", " . $per_p . ", " . $id);
    ?>
    <div class="alert alert-warning col-xs-4 col-xs-offset-4" id="">Se ha pagado correctamente la multa de:<b> $ <?php echo $total; ?></b> correspondientes a <b><?php echo $dias; ?> </b>dias de atraso</div>
    <?php
    $db_conexion->actualizar("prestamo", "estado", "2", "id", "=", $id, TRUE);

    $db_conexion->actualizar("renovacion", "estado", "2", "prestamo_id ", "=", $id, TRUE);
    ?>
    <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><b>Libro devuelto correctamente</b></div>
    <?php
//enviar correo
    $destino = $mail;
    $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
    $asunto = "Entrega De Libro";
    $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado la entrega del libro " . $nom_l . " - " . $aut . ", y se regristro el pago de la multa de $ ".$total." correspondientes a ".$dias." de atraso.\n"
            ."Por favor see mas puntual con la entrega. Gracias";
    mail($destino, $asunto, $mensaje, $de);
    ?>
    
    <div class="btn-group col-xs-10 col-xs-offset-1" role="group" aria-label="...">
        <button type="button" class="btn btn-default col-xs-6" id="vol_lib" name="vol_lib"><b>Prestar el libro:</b> <?php echo $nom_l . " - " . $aut; ?> <b>A otra persona</b></button>
        <button type="button" class="btn btn-default col-xs-6" id="vol_per" name="vol_per"><b>Prestar a:</b> <?php echo $nom_p . " - " . $ape; ?> <b>Otro libro</b></button>
        <a class="btn btn-default col-xs-12" href="http://colrosario.edu.co/" role="button"><b>Volver</b></a>
    </div>
    <?php
    
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
        
    });
</script>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_per">
    <input type="hidden" id="id_per" name="id_per" value="<?php echo $id_p; ?>">
</form>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_lib">
    <input type="hidden" id="id_libr" name="id_libr" value="<?php echo $id_l; ?>">
</form>
