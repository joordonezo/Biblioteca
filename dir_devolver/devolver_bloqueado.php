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
    $db_conexion->insertar("multa", "valor, fecha_inicio, fecha_corte, estado, persona_id, prestamo_id", "" . $total . ", '" . $nuevafecha . "', '" . $hoy . "', " . 3 . ", " . $per_p . ", " . $id);
  
    $db_conexion->actualizar("prestamo", "estado", "2", "id", "=", $id, TRUE);

    $db_conexion->actualizar("renovacion", "estado", "2", "prestamo_id ", "=", $id, TRUE);
    
    $db_conexion->insertar("bloqueo_persona", "fecha_inicio, fecha_fin, estado, persona_id, persona_id1", "'".$hoy."', '". null . "', ". 1 .", ".$per_p.", ".$_SESSION['id']);
    
    ?>
    <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><b>Libro devuelto correctamente</b></div>
    <?php
//enviar correo
    $destino = $mail;
    $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
    $asunto = "Entrega De Libro";
    $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado la entrega del libro, y ha quedado una multa pendiente de $ ".$total." correspondienes a ".$dias." de atraso. Recuerda que debes cancelar la multa para poder volver a prestar libros.";
    mail($destino, $asunto, $mensaje, $de);
    ?>
    
    <div class="btn-group col-xs-10 col-xs-offset-1" role="group" aria-label="...">
        <button type="button" class="btn btn-default col-xs-6" id="vol_lib" name="vol_lib"><b>Prestar el libro:</b> <?php echo $nom_l . " - " . $aut; ?> <b>A otra persona</b></button>
        <a class="btn btn-warning col-xs-6" href="http://colrosario.edu.co/" role="button"><b>Volver</b></a>
    </div>
    <?php
    
}
?>
<script type="text/javascript">
    $(document).on("ready", function () {
        $("#vol_lib").click(function () {
            document.form_lib.submit();

        });
        
    });
</script>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_lib">
    <input type="hidden" id="id_libr" name="id_libr" value="<?php echo $id_l; ?>">
</form>

