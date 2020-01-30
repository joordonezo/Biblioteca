<?php
require_once '../scripts/db_conexion.php';
include '../scripts/librerias.php';
$db_conexion = new db_conexion();
if (isset($_POST['form']) && $_POST['form'] == "env") {
    $nom = $_POST['nom'];
    $db_conexion->consultar("*", "grupo", "nombre", "like", "'%" . $nom . "%'", TRUE);

    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row['id'];
        $nom = $row['nombre'];
        $gra = $row['grado'];
        $fe_ini = $row['fecha_inicio'];
        $fe_fin = $row['fecha_fin'];
    }
    if (isset($id) && $id != "") {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Existente!!! </strong> Grupo en el sistema</div>
        <?php
    }
}
if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {
    $nombre = $_POST['nombre'];
    $grado = $_POST['grado'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];



    $db_conexion->insertar("grupo", "nombre, grado, fecha_inicio, fecha_fin", "'" . $nombre . "','" . $grado . "', '" . $fecha_inicio . "', '" . $fecha_fin . "'");
}
?>
<form action="" method="post">
    <div class="col-xs-6 form-group has-success">
        <label class="control-label">INGRESO DE GRUPO</label>
    </div>
    <div class="col-xs-12">
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php
            if (isset($nom) && $nom != null) {
                echo $nom;
            };
            ?>" placeholder="Nombre"/>
        </div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="grado">Grado</label>
            <input class="form-control" type="text" name="grado" id="grado" value="<?php
            if (isset($gra) && $gra != null) {
                echo $gra;
            };
            ?>" placeholder="Grado"/>
        </div>
        <div class="clearfix"></div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="fecha_inicio">Fecha Inicio</label>
            <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" value="<?php
            if (isset($fe_ini) && $fe_ini != null) {
                echo $fe_ini;
            };
            ?>" placeholder="Fecha Inicio"/>
        </div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="fecha_fin">Fecha Fin</label>
            <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" value="<?php
            if (isset($fe_fin) && $fe_fin != null) {
                echo $fe_fin;
            };
            ?>" placeholder="Fecha Fin"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <input class="btn btn-group-xs btn-danger" type="<?php
            if (isset($id) && $id != "") {
                echo "hidden";
            } else {
                echo "submit";
            };
            ?>" name="" id="guardar" value="Guardar"/>
            <input class="btn btn-group-xs btn-danger" type="<?php
            if (isset($id) && $id != "") {
                echo "button";
            } else {
                echo "hidden";
            };
            ?>" name="actualizar" id="actualizar" value="Alcualizar"/>
            <input class="btn btn-group-xs btn-danger" type="reset" name="" id="limpiar" value="Limpiar"/>
            <input type="hidden" name="formLogin" value="enviado" />
        </div>
    </div>
</form>
<script type="text/javascript">

    $(document).on("ready", function () {
        $("#nombre").focusout(function () {
            var nom = $("#nombre").val();
            $("#nom").attr("value", nom);
            document.form1.submit();
        });


    });

</script>
<form action="" method="post" name="form1">

    <input type="hidden" name="nom" id="nom" value="">
    <input type="hidden" name="form" value="env" />
</form>