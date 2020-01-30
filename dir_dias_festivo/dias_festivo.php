<?php
require_once '../scripts/db_conexion.php';
include '../scripts/librerias.php';
$db_conexion = new db_conexion();
if (isset($_POST['form']) && $_POST['form'] == "env") {
    $fec = $_POST['fec'];
    $db_conexion->consultar("*", "dias_festivo", "fecha", "=", "'".$fec."'", TRUE);
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row['id'];
        $fec = $row['fecha'];
    }
    if (isset($id) && $id != "") {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Existente!!! </strong> Dia Festivo en el sistema</div>
        <?php
    }
}
if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {
    $fecha = $_POST['fechatext'];
    
   
    
    $db_conexion->insertar("dias_festivo", "fecha", "'".$fecha."'");
}
?>
<form action="" method="post">
    <div class="col-xs-6 form-group has-success">
        <label class="control-label">INGRESO DE DIAS FESTIVO</label>
    </div>
    <div class="col-xs-12">
        <div class="text-left form-group has-success  col-xs-2">
            <label class="control-label" for="fecha">Fecha</label>
            <input class="form-control" type="date" name="fechatext" id="fecha" value="<?php
            if (isset($fec) && $fec != null) {
                echo $fec;
            };
            ?>" placeholder="Fecha"/>
        </div>
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
     <div class="clearfix"></div>
     <div class="left alert alert-warning has col-xs-3 col-xs-offset-5"><b>NOTA:</b> No incluya sabados y domingos</div>
</form>
<script type="text/javascript">

    $(document).on("ready", function () {
        $("#fecha").focusout(function () {
            var fec = $("#fecha").val();
            $("#fec").attr("value", fec);
            document.form1.submit();
        });


    });

</script>
<form action="" method="post" name="form1">

    <input type="hidden" name="fec" id="fec" value="">
    <input type="hidden" name="form" value="env" />
</form>