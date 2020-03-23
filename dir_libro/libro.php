<?php
require_once '../scripts/db_conexion.php';
include '../scripts/librerias.php';
$db_conexion = new db_conexion();
if(isset($_POST['form']) && $_POST['form'] == "env"){
    $cod = $_POST['cod'];
    $db_conexion->consultar("*", "libro", "codigo", "=", $cod, TRUE);
    
    while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row1['id'];
        $cod = $row1['codigo'];
        $class = $row1['clasificacion'];
        $isbn = $row1['isbn'];
        $edit = $row1['editorial'];
        $nom = $row1['nombre'];
        $autor = $row1['autor'];
        $area = $row1['area'];
        $tema = $row1['tema'];
        $est_fis = $row1['estado_fisico'];
        $tipo = $row1['tipo'];
        $estado = $row1['estado'];
        $desc = $row1['descripcion'];
        $pa_cla = $row1['palabras_clave'];
        $mod = $row1['modalidad'];
        
        echo 'hello word';
        
    }
     if (isset($id) && $id != "") {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Existente!!! </strong> Libro en el sistema</div>
        <?php
    }
}
if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {
    session_start();
    $codigo = $_POST['codigo'];
    $clasificacion = $_POST['clasificacion'];
    $isbn = $_POST['isbn'];
    $editorial = $_POST['editorial'];
    $nombre_libro = $_POST['nombre_libro'];
    $nombre_autor = $_POST['nombre_autor'];
    $area = $_POST['area'];
    $tema = $_POST['tema'];
    $estado_fisico = $_POST['estado_fisico'];
    $tipo = $_POST['tipo'];
    $estado = 1;
    $modalidad = $_POST['modalidad'];
    $descripcion = $_POST['descripcion'];
    $palabras_clave = $_POST['palabras_clave'];
    $persona_id = $_SESSION['id'];

    $db_conexion->insertar("libro", "codigo, clasificacion, isbn, editorial, nombre, autor, area, tema, estado_fisico, tipo, estado, descripcion, palabras_clave, modalidad, persona_id", "'" . $codigo . "', '" . $clasificacion . "', '" . $isbn . "', '" . $editorial . "', '" . $nombre_libro . "', '" . $nombre_autor . "' , '" . $area . "', '" . $tema . "', " . $estado_fisico . ", " . $tipo . ", " . $estado . ", '" . $descripcion . "', '" . $palabras_clave . "', " . $modalidad . ", " . $persona_id);
    
}
?>
        <form action="" method="post" enctype="multipar/form-data">
    <div class="col-xs-6 form-group has-success">
        <label class="control-label">INGRESO DE LIBRO</label>
    </div>
    <div class="col-xs-12">
        <div class="text-left form-group has-success  col-xs-2">
            <label class="control-label" for="codigo">Codigo</label>
            <input class="form-control" type="text" name="codigo" id="codigo" value="<?php
            if (isset($cod) && $cod != null) {
                echo $cod;
            };
            ?>" placeholder="Codigo"/>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="clasificacion">Clasificacion</label>
            <input class="form-control" type="text" name="clasificacion" id="clasificacion" value="<?php
            if (isset($class) && $class != null) {
                echo $class;
            };
            ?>" placeholder="Clasificacion"/>
        </div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="isbn">ISBN</label>
            <input class="form-control" type="text" name="isbn" id="isbn" value="<?php
            if (isset($isbn) && $isbn != null) {
                echo $isbn;
            };
            ?>" placeholder="ISBN"/>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="editorial">Editorial</label>
            <input class="form-control" type="text" name="editorial" id="editorial" value="<?php
            if (isset($edit) && $edit != null) {
                echo $edit;
            };
            ?>" placeholder="Editorial"/>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="nom_libro">Nombre Libro</label>
            <input class="form-control" type="text" name="nombre_libro" id="nom_libro" value="<?php
            if (isset($nom) && $nom != null) {
                echo $nom;
            };
            ?>" placeholder="Nombre Libro"/>
        </div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="nom_autor">Nombre Autor</label>
            <input class="form-control" type="text" name="nombre_autor" id="nom_autor" value="<?php
            if (isset($autor) && $autor != null) {
                echo $autor;
            };
            ?>" placeholder="Nombre Autor"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="area">Area</label>
            <select class="form-control" id="area" name="area">
                <?php
            if (isset($area) && $area != null) {
                if($area == 1){
                    echo '<option>Matemticas</option>';
                }else if($area == 2){
                    echo '<option>Fisica</option>';
                }else if($area == 3){
                    echo '<option>Quimica</option>';
                }else if($area == 4){
                    echo '<option>Filosofia</option>';
                }else if($area == 5){
                    echo '<option>Literatura</option>';
                }else if($area == 6){
                    echo '<option>Sistemas</option>';
                }
            }else{
            ?>
                <option value="">---Seleccione---</option>
                <option value="1">Matemticas</option>
                <option value="2">Fisica</option>
                <option value="3">Quimica</option>
                <option value="4">Filosofia</option>
                <option value="5">Literatura</option>
                <option value="6">Sistemas</option>
                <?php
            };
                ?>
            </select>
        </div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="tema">Tema</label>
            <input class="form-control" type="text" name="tema" id="tema" value="<?php
            if (isset($tema) && $tema != null) {
                echo $tema;
            };
            ?>" placeholder="Tema"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="estado_fisico">Estado fisico</label>
            <select class="form-control" id="estado_fisico" name="estado_fisico">
                <?php
            if (isset($est_fis) && $est_fis != null) {
                if($est_fis == 1){
                    echo '<option>Exelente</option>';
                }else if($est_fis == 2){
                    echo '<option>Sobresaliente</option>';
                }else if($est_fis == 3){
                    echo '<option>Aceptable</option>';
                }else if($est_fis == 4){
                    echo '<option>Insufisiente</option>';
                }else if($est_fis == 5){
                    echo '<option>Deficiente</option>';
                }
            }else{
            ?>
                <option value="">---Seleccione---</option>
                <option value="1">Exelente</option>
                <option value="2">Sobresaliente</option>
                <option value="3">Aceptable</option>
                <option value="4">Insufisiente</option>
                <option value="5">Deficiente</option>
                <?php
            };
                ?>
            </select>
        </div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo">
                 <?php
            if (isset($tipo) && $tipo != null) {
                if($tipo == 1){
                    echo '<option>Fisico</option>';
                }else if($tipo == 2){
                    echo '<option>Virtual</option>';
                }
            }else{
            ?>
                <option value="">---Seleccione---</option>
                <option value="1">Fisico</option>
                <option value="2">Virtual</option>
                <?php
            };
                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="modalidad">Modalidad</label>
            <select class="form-control" id="modalidad" name="modalidad">
                <?php
            if (isset($mod) && $mod != null) {
                if($mod == 1){
                    echo '<option>Institucional</option>';
                }else if($mod == 2){
                    echo '<option>Personal</option>';
                }
            }else{
            ?>
                <option value="">---Seleccione---</option>
                <option value="1">Institucional</option>
                <option value="2">Personal</option>
                <?php 
            };
                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-success  col-xs-4">
            <label class="control-label" for="descripcion">Descripcion</label>
            <div class="clearfix"></div>
            <?php
                   if (isset($id) && $id != "") {
                       ?>
            <div class="col-xs-4"  name="" id="" ><span class="badge"><?php if (isset($desc) && $desc != null) {
                echo $desc;
                }; ?></span></div>
            <?php
                      
                   } else {
                        ?><textarea class="form-control" type="text" name="descripcion" id="descripcion" value="<?php
                        
            
            ?>"placeholder="Descripcion"></textarea><?php
            
                   };
                   ?>
            
        </div>
        <div class="text-left form-group has-success  col-xs-4">
            <label class="control-label" for="pal_clave">Palabras Clave</label>
            <div class="clearfix"></div>
             <?php
                   if (isset($id) && $id != "") {
                       ?>
            <div class="col-xs-4"  name="" id="" ><span class="badge"><?php if (isset($pa_cla) && $pa_cla != null) {
                echo $pa_cla;
                }; ?></span></div>
            <?php
                      
                   } else {
                        ?><textarea class="form-control" type="text" name="palabras_clave" id="pal_clave" value="<?php
                        
            
            ?>" placeholder="Palabras Clave"></textarea><?php
            
                   };
                   ?>
            

        </div>
        <div class="clearfix"></div>
        
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
    $("#codigo").focusout(function () {
    var cod = $("#codigo").val();
            $("#cod").attr("value", cod);
            document.form1.submit();
    });
    });
</script>
<form action="" method="post" name="form1">
    <input type="hidden" name="cod" id="cod" value="">
    <input type="hidden" name="form" value="env" />
</form>