<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
    $db_conexion = new db_conexion();
if(isset($_POST['id_bloq']) && $_POST['id_bloq'] !=""){
    $db_conexion->actualizar("bloqueo_persona", "estado", "2", "id", "=", $_POST['id_bloq'], TRUE);
    
     ?>
<div class="col-xs-4 col-xs-offset-4">
<div class="alert alert-warning"><b>Se ha desbloqueado el usuario correctamente</b></div>

</div>
<?php
}else if(isset($_POST['id_bloq_l']) && $_POST['id_bloq_l'] !=""){
    $db_conexion->actualizar("bloqueo_libro", "estado", "2", "id", "=", $_POST['id_bloq_l'], TRUE);
    
     ?>
<div class="col-xs-4 col-xs-offset-4">
<div class="alert alert-warning"><b>Se ha desbloqueado el libro correctamente</b></div>

</div>
<?php
}
