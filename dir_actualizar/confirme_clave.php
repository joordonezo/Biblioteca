<?php
include '../scripts/librerias.php';
if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {
    if ($_POST['clavetext'] != null) {
        $clave = md5($_POST['clavetext']);
        include '../scripts/db_conexion.php';
        $db_conexion = new db_conexion();
        session_start();
        $db_conexion->consultar("clave", "persona", "id", "=", $_SESSION['id'], TRUE);
        while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
            if ($row[0] == $clave) {
                $est = TRUE;
            } else {
                $est = FALSE;
            }
        }
        if ($est == TRUE) {
            ?>
            <script type="text/javascript">
                $(document).on("ready", function () {
//                    $("#continuar").click(function () {
                        $("#clavepost").attr("value", 1);
                        document.formc.submit();
//                    });


                });
            </script>
            <?php
        } else if ($est == FALSE) {
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Incorrecta!</strong> Conraseña</div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Hay Campos Vacios!</strong> Ingrese Los datos por favor</div>
        <?php
    }
}
?>
<form action="" method="post" target="contenedor">
    <div class="text-left form-group has-warning  col-xs-3 col-xs-offset-5">
        <label class="control-label" for="clave">Ingrese Su Contraseña</label>
        <input class="form-control" type="password" name="clavetext" id="clave" value="" placeholder="Clave Antigua"/>
    </div>
    <div class="clearfix"></div>
    <div class="form-group has-success col-xs-3 col-xs-offset-6">
        <input class="btn btn-group-xs btn-danger" type="submit" name="" id="continuar" value="Continuar"/>
        <input type="hidden" name="formLogin" value="enviado" />
    </div>
</form>
<form action="cambio_clave.php" method="post" name="formc">
    <input type="hidden" id="clavepost" name="clavepost" value=""/>

</form>