
<?php
require_once '../scripts/db_conexion.php';
include '../scripts/librerias.php';
$db_conexion = new db_conexion();
if(isset($_POST['form']) && $_POST['form'] == "env"){
    $bus = $_POST['bus'];
    $cod = $_POST['cod'];
$tip = $_POST['tipo'];
$num_d = $_POST['num'];

$db_conexion->consultar("*", "persona", "numero_documento", "=", $bus, TRUE);

    while ($rows = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $rows["id"];
        $cod = $rows["codigo"];
        $tip = $rows["tipo_documento"];
        $num_d = $rows["numero_documento"];
        $nom = $rows["nombres"];
        $ape = $rows["apellidos"];
        $sex = $rows['sexo'];
        $est = $rows["estado"];
        $corr = $rows["mail"];
        $cel = $rows["celular"];
        $tel = $rows["telefono"];
        $usu = $rows["usuario"];
        $per = $rows["perfil"];
        $gru = $rows["grupo_id"];
    }
     if (isset($id) && $id != "") {
        ?>
    <div class="alert alert-warning has col-xs-3 col-xs-offset-5"><strong>Existente!</strong> Usuario en el sistema</div>
    <?php
    }
    
}
if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {


    $codigo = $_POST['codigotext'];
    $nombres = $_POST['nombrestext'];
    $apellidos = $_POST['apellidostext'];
    $sexo = $_POST['sexotext'];
    $tipo_doc = $_POST['tipo_doctext'];
    $num_doc = $_POST['num_doctext'];
    $mail = $_POST['mailtext'];
    $celular = $_POST['celulartext'];
    $telefono = $_POST['telefonotext'];

    $perfil = $_POST['perfiltext'];
    $usuario = $_POST['usuariotext'];

    $grupo_id = $_POST['grupotext'];
    if ($_POST['clavetext'] == $_POST['clavetext1']) {
        $clave = md5($_POST['clavetext']);
    } else {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>No!</strong> Las claves no coinciden</div>
        <?php
    }


    $db_conexion->insertar("persona", "codigo, nombres, apellidos, sexo, tipo_documento, numero_documento, mail, celular, telefono, estado, perfil, usuario, clave, grupo_id", "" . $codigo . ", '" . $nombres . "', '" . $apellidos . "', " . $sexo . ", " . $tipo_doc . ", '" . $num_doc . "', '" . $mail . "', '" . $celular . "', '" . $telefono . "', " . TRUE . ", " . $perfil . ", '" . $usuario . "', '" . $clave . "', " . $grupo_id);

    
    }

