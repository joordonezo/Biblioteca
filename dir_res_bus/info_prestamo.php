<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if (isset($_POST['id_pres']) && $_POST['id_pres'] != "") {
    $id_pre = $_POST['id_pres'];
    $db_conexion->consultar("*", "prestamo", "id", "=", $id_pre, TRUE);

    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row['id'];
        $fech_ini = $row['fecha_inicio'];
        $fec_cor = $row['fecha_corte'];
        $est = $row['estado'];
        $lib_id = $row['libro_id'];
        $per_id = $row['persona_id'];
        $per_id1 = $row['persona_id1'];
    }
    if ($est == 1) {
        $est = "Activo";
    } else if ($est == 2) {
        $est = "Inactivo";
    }
    $db_conexion->consultar("nombre, autor", "libro", "id", "=", $lib_id, TRUE);

    while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $nombre_li = $row1[0];
        $autor = $row1[1];
    }
    $db_conexion->consultar("nombres, apellidos, perfil", "persona", "id", "=", $per_id, TRUE);

    while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $nombre_p_p = $row2[0];
        $apell_p_p = $row2[1];
        $perfil_p_p = $row2[2];
    }
    if ($perfil_p_p == 1) {
        $perfil_p_p = "Administrador";
    } else if ($perfil_p_p == 2) {
        $perfil_p_p = "Estudiante";
    } else if ($perfil_p_p == 3) {
        $perfil_p_p = "Docente";
    } else if ($perfil_p_p == 4) {
        $perfil_p_p = "Acudiente";
    }
    $db_conexion->consultar("nombres, apellidos, perfil", "persona", "id", "=", $per_id1, TRUE);

    while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $nombre_p = $row3[0];
        $apell_p = $row3[1];
        $perfil_p = $row3[2];
    }
    if ($perfil_p == 1) {
        $perfil_p = "Administrador";
    } else if ($perfil_p == 2) {
        $perfil_p = "Estudiante";
    } else if ($perfil_p == 3) {
        $perfil_p = "Docente";
    } else if ($perfil_p == 4) {
        $perfil_p = "Acudiente";
    }
}
?>

<div class="col-xs-12">
    
<div class="btn-group col-xs-4 col-xs-offset-4" role="group" aria-label="...">
    <button type="button" class="btn btn-default col-xs-6" id="renovar" name="renovar">Renovar</button> 
    <button type="button" class="btn btn-default col-xs-6" id="devolver" name="devolver">Devolver</button>
</div>
    <div class="clearfix"></div>
    
    <div class="text-success col-xs-offset-4"><b>Libro: </b><span class="badge"><?php if (isset($nombre_li) && $nombre_li != "" && isset($autor) && $autor != "") {
    echo $nombre_li . ' - ' . $autor;
} ?></span><b> - Prestado a: </b><span class="badge"><?php if (isset($nombre_p_p) && $nombre_p_p != "" && isset($apell_p_p) && $apell_p_p != "" && isset($perfil_p_p) && $perfil_p_p != "") {
    echo $nombre_p_p . ' - ' . $apell_p_p . ' - ' . $perfil_p_p;
} ?></span></div>
    <div class="col-xs-4 col-xs-offset-4 thumbnail">
    <div>
        <div class="alert-warning text-success"><b>Estado del prestamo: </b><span class="badge"><?php if (isset($est) && $est != "") {
    echo $est;
} ?></span></div>
        <div class="text-success"><b>Fecha inicio prestamo: </b><span class="badge"><?php if (isset($fech_ini) && $fech_ini != "") {
    echo $fech_ini;
} ?></span></div>
        <div class="text-success"><b>Fecha de entrega del prestamo: </b><span class="badge"><?php if (isset($fec_cor) && $fec_cor != "") {
    echo $fec_cor;
} ?></span></div>
        <div class="clearfix"></div>
        <div class="text-success"><b>Libro prestado por: </b><span class="badge"><?php if (isset($nombre_p) && $nombre_p != "" && isset($apell_p) && $apell_p != "" && isset($perfil_p) && $perfil_p != "") {
    echo $nombre_p . ' - ' . $apell_p . ' - ' . $perfil_p;
} ?></span></div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("ready", function () {
        $("#devolver").click(function () {
            document.form_devolver.submit();
            
        });
        $("#renovar").click(function () {
            document.form_renovar.submit();
            
        });
    });
</script>
<form action="../dir_devolver/devolver.php" method="post" target="contenedor" name="form_devolver">
    <input type="hidden" id="id_pre" name="id_pre" value="<?php echo $id; ?>">
</form>
<form action="../dir_renovar/renovar.php" method="post" target="contenedor" name="form_renovar">
    <input type="hidden" id="id_pre" name="id_pre" value="<?php echo $id; ?>">
</form>