<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if (isset($_POST['clavepost']) && $_POST['clavepost'] == 1) {
    ?>
    <form action="" method="post">

        <div class="clearfix"></div>
        <div class="text-left form-group has-error  col-xs-4 col-xs-offset-4">
            <label class="control-label" for="clave2">Clave Nueva</label>
            <input class="form-control" type="password" name="clavetext2" id="clave2" value="" placeholder="Clave Nueva"/>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-error  col-xs-4 col-xs-offset-4">
            <label class="control-label" for="clave1">Confirme Clave Nueva</label>
            <input class="form-control" type="password" name="clavetext1" id="clave1" value="" placeholder="Confirme Clave Nueva"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 col-xs-offset-5">
            <input class="btn btn-group-xs btn-danger" type="submit" name="" id="guardar" value="Guardar"/>
            <input class="btn btn-group-xs btn-danger" type="reset" name="" id="limpiar" value="Limpiar"/>
            <input type="hidden" name="formLogin1" value="enviado1" />
        </div>
    </form>

    <?php
}
if (isset($_POST['formLogin1']) && $_POST['formLogin1'] == "enviado1") {
    if (isset($_POST['clavetext2']) && isset($_POST['clavetext1']) && $_POST['clavetext2'] != null && $_POST['clavetext1'] != null) {
        if ($_POST['clavetext2'] == $_POST['clavetext1']) {
            $nueva = md5($_POST['clavetext2']);
            session_start();
            $db_conexion->actualizar("persona", "clave", "'".$nueva."'", "id", "=", $_SESSION['id'], TRUE);
        } else {
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>No!</strong> Las claves no coinciden</div>
            <?php
        }
    } else {
        ?>

        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Campo Vacio!</strong> Ingrese La contraseña por favor
            por favor</div>
        <?php
    }
}
    ?>
</html>


