<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
session_start();
$db_conexion->consultar("mail, nombres, apellidos", "persona", "id", "=", $_SESSION['id'], TRUE);
while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
    $e_mail = $row[0];
    $nombr = $row[1];
    $apelli = $row[2];
}

if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {
    if (isset($_POST['para']) && !empty($_POST['para']) && !empty($_POST['de']) && isset($_POST['de'])) {

        $destino = $_POST['para'];
        $de = "Biblioteca BRM usuario " . $nombr . " " . $apelli . " Administrador de Biblioteca, Correo de contacto " . $_POST['de'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];

        mail($destino, $asunto, $mensaje, $de);
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Correcto!</strong> Correo enviado satisfactoriamente</div>
        <?php
    } else {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Campos Obligatorios!</strong>Ingrese todos los datos que estan vacios</div>
        <?php
    }
}
?>
<form action="" method="post">

    <div class="col-xs-4 col-xs-offset-4">
        <div class="col-xs-12 form-group has-success alert alert-warning">
            <label class="control-label col-xs-offset-3">ENVIAR CORREO ELECTRONICO</label>

        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-12">

            <label class="control-label" for="para">Para: </label>
            <div class="input-group">
                <div class="input-group-addon alert-warning">@</div>
                <input class="form-control" type="email" name="para" id="para" value="<?php
                if (isset($_POST['destino']) && $_POST['destino'] != "") {
                    echo $_POST['destino'];
                }
                ?>" placeholder="Para"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-12 ">
            <label class="control-label" for="de">De: </label>
            <div class="input-group">
                <div class="input-group-addon alert-warning">@</div>
                <input class="form-control" type="email" name="de" id="de" value="<?php
                if (isset($e_mail) && $e_mail != "") {
                    echo $e_mail;
                };
                ?>" placeholder="De"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-12 ">
            <label class="control-label" for="asunto">Asunto: </label>
            <input class="form-control" type="text" name="asunto" id="asunto" value="" placeholder="Asunto"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-12 ">
            <label class="control-label" for="mensaje">Mensaje: </label>
            <textarea class="form-control" name="mensaje" id="mensaje" rows="6" cols="1"></textarea>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-12 ">
            <input class="btn btn-group-xs btn-danger" type="submit" name="" id="enviar" value="Enviar"/>
            <a class="btn btn-group-xs btn-danger" name="" id="cancelar" href="">Cancelar</a>
            <input class="btn btn-group-xs btn-danger" type="reset" name="" id="limpiar" value="Limpiar"/>
            <input type="hidden" name="formLogin" value="enviado" />
        </div>

    </div>


</form>

<script type="text/javascript">
    $(document).on("ready", function () {

        $("select#tipo").on("change", function () {
            document.form_tip.submit();

        });

    });

</script>