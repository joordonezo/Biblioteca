<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if (isset($_POST['id_per']) && $_POST['id_per'] != "") {

    $id_per = $_POST['id_per'];
    $db_conexion->consultar("id, nombres, apellidos, perfil", "persona", "id", "=", $id_per, TRUE);

    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id1 = $row[0];
        $nom = $row[1];
        $ape = $row[2];
        $per = $row[3];
    }
    if (isset($per) && $per == 1) {
        $perf = 'Administrador';
    } else if (isset($per) && $per == 2) {
        $perf = 'Estudiante';
    } else if (isset($per) && $per == 3) {
        $perf = 'Docente';
    } else if (isset($per) && $per == 4) {
        $perf = 'Acudiente';
    }
}

if (isset($_POST['id_libr']) && $_POST['id_libr'] != "") {
    $id_lib = $_POST['id_libr'];

    $db_conexion->consultar("id, nombre, autor, tema, tipo", "libro", "id", "=", $id_lib, TRUE);

    while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id2 = $row1[0];
        $nom_l = $row1[1];
        $aut = $row1[2];
        $tem = $row1[3];
        $tip = $row1[4];
    }
}
if (isset($_POST['form']) && $_POST['form'] == "enviado") {
    if (isset($_POST['id_persona']) && $_POST['id_persona'] != "") {
        $id_per = $_POST['id_persona'];
        $db_conexion->consultar("id, nombres, apellidos, perfil", "persona", "id", "=", $id_per, TRUE);

        while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
            $id1 = $row[0];
            $nom = $row[1];
            $ape = $row[2];
            $per = $row[3];
        }
        if (isset($per) && $per == 1) {
            $perf = 'Administrador';
        } else if (isset($per) && $per == 2) {
            $perf = 'Estudiante';
        } else if (isset($per) && $per == 3) {
            $perf = 'Docente';
        } else if (isset($per) && $per == 4) {
            $perf = 'Acudiente';
        }
        if (isset($_POST['codi']) && $_POST['codi'] != "") {
            $codi = $_POST['codi'];

            $db_conexion->consultar("id, nombre, autor, tema, tipo", "libro", "codigo", "=", "'" . $codi . "'", TRUE);

            while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id2 = $row1[0];
                $nom_l = $row1[1];
                $aut = $row1[2];
                $tem = $row1[3];
                $tip = $row1[4];
            }
            if (isset($tip) && $tip == 1) {
                $db_conexion->consultar("id", "prestamo", "estado", "=", TRUE . " AND libro_id = " . $id2, TRUE);
                while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    $id_p_l = $row4[0];
                }


                if (isset($id_p_l) && $id_p_l != "") {
                    $db_conexion->consultar("nombre, autor", "libro", "id", "=", $id2, TRUE);
                    while ($row6 = mysqli_fetch_array($GLOBALS['consultar'])) {
                        $nom_li = $row6[0];
                        $aut_l = $row6[1];
                    }

                    unset($id2);
                    ?>
                    <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong><?php
                            if (isset($nom_li) && $nom_li != "" || isset($aut_l) && $aut_l != "") {
                                echo $nom_li . " - " . $aut_l;
                            }
                            ?></strong> Se encuentra prestado</div>
                    <?php
                }
            } else {
                unset($id2);
                ?>
                <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>El codigo del libro que ha ingresado es virtual</strong></div>
                <?php
            }
        }
    } else if (isset($_POST['id_libro']) && $_POST['id_libro'] != "") {
        $id_lib = $_POST['id_libro'];
        $db_conexion->consultar("id, nombre, autor, tema, tipo", "libro", "id", "=", $id_lib, TRUE);

        while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
            $id2 = $row1[0];
            $nom_l = $row1[1];
            $aut = $row1[2];
            $tem = $row1[3];
            $tip = $row1[4];
        }
        if (isset($_POST['codi']) && $_POST['codi'] != "") {
            $codi = $_POST['codi'];

            $db_conexion->consultar("id, nombres, apellidos, perfil", "persona", "codigo", "=", "'" . $codi . "'", TRUE);

            while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id1 = $row[0];
                $nom = $row[1];
                $ape = $row[2];
                $per = $row[3];
            }
            if (isset($per) && $per == 1) {
                $perf = 'Administrador';
            } else if (isset($per) && $per == 2) {
                $perf = 'Estudiante';
            } else if (isset($per) && $per == 3) {
                $perf = 'Docente';
            } else if (isset($per) && $per == 4) {
                $perf = 'Acudiente';
            }
            $db_conexion->consultar("id", "prestamo", "estado", "=", TRUE . " AND persona_id = " . $id1, TRUE);
            while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
                $id_p_p = $row3[0];
            }

            if (isset($id_p_p) && $id_p_p != "") {

                $db_conexion->consultar("nombres, apellidos", "persona", "id", "=", $id1, TRUE);

                while ($row5 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    $nom_pe = $row5[0];
                    $ape_p = $row5[1];
                }

                unset($id1);
                ?>
                <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong><?php
                        if (isset($nom_pe) && $nom_pe != "" || isset($ape_p) && $ape_p != "") {
                            echo $nom_pe . " - " . $ape_p;
                        }
                        ?></strong> Tiene prestado un libro</div>
                <?php
            }
        }
        //**
    }
}
?>

