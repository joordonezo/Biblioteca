<?php
require_once '../scripts/db_conexion.php';
include '../scripts/librerias.php';
$db_conexion = new db_conexion();
$st1 = "submit";
$st2 = "reset";
$st3 = "hidden";
if (isset($_POST['formLogin2']) && $_POST['formLogin2'] == "enviado2") {
$db_conexion->consultar("id, nombre, autor", "libro", "id", "=", $_POST['libro_id'], TRUE);
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $lib_id = $row[0];
        $libro = $row[1] . " - " . $row[2];
    }
    
    $sala = $_POST['sala'];
    $estante = $_POST['estante'];
    $fila = $_POST['fila'];
    $columna = $_POST['columna'];
    $area = $_POST['area'];
    $libro_id = $_POST['libro_id'];
    $db_conexion->insertar("ubicacion", "sala, estante, fila, columna, area, libro_id", "" . $sala . ", " . $estante . ", " . $fila . ", " . $columna . ", " . $area . ", " . $libro_id);
    $st1 = "hidden";
    $st2 = "hidden";
    $st3 = "button";

} else{
    $st3 = "hidden";
    $id_lib = $_POST['id_lib'];
    $db_conexion->consultar("id, nombre, autor", "libro", "id", "=", $id_lib, TRUE);
    while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $lib_id = $row2[0];
        $libro = $row2[1] . " - " . $row2[2];
    }
}

?>

<form action="" method="post">
    <div class="col-xs-6 form-group has-success">
        <label class="control-label">INGRESO DE UBICACION DEL LIBRO</label>
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-8 col-xs-offset-4 text-warning" id="libro" name="libro" value="<?php echo $lib_id; ?>"><span class="badge"><b><?php echo $libro; ?></b></span></div>
    <div class="col-xs-12">
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="sala">Sala</label>
            <select class="form-control" id="sala" name="sala">
                <option value="">---Seleccione---</option>
                <option value="1">Biblioteca Primaria</option>
                <option value="2">Biblioteca Bachillerato</option>

            </select>
        </div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="estante">Estante</label>

            <select class="form-control" id="estante" name="estante">
                <option value="">---Seleccione---</option>
                <option value="1">ST 1</option>
                <option value="2">ST 2</option>
                <option value="3">ST 3</option>
                <option value="4">ST 4</option>
                <option value="5">ST 5</option>
                <option value="6">ST 6</option>
                <option value="7">ST 7</option>
                <option value="8">ST 8</option>
                <option value="9">ST 9</option>
                <option value="10">ST 10</option>
                <option value="11">ST 11</option>
                <option value="12">ST 12</option>

            </select>
        </div>
        <div class="clearfix"></div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="fila">Fila</label>
            <select class="form-control" id="fila" name="fila">
                <option value="">---Seleccione---</option>
                <option value="1">F 1</option>
                <option value="2">F 2</option>
                <option value="3">F 3</option>
                <option value="4">F 4</option>
                <option value="5">F 5</option>
            </select>
        </div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="columna">Columna</label>
            <select class="form-control" id="columna" name="columna">
                <option value="">---Seleccione---</option>
                <option value="1">C 1</option>
                <option value="2">C 2</option>
                <option value="3">C 3</option>
                <option value="4">C 4</option>
                <option value="5">C 5</option>
                <option value="6">C 6</option>
                <option value="7">C 7</option>
                <option value="8">C 8</option>
            </select>

        </div>
        <div class=" form-group has-success  col-xs-3">
            <label class="control-label" for="area">Area</label>
            <select class="form-control" id="area" name="area">
                <option value="">---Seleccione---</option>
                <option value="1">Area 1</option>
                <option value="2">Area 2</option>
                <option value="3">Area 3</option>
                <option value="4">Area 4</option>
                <option value="5">Area 5</option>
                <option value="6">Area 6</option>
                <option value="7">Area 7</option>
                <option value="8">Area 8</option>
            </select>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group has-success col-xs-3 ">
        <input class="btn btn-group-xs btn-danger" type="<?php echo $st1; ?>" name="" id="guardar" value="Guardar"/>
        <input class="btn btn-group-xs btn-danger" type="<?php echo $st2; ?>" name="" id="limpiar" value="Limpiar"/>
        <input class="btn btn-group-xs btn-danger" type="<?php echo $st3; ?>" name="volver" onclick="document.location.href = 'http://colrosario.edu.co/'" value="Volver" />
        <input type="hidden" name="libro_id" value="<?php echo $id_lib; ?>" />
        <input type="hidden" name="formLogin2" value="enviado2" />
    </div>
</form>

