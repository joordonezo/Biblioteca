
<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
$fecha = date('Y-m-j');
$nuevafecha = strtotime('+2 day', strtotime($fecha));
$nuevafecha = date('Y-m-j', $nuevafecha);
$db_conexion->insertar("reservacion_libro", "fecha_reservacion, fecha_fin, estado, persona_id, libro_id", "'" . date("Y-m-d") . "', '" . $nuevafecha . "', " . 1 . ", " . $_POST['id_p'] . ", " . $_POST['id_lib_r']);
?>
<div class="alert alert-warning col-xs-4 col-xs-offset-4"><b>se ha reservado correctamente</b></div>
<?php