?>
<form action="" method="post" name="form">
    <div class="col-xs-6 form-group has-success">
        <label class="control-label">INGRESO DE PERSONA</label>
    </div>

    <div class="col-xs-12 col-sm-12">
        <div class="text-left form-group has-success  col-xs-2">
            <label class="control-label" for="codigo">Codigo</label>
            <input class="form-control" type="text" name="codigotext" id="codigo" value="<?php
            if (isset($cod) && $cod != null) {
                echo $cod;
            };
            ?>" placeholder="Codigo"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="tipo_doc">Tipo Documento</label>
            <select class="form-control" id="tipo_doc" name="tipo_doctext">
                <?php
                if (isset($tip) && $tip != null) {
                    if ($tip == 1) {
                        echo'<option value="1">Cedula</option>';
                    } else if ($tip == 2) {
                        echo'<option value="2">Tarjeta Identidad</option>';
                    } else if ($tip == 3) {
                        echo'<option value="3">Registro Civil</option>';
                    } else if ($tip == 4) {
                        echo'<option value="4">Cedula Extrangera</option>';
                    } else if ($tip == 5) {
                        echo'<option value="5">Pasaporte</option>';
                    }
                } else {
                    ?>
                    <option value="">---Seleccione---</option>
                    <option value="1">Cedula</option>
                    <option value="2">Tarjeta Identidad</option>
                    <option value="3">Registro Civil</option>
                    <option value="4">Cedula Extrangera</option>
                    <option value="5">Pasaporte</option>

                    <?php
                };
                ?>
            </select>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="num_doc">Numero Documento</label>
            <input class="form-control" type="text" name="num_doctext" id="num_doc" value="<?php
            if (isset($num_d) && $num_d != null) {
                echo $num_d;
            };
            ?>" placeholder="Numero Documento"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="nombres">Nombres</label>
            <input class="form-control" type="text" name="nombrestext" id="nombres" value="<?php
            if (isset($nom) && $nom != null) {
                echo $nom;
            };
            ?>" placeholder="Nombres"/>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidostext" id="apellidos" value="<?php
            if (isset($ape) && $ape != null) {
                echo $ape;
            };
            ?>" placeholder="Apellidos"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="sexo">Sexo</label>
            <select class="form-control" id="sexo" name="sexotext">
                <?php
                if (isset($sex) && $sex != null) {
                    if ($sex == 1) {
                        echo'<option>Hombre</option>';
                    } else if ($per == 2) {
                        echo'<option>Mujer</option>';
                    }
                } else {
                    ?>
                    <option value="">---Seleccione---</option>
                    <option value="1">Hombre</option>
                    <option value="2">Mujer</option>
<?php };
?>


            </select>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="mail">e-Mail</label>
            <input class="form-control" type="email" name="mailtext" id="mail" value="<?php
            if (isset($corr) && $corr != null) {
                echo $corr;
            };
            ?>" placeholder="e-Mail"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="celular">Celular</label>
            <input class="form-control" type="tel" name="celulartext" id="celular" value="<?php
            if (isset($cel) && $cel != null) {
                echo $cel;
            };
            ?>" placeholder="Celular"/>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="telefono">Telefono</label>
            <input class="form-control" type="tel" name="telefonotext" id="telefono" value="<?php
            if (isset($tel) && $tel != null) {
                echo $tel;
            };
            ?>" placeholder="Telefono"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="perfil">Perfil</label>
            <select class="form-control" id="perfil" name="perfiltext">
                <?php
                if (isset($per) && $per != null) {
                    if ($per == 1) {
                        echo'<option>Administrativo</option>';
                    } else if ($per == 2) {
                        echo'<option>Estudiante</option>';
                    } else if ($per == 3) {
                        echo'<option>Doncente</option>';
                    } else if ($per == 4) {
                        echo'<option>Acudiente</option>';
                    }
                } else {
                    ?>
                    <option value="">---Seleccione---</option>
                    <option value="1">Administrativo</option>
                    <option value="2">Estudiante</option>
                    <option value="3">Docente</option>
                    <option value="4">Acudiente</option>
<?php };
?>


            </select>
        </div>
        <div class="form-group has-success col-xs-3" id="div">
            <label class="control-label" for="grupo">Grupo</label>
            <select class="form-control" id="grupo" name="grupotext">

                <?php
                if (isset($gru) && $gru != null) {
                    $db_conexion->consultar("nombre", "grupo", "id", "=", $gru, TRUE);
                    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                        echo '<option>' . $row[0] . '</option>';
                    }
                } else {
                    ?>
                    <option value="" id="este">---Seleccione---</option>       
                    <?php
                    $db_conexion->consultar("*", "grupo", null, null, null, FALSE);

                    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                        echo '<option value="' . $row["id"] . '">' . $row["nombre"] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-error  col-xs-4">
            <label class="control-label" for="usuario">Usuario</label>
            <input class="form-control" type="text" name="usuariotext" id="usuario" value="<?php
                   if (isset($usu) && $usu != null) {
                       echo $usu;
                   };
                   ?>" placeholder="Usuario"/>
        </div>
        <div class="clearfix"></div>

        <div class="text-left form-group has-error  col-xs-4">
            <label class="control-label" for="clave">Clave</label>
            <input class="form-control" type="<?php
                   if (isset($id) && $id != "") {
                       echo "hidden";
                   } else {
                       echo "password";
                   };
                   ?>" name="clavetext" id="clave" value="" placeholder="Clave"/>
        </div>
        <div class="text-left form-group has-error  col-xs-4">
            <label class="control-label" for="clave1">Confirme Clave</label>
            <input class="form-control" type="<?php
                   if (isset($id) && $id != "") {
                       echo "hidden";
                   } else {
                       echo "password";
                   };
                   ?>" name="clavetext1" id="clave1" value="" placeholder="Confirme Clave"/>
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
    <script type="text/javascript">

        $(document).on("ready", function () {

            $("select#perfil").on("change", function () {
                var id = $(this).val();

                if (id == 2) {
                    $("#div").slideDown('fast');

                } else {
                    $("#div").slideUp('fast');
                    $("#este").attr('value', 1);

                }

            });

            $("#num_doc").focusout(function () {
                var codigo = $("#num_doc").val();
                $("#bus").attr("value", codigo);
                
                var cod = $("#codigo").val();
                var tipo = $("#tipo_doc").val();
                var numero = $("#num_doc").val();
                $("#cod").attr("value",cod);
                $("#tipo").attr("value",tipo);
                $("#num").attr("value",numero);
                $("#nombres").focus();
                document.form1.submit();
            });

        });
    </script>


</form>
<form action="" method="post" name="form1">

    <input type="hidden" name="bus" id="bus" value="">
<input type="hidden" name="cod" id="cod" value="">
<input type="hidden" name="tipo" id="tipo" value="">
<input type="hidden" name="num" id="num" value="">
<input type="hidden" name="form" value="env" />
</form>