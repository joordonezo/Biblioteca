<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion;
if (isset($_POST['enviar']) && $_POST['enviar'] == "enviado") {
    $dias = $_POST['di'];
    $valor = $_POST['valor'];
    $id = $_POST['id'];
    $total = $_POST['to'];
    $id_persona = $_POST['id_p'];
    $fecha = $_POST['fe'];
    if (isset($valor) && $valor != "") {
        if ($valor > $total) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>El valor ingresado supera el valor de la multa</b></div>
            <?php
        } else if ($valor < $total && $valor > 0) {
            $nuevafecha = strtotime('+1 day', strtotime($fecha));
            $nuevafecha = date('Y-m-j', $nuevafecha);
            $nuevafecha1 = strtotime('+20 day', strtotime($fecha));
            $nuevafecha1 = date('Y-m-j', $nuevafecha1);

            $db_conexion->insertar("multa", "valor, fecha_inicio, fecha_corte, estado, persona_id, prestamo_id", "" . $total . ", '" . $nuevafecha . "', '" . null . "', " . 1 . ", " . $id_persona . ", " . $id);

            $db_conexion->consultar("id", "multa", "prestamo_id", "=", $id . " AND estado = " . 1, TRUE);

            while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_multa = $row1[0];
            }

            $db_conexion->insertar("abono", "valor, estado, multa_id", $valor . " , " . 1 . " , " . $id_multa);
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 ">Se ha generado un abono por <b>$ <?php echo $valor; ?></b> a la cuenta total de <b>$ <?php echo $total; ?></b> y queda restando a la cuenta <b>$ <?php echo $total - $valor; ?></b></div>
            <?php
            $obs = 'multa pendiente, debe cancelar lo restante';
            session_start();
            $db_conexion->insertar("bloqueo_persona", "fecha_inicio, estado, observacion, persona_id, persona_id1", "'" . date("y-m-d") . "', " . 1 . ", '" .$obs. "', " . $id_persona . ", " . $_SESSION['id']);

            $db_conexion->actualizar("prestamo", "estado", "2", "id", "=", $id, TRUE);

            $db_conexion->actualizar("renovacion", "estado", "2", "prestamo_id ", "=", $id, TRUE);

            $db_conexion->consultar("*", "prestamo", "id", "=", $id, TRUE);


            while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id = $row['id'];
                $fech_ini_p = $row['fecha_inicio'];
                $fech_cor_p = $row['fecha_corte'];
                $estado_p = $row['estado'];
                $per_p = $row['persona_id'];
                $id_li = $row['libro_id'];
            }

            $db_conexion->consultar("id, nombres, apellidos, mail", "persona", "id", "=", $per_p, TRUE);

            while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_p = $row2[0];
                $nom_p = $row2[1];
                $ape = $row2[2];
                $mail = $row2[3];
            }
            $db_conexion->consultar("id, nombres, apellidos, mail", "persona", "id", "=", $_SESSION['id'], TRUE);

            while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_p_s = $row3[0];
                $nom_p_s = $row3[1];
                $ape_s = $row3[2];
                $mail_s = $row3[3];
            }

            $db_conexion->consultar("id, nombre, autor", "libro", "id", "=", $id_li, TRUE);

            while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_l = $row4[0];
                $nom_l = $row4[1];
                $aut = $row4[2];
            }
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><b>Libro devuelto correctamente</b></div>
            <?php
            $abon = $total - $valor;
            //enviar correo
            $destino = $mail;
            $de = "Biblioteca BRM usuario " . $nom_p_s . " " . $ape_s . " Administrador de Biblioteca, Correo de contacto " . $mail_s;
            $asunto = "Entrega De Libro";
            $mensaje = "Hola!!! " . $nom_p . " " . $ape . " Se ha registrado la entrega del libro " . $nom_l . " - " . $aut
                    . ", y se regristro el abono de $ ".$valor." a la multa de $ " . $total . " correspondientes a " . $dias . " de atraso, quedas restando $ ".$abon."\n"
                    . "Recuerda que debes de pagar el total de la multa para poder prestar mas libros.\n Gracias";
            mail($destino, $asunto, $mensaje, $de);
            ?>

            <div class="btn-group col-xs-10 col-xs-offset-1" role="group" aria-label="...">
                <button type="button" class="btn btn-default col-xs-6" id="vol_lib" name="vol_lib"><b>Prestar el libro:</b> <?php echo $nom_l . " - " . $aut; ?> <b>A otra persona</b></button>
                <a type="button" class="btn btn-default col-xs-6" href="http://colrosario.edu.co/" name="vol"><b>Volver</b></a>
            </div>
            <?php
        } else if ($valor = $total && $valor > 0) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>El valor Ingresado cubre el total de la multa, por favor de click en volver y a continuacion en <b>si, pagar</b></b></div>
            <?php
        }else if ($valor = 0) {
            ?>
            <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>El valor Ingresado es 0 porfavor ponga un valor valido</b></div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-warning col-xs-4 col-xs-offset-4 "><b>Ingresa un valor por favor</b></div>
        <?php
    }
}

if (!isset($id_multa)) {
    ?>
    <form action="" method="post" >
        <div class="col-xs-12">
            <div class="col-xs-4 col-xs-offset-4">
                <div class="input-group">
                    <div class="input-group-addon alert-warning">$</div>
                    <input class="form-control" type="text" name="valor" id="valor" value="" placeholder="Ingrese aca el valor del abono"/>
                </div>
                <input class="btn btn-danger btn-sm col-xs-4 col-xs-offset-4" type="submit" name="abonar" id="abonar" value="Abonar"/>
                <input class="btn btn-warning col-xs-4" type="button" id="volver" name="volver" value="Volver"/>
                <input type="hidden" name="di" value="<?php
    if (isset($_POST['dias']) && $_POST['dias'] != "") {
        echo $_POST['dias'];
    } else if (isset($dias) && $dias != "") {
        echo $dias;
    }
    ?>"/>
                <input type="hidden" name="id" value="<?php
            if (isset($_POST['id_pres']) && $_POST['id_pres'] != "") {
                echo $_POST['id_pres'];
            } else if (isset($id) && $id != "") {
                echo $id;
            }
    ?>"/>

                <input type="hidden" name="to" value="<?php
            if (isset($_POST['total']) && $_POST['total'] != "") {
                echo $_POST['total'];
            } else if (isset($total) && $total != "") {
                echo $total;
            }
    ?>"/>
                <input type="hidden" name="id_p" value="<?php
            if (isset($_POST['id_per']) && $_POST['id_per'] != "") {
                echo $_POST['id_per'];
            } else if (isset($id_persona) && $id_persona != "") {
                echo $id_persona;
            }
    ?>"/>
                <input type="hidden" name="fe" value="<?php
            if (isset($_POST['fech_cor_p']) && $_POST['fech_cor_p'] != "") {
                echo $_POST['fech_cor_p'];
            } else if (isset($fecha) && $fecha != "") {
                echo $fecha;
            }
    ?>"/>
                <input type="hidden" name="enviar" value="enviado"/>
            </div>
        </div>
    </form>
    <?php
}
?>
<script type="text/javascript">
    $(document).on("ready", function () {
        $("#vol_lib").click(function () {
            document.form_lib.submit();

        });
 $("#volver").click(function () {
            document.form_volver.submit();

        });
    });
</script>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_lib">
    <input type="hidden" id="id_libr" name="id_libr" value="<?php echo $id_l; ?>">
</form>
<form action="devolver.php" method="post" target="contenedor" name="form_volver">
    <input type="hidden" id="id_pre" name="id_pre" value="<?php echo $id; ?>">
</form>