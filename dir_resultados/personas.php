<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<?php
include '../scripts/librerias.php';
if (isset($_POST['persona']) && $_POST['persona'] != null) {
    include '../scripts/db_conexion.php';
    $db_conexion = new db_conexion();
    $db_conexion->consultar("*", "persona", "id", "=", $_POST['persona'], TRUE);
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row['id'];
        $cod = $row['codigo'];
        $tip = $row['tipo_documento'];
        $nom = $row['nombres'];
        $apell = $row['apellidos'];
        $num_doc = $row['numero_documento'];
        $mail = $row['mail'];
        $cel = $row['celular'];
        $tel = $row['telefono'];
        $per = $row['perfil'];
        $gru = $row['grupo_id'];
    }

    $db_conexion->consultar("id, fecha_inicio, fecha_corte", "prestamo", "persona_id", "=", $id . " AND estado = " . TRUE, TRUE);

    while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_pre = $row1[0];
        $fech_ini_p = $row1[1];
        $fech_cor_p = $row1[1];
    }
    if (isset($id_pre) && $id_pre != "") {
        $db_conexion->consultar("id, fecha_inicio, fecha_corte", "renovacion", "prestamo_id", "=", $id_pre . " AND estado = " . 1, TRUE);

        while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
            $id_ren = $row4[0];
            $fecha_ini_ren = $row4[1];
            $fecha_fin_ren = $row4[2];
        }
    }
    $db_conexion->consultar("id, fecha_inicio, persona_id1, observacion", "bloqueo_persona", "persona_id", "=", $id . " AND estado = " . 1, TRUE);

    while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_blo = $row2[0];
        $fech_ini_blo = $row2[1];
        $id_per_que_blo = $row2[2];
        $observacion = $row2[3];
    }



    $db_conexion->consultar("id, fecha_inicio, valor", "multa", "persona_id", "=", $id . " AND estado = " . 1, TRUE);

    while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_multa = $row3[0];
        $fecha_ini_mul = $row3[1];
        $valor_m = $row3[2];
    }
    if (isset($id_multa) && $id_multa != "") {
        $db_conexion->consultar("id, valor", "abono", "multa_id", "=", $id_multa . " AND estado = " . 1, TRUE);

        while ($row5 = mysqli_fetch_array($GLOBALS['consultar'])) {
            $id_abono = $row5[0];
            $valor_abo = $row5[1];
        }
    }
    if (isset($id_multa) && $id_multa != "" && isset($id_blo) && $id_blo != "") {
        $total = $valor_m - $valor_abo;
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Esta persona Tiene un <strong>BLOQUEO</strong> que inicio <strong><?php echo $fech_ini_blo; ?></strong>
                por el motivo de: <b><?php echo $observacion ?>;</b> y presenta una <strong>Multa</strong> Pendiente desde <strong><?php echo $fecha_ini_mul; ?></strong>

            </div>
            <button type="button" class="btn btn-danger col-xs-12 " data-toggle="modal" data-target="#myModal">
                Pagar restante de la multa
            </button>
            <form action="../dir_abonar/abonar.php" method="post">
                <!-- Modal -->
                <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">¿Esta seguro de que desea continuar pagando la multa?</h4>
                            </div>
                            <div class="modal-body">
                                Se debe de recibir <b>$ <?php
                                    if (isset($total) && $total != "") {
                                        echo $total;
                                    }
                                    ?></b> restantes

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                <input type="submit" class="btn btn-danger" value="SI"/>
                            </div>
                            <input type="hidden" name="val_abo" id="val_abo" value="<?php
                            if (isset($total) && $total != "") {
                                echo $total;
                            }
                            ?>"/>

                        </div>
                        <input type="hidden" name="val_mul" id="val_mul" value="<?php
                        if (isset($valor_m) && $valor_m != "") {
                            echo $valor_m;
                        }
                        ?>"/>
                        <input type="hidden" name="id_mul" id="id_mul" value="<?php
                        if (isset($id_multa) && $id_multa != "") {
                            echo $id_multa;
                        }
                        ?>"/>
                        <input type="hidden" name="id_per" id="id_per" value="<?php
                        if (isset($id) && $id != "") {
                            echo $id;
                        }
                        ?>"/>
                    </div>
                </div>
        </div>
        </form>
        </div> 
        <?php
    } else if (isset($id_blo) && $id_blo != "") {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Esta persona Tiene un <strong>BLOQUEO</strong> que inicio <strong><?php echo $fech_ini_blo; ?></strong> por el motivo de: <b><?php echo $observacion; ?></b>

            </div>
            <div class="btn btn-block btn-danger col-xs-12" id="bloq" value="<?php echo $id_blo; ?>">Quitar el <b>BLOQUEO</b></div>

        </div> 
        <?php
    } else if (isset($id_pre) && $id_pre != "" && !isset($id_multa)) {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Esta persona Tiene un <strong>Prestamo</strong> Activo</div>
            <div class="btn btn-block btn-danger col-xs-12" id="ver_mas" value="<?php echo $id_pre; ?>">Ver informacion del prestamo</div>

        </div>   
        <?php
    }
}
?>
<form action="" method="post">
    <div class="col-xs-12">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">barra</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
                    if (isset($id_pre) && $id_pre != "" || isset($id_multa) && $id_multa != "" || isset($id_blo) && $id_blo != "") {
                        
                    } else {
                        ?>
                        <a> <div class="btn navbar-brand" id="prestar_per" value="<?php echo $id; ?>">Prestar un Libro</div></a>
                        <?php
                    }
                    ?>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav nav-tabs">
                        <li><input type="<?php
                    if (isset($id_blo) && $id_blo != "") {
                        echo "hidden";
                    } else {
                        echo "button";
                    }
                    ?>" class="navbar text-info" data-toggle="modal" data-target="#bloquear" value="Bloquear"/></li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Multas <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" target="contenedor">Pendientes</a></li>
                                <li><a href="#" target="contenedor">Libros</a></li>
                                <li><a href="#" target="contenedor">Condonadas</a></li>
                                <li class="divider"></li>
                                <li><a href="#" target="contenedor">Dias Festivo</a></li>
                                <li class="divider"></li>
                                <li><a href="#">===========</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Acciones <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Actualizar</a></li>
                                <li><a href="#">ananana</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Eliminar</a></li>
                            </ul>
                        </li>
                        <?php
                        if(isset($id_pre) && $id_pre !="" || isset($id_ren) && $id_ren !=""){
                        ?>
                        <ul class="nav navbar-nav navbar-right">
                            <a href="#">Dias De Multa <span class="badge"><?php
                                    if (!isset($id_multa)) {
                                        if (isset($id_ren) && $id_ren != "") {
                                            $fecha = date("y-m-d");
                                            list($ano2, $mes2, $dia2) = explode("-", $fecha);
                                            $fecha1 = $fecha_fin_ren;
                                            list($ano1, $mes1, $dia1) = explode("-", $fecha1);
                                            $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
                                            $timestamp2 = mktime(4, 12, 0, $mes2, $dia2, $ano2);
                                            $segundos_diferencia = $timestamp1 - $timestamp2;
                                            $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
                                            $dias_diferencia = abs($dias_diferencia);
                                            $dias_diferencia = floor($dias_diferencia);

                                            echo $dias_diferencia;
                                        } else if (isset($id_pre) && $id_pre != "") {
                                            $fecha = date("y-m-d");
                                            list($ano2, $mes2, $dia2) = explode("-", $fecha);
                                            $fecha1 = $fech_cor_p;
                                            list($ano1, $mes1, $dia1) = explode("-", $fecha1);
                                            $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
                                            $timestamp2 = mktime(4, 12, 0, $mes2, $dia2, $ano2);
                                            $segundos_diferencia = $timestamp1 - $timestamp2;
                                            $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
                                            $dias_diferencia = abs($dias_diferencia);
                                            $dias_diferencia = floor($dias_diferencia);

                                            echo $dias_diferencia;
                                        } else {
                                            echo "0";
                                        }
                                    } else {
                                        echo "Boqueado";
                                    }
                                    ?></span></a>
                        </ul>
                        <?php
                        }
                        ?>
                        
                    </ul> 


                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="col-xs-12">

        <div class="text-left form-group has-success  col-xs-2">
            <label class="control-label" for="codigo">Codigo</label>
            <input class="form-control" type="text" name="codigotext" id="codigo" value="<?php
            if (isset($cod) && $cod != null) {
                echo $cod;
            }
            ?>" placeholder="Codigo"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="nombres">Nombres</label>
            <input class="form-control" type="text" name="nombrestext" id="nombres" value="<?php
            if (isset($nom) && $nom != null) {
                echo $nom;
            }
            ?>" placeholder="Nombres"/>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidostext" id="apellidos" value="<?php
            if (isset($apell) && $apell != null) {
                echo $apell;
            }
            ?>" placeholder="Apellidos"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="tipo_doc">Tipo Documento</label>
            <select class="form-control" id="tipo_doc" name="tipo_doctext">
                <?php
                if (isset($tip) && $tip != null) {
                    if ($tip == 1) {
                        echo'<option>Cedula</option>';
                    } else if ($per == 2) {
                        echo'<option>Tarjeta Identidad</option>';
                    } else if ($per == 3) {
                        echo'<option>Registro Civil</option>';
                    } else if ($per == 4) {
                        echo'<option>Cedula Extrangera</option>';
                    } else if ($per == 5) {
                        echo'<option>Pasaporte</option>';
                    };
                }
                ?>
            </select>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="num_doc">Numero Documento</label>
            <input class="form-control" type="text" name="num_doctext" id="num_doc" value="<?php
            if (isset($num_doc) && $num_doc != null) {
                echo $num_doc;
            }
            ?>" placeholder="Numero Documento"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="mail">e-Mail</label>
            <input class="form-control" type="email" name="mailtext" id="mail" value="<?php
            if (isset($mail) && $mail != null) {
                echo $mail;
            }
            ?>" placeholder="e-Mail"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="celular">Celular</label>
            <input class="form-control" type="tel" name="celulartext" id="celular" value="<?php
            if (isset($cel) && $cel != null) {
                echo $cel;
            }
            ?>" placeholder="Celular"/>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="telefono">Telefono</label>
            <input class="form-control" type="tel" name="telefonotext" id="telefono" value="<?php
            if (isset($tel) && $tel != null) {
                echo $tel;
            }
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
                };
                ?>
            </select>
        </div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="grupo">Grupo</label>
            <select class="form-control" id="grupo" name="grupotext">
                <?php
                if (isset($gru) && $gru != null) {
                    $db_conexion->consultar("nombre", "grupo", "id", "=", $gru, TRUE);
                    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                        echo '<option>' . $row[0] . '</option>';
                    }
                };
                ?>
            </select>
        </div>

    </div>

</form>

<form action="../dir_bloquear/bloquear.php" method="post">
    <!-- Modal -->
    <div class="modal fade bs-example-modal-sm" id="bloquear" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Esta seguro de que desea bloquear a esta persona?</h4>
                </div>
                <div class="modal-body">
                    Ingrese la observacion por la cual se bloquea a este usuario<br>
                    <label>Observacion: </label>
                    <textarea class="form-control" white="30" height="30" name="observaciontext" id="observaciontext"></textarea>
                    <input type="hidden" name="id" id="id" value="<?php
                    if (isset($id) && $id != "") {
                        echo $id;
                    }
                    ?>"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-danger" value="Bloquear"/>
                </div>

            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).on("ready", function () {
        $("#prestar_per").click(function () {
            var id_per = $("#prestar_per").attr("value");
            $("#id_per").attr("value", id_per);
            document.form_per.submit();

        });
        $("#ver_mas").click(function () {
            var id_pres = $("#ver_mas").attr("value");
            $("#id_pres").attr("value", id_pres);
            document.form_pres.submit();
        });

        $("#bloq").click(function () {
            var id_bloq = $("#bloq").attr("value");
            $("#id_bloq").attr("value", id_bloq);
            document.form_bloq.submit();
        });
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });

        $('#bloqueo').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    });
</script>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_per">
    <input type="hidden" id="id_per" name="id_per" value="">
</form>
<form action="../dir_res_bus/info_prestamo.php" method="post" target="contenedor" name="form_pres">
    <input type="hidden" id="id_pres" name="id_pres" value="">
</form>
<form action="../dir_abonar/abonar.php" method="post" target="contenedor" name="form_abon">
    <input type="hidden" id="id_multa" name="id_multa" value="">
</form>
<form action="../dir_bloquear/desbloquear.php" method="post" target="contenedor" name="form_bloq">
    <input type="hidden" id="id_bloq" name="id_bloq" value="">
</form>