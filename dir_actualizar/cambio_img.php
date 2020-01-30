<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
session_start();
$db_conexion->consultar("sexo", "persona", "id", "=", $_SESSION['id'], TRUE);
while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
    $sexo = $row[0];
}
if (isset($_POST['enviar']) && $_POST['enviar'] == "enviar") {
    $carpeta = "../temp/";
    opendir($carpeta);
    $destino = $carpeta . $_FILES['importar']['name'];
    copy($_FILES['importar']['tmp_name'], $destino);
    $impor = $_FILES['importar']['name'];
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row col-xs-12">
        <div class="col-sm-6 col-md-4 col-xs-4 col-xs-offset-4">
            <div class="thumbnail">
                <img class="img-circle" src="<?php
                if (isset($impor) && $impor != null) {
                    echo "../temp/" . $impor;
                }else{
                if ($sexo == 1) {
                    echo '../img/avatar hombre.jpg';
                } else if ($sexo == 2) {
                    echo '../img/avatar mujer.jpg';
                }
                };
                
                ?>" alt="Perfil" width="150" height="150">
                <div class="caption">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h4>Vista previa</h4>
                    </div>
                    <input type="file" class="btn btn-default" name="importar" id="importar" value="Importar"/><br>
                    <div class="clearfix"></div>
                    <p><input class="btn btn-primary btn-danger" type="submit" value="Guardar"/> <input  class="btn btn-default" type="reset" value="Cancelar"/></p>
                    <input type="hidden" id="enviar" name="enviar" value="enviar"/>
                </div>
            </div>
        </div>
    </div>
</form>
