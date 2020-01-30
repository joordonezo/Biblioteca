<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
$db_conexion = new db_conexion();

$db_conexion->consultar("id, nombres, apellidos", "persona", "codigo", "=", $_POST['cod'], TRUE);

while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
    $id_p = $row3[0];
    $nom_p = $row3[1];
    $apell_p = $row3[2];
}
if (isset($id_p) && $id_p != "") {
    
    $db_conexion->consultar("id", "prestamo", "persona_id", "=", $id_p . " AND estado = " . 1, TRUE);
    
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_pre = $row[0];
    }
    
    if(!isset($id_pre)){
    $id_l = $_POST['id_l'];
    ?>
    <div class="alert alert-warning col-xs-4 col-xs-offset-4">
        Se reservara el libro ha <b><?php echo $nom_p . " " . $apell_p; ?></b> recuerde que solo tiene <b>2</b> Dias disponibles para prestar el libro
        <form action="correcto.php" method="post" target="contenedor">
            <input type="hidden" id="id_lib_r" name="id_lib_r" value="<?php
            if (isset($id_l) && $id_l != "") {
                echo $id_l;
            };
            ?>"/>
            <input type="hidden" id="id_p" name="id_p" value="<?php
            if (isset($id_p) && $id_p != "") {
                echo $id_p;
            };
            ?>"/>
            <input type="submit" class="btn btn-danger col-xs-4 col-xs-offset-4" value="Correcto reservar"/>
            <input type="hidden" id="" name="envi" value="enviado"/>
        </form>
    </div>
    <?php
    }else{
       ?>
<div class="alert alert-warning col-xs-4 col-xs-offset-4">
        <b><?php echo $nom_p . " " . $apell_p; ?></b> tiene un prestamo activo por tal motivo <b>No</b> se puede realizar la reservacion
</div>
<?php
    }
} else {
    ?>
    <div class="alert alert-warning"><b>No se han encontrado resultados vuelva a intentarlo</b></div>
    <?php
}
?>