<div class="clearfix"></div>
<div class="well col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
    <form  action="" method="post" target="contenedor">

        <div class="col-xs-12">
            <label class="control-label">Escriba <b>AQUI</b> El codigo <?php
                if (isset($id2) && $id2 != "") {
                    echo 'de la persona';
                } else if (isset($id1) && $id1 != "") {

                    echo 'del libro';
                }
                ?> a prestar</label>
            <label class="sr-only" for="busqueda">Codigos: Personas, Libros</label>
            <input type="text" class="form-control" placeholder="Codigos: Personas, Libros"  id="codi" name="codi">
            <input type="submit" id="" name="buscar" value="Buscar" class="btn btn-danger col-xs-4 col-xs-offset-4"/>
            <?php
            if (isset($id2) && $id2 != "" && isset($id1) && $id1 != "") {
                ?>
                <a><div class="btn btn-danger col-xs-12" id="correcto" value="">Es correcto <b> prestar</b></div></a>
                <input type="hidden" name="id_p" id="id_p" value="<?php echo $id1; ?>" />
                <input type="hidden" name="id_l" id="id_l" value="<?php echo $id2; ?>" />

                <?php
            }
            ?>
            <input type="hidden" name="id_persona" value="<?php
            if (isset($id1) && $id1 != "") {
                echo $id1;
            }
            ?>" />
            <input type="hidden" name="id_libro" value="<?php
            if (isset($id2) && $id2 != "") {
                echo $id2;
            }
            ?>" />
            <input type="hidden" name="form" value="enviado" />
        </div>

    </form>
</div>
<div class="col-xs-4 col-xs-offset-4"><b>La persona </b><span class="badge"><?php
        if (isset($nom) && $nom != "" && isset($ape) && $ape != "" && isset($perf) && $perf != "") {
            echo $nom . " - " . $ape . " - " . $perf;
        } else {
            echo 'Ingrese el codigo de la persona a prestar';
        }
        ?></span></div>
<div class="clearfix"></div>
<div class="col-xs-4 col-xs-offset-4"><b>Prestara el libro </b><span class="badge"><?php
        if (isset($nom_l) && $nom_l != "" && isset($aut) && $aut != "" && isset($tem) && $tem != "") {
            echo $nom_l . " - " . $aut . " - " . $tem;
        } else {
            echo 'Ingrese el codigo de el libro a prestar';
        }
        ?></span></div>

<script type="text/javascript">
    $(document).on("ready", function () {
        $("#correcto").click(function () {
            var id_per = $("#id_p").val();
            $("#id_1").attr("value", id_per);

            var id_lib = $("#id_l").val();
            $("#id_2").attr("value", id_lib);

            document.form_pres.submit();
        });

    });
</script>
<form action="../dir_prestamo/prestado.php" method="post" target="contenedor" name="form_pres">
    <input type="hidden" id="id_1" name="id_1" value="">
    <input type="hidden" id="id_2" name="id_2" value="">
</form>