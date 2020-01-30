<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<?php
include '../scripts/librerias.php';
if (isset($_POST['id_lib_t']) && $_POST['id_lib_t'] != null) {
    include '../scripts/db_conexion.php';
    $db_conexion = new db_conexion();
    
}
