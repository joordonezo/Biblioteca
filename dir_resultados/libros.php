<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<?php
include '../scripts/librerias.php';
if (isset($_POST['libro']) && $_POST['libro'] != null) {
    include '../scripts/db_conexion.php';
    $db_conexion = new db_conexion();
    $db_conexion->consultar("*", "libro", "id", "=", $_POST['libro'], TRUE);
    while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id = $row['id'];
        $cod = $row['codigo'];
        $clas = $row['clasificacion'];
        $isbn = $row['isbn'];
        $edit = $row['editorial'];
        $nomb = $row['nombre'];
        $aut = $row['autor'];
        $area = $row['area'];
        $tem = $row['tema'];
        $est_fis = $row['estado_fisico'];
        $tip = $row['tipo'];
        $estado = $row['estado'];
        $desc = $row['descripcion'];
        $pal_cla = $row['palabras_clave'];
        $mod = $row['modalidad'];
        $per_id = $row['persona_id'];
    }
    $db_conexion->consultar("id, fecha_inicio, fecha_corte", "prestamo", "libro_id", "=", $id . " AND estado = " . TRUE, TRUE);

    while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_pre = $row1[0];
        $fech_ini_p = $row1[1];
        $fech_cor_p = $row1[1];
    }
    $db_conexion->consultar("id, fecha_inicio, persona_id, observacion", "bloqueo_libro", "libro_id", "=", $id . " AND estado = " . 1, TRUE);

    while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_blo = $row2[0];
        $fech_ini_blo = $row2[1];
        $id_per_que_blo = $row2[2];
        $observacion = $row2[3];
    }
    $db_conexion->consultar("id, fecha_reservacion, fecha_fin, persona_id", "reservacion_libro", "libro_id", "=", $id . " AND estado = 1", TRUE);

    while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
        $id_res = $row3[0];
        $fecha_re = $row3[1];
        $fecha_fin_ren = $row3[2];
        $id_per = $row3[3];
    }
 
    
    if (isset($id_pre) && $id_pre != "") {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Este libro se encuentra en un <strong>Prestamo</strong> Activo</div>
            <div class="btn btn-block btn-danger col-xs-12" id="ver_mas" value="<?php echo $id_pre; ?>">Ver informacion del prestamo</div>
        </div>   
        <?php
    } else if (isset($id_blo) && $id_blo != "") {
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Este libro Tiene un <strong>BLOQUEO</strong> que inicio <strong><?php echo $fech_ini_blo; ?></strong> por el motivo de: <b><?php echo $observacion; ?></b>

            </div>
            <div class="btn btn-block btn-danger col-xs-12" id="bloq" value="<?php echo $id_blo; ?>">Quitar el <b>BLOQUEO</b></div>

        </div> 
        <?php
    }else if (isset($id_res) && $id_res != "") {
         $hoy = strtotime(date('Y-m-d'));
    $fec_fin = strtotime($fecha_fin_ren);
        if($hoy <= $fec_fin){
        $db_conexion->consultar("id, nombres, apellidos", "persona", "id", "=", $id_per, TRUE);

        while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
            $id_pe = $row4[0];
            $nomb_pe = $row4[1];
            $ape_pe = $row4[2];
        }
        ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Este libro se encuentra reservado por <strong><?php echo $nomb_pe . " " . $ape_pe; ?></strong> desde <strong><?php echo $fecha_re; ?></strong> y hay plazo hasta <strong><?php echo $fecha_fin_ren; ?></strong> para efectuar el prestamo</div>
            <div class="btn btn-block btn-danger col-xs-12" id="efectuar" value="<?php  $id_pre; ?>">Efectuar el prestamo ahora</div>

        </div>   
        <?php
        }else if($hoy > $fec_fin){
            $db_conexion->actualizar("reservacion_libro", "estado", 2, "id", "=", $id_res, TRUE);
             ?>
        <div class="alert alert-warning has col-xs-4 col-xs-offset-4">
            <div class="">Este libro se encontraba reservado vuelve a buscarlo y se encontrara disponible</div>
                
        </div>
                <?php
        }
        
    }
}
?>
<form action="" method="post" enctype="multipar/form-data">

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
                    if (isset($tip) && $tip == 1) {
                        if (isset($id_pre) && $id_pre != "" || isset($id_blo) && $id_blo != "" || isset($id_res) && $id_res != "") {
                            
                        } else {
                            ?>
                            <a> <div class="btn navbar-brand" id="prestar_lib" value="<?php echo $id; ?>">Prestar el Libro</div></a>
                            <a><div class="btn text-success" id="trueque" value="<?php echo $id; ?>"><b>Poner En Trueque</b></div></a>
                            <a><input type="button" class="navbar text-info" data-toggle="modal" data-target="#reservar" value="Reservar"/></a>
                            <?php
                        }
                    } else {
                        ?>
                        <a> <div class="btn navbar-brand" id="" value="">Virtual</div></a>
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
                            <a href="#" class="dropdown-toggle text-success" data-toggle="dropdown" role="button" aria-expanded="false">Actualizar datos <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" target="contenedor">Generales</a></li>
                                <li><a href="#" target="contenedor">ubicacion</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informes <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Multas</a></li>
                                <li><a href="#">Libros</a></li>
                                <li><a href="#">Prestamos</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Todo</a></li>
                            </ul>
                        </li>

                    </ul> 
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="text-warning col-xs-4 col-xs-offset-4"><b>LIBRO AGREGADO POR: </b><span class="badge"><?php
            $db_conexion->consultar("nombres, apellidos", "persona", "id", "=", $per_id, TRUE);
            while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
                echo $row1[0] . ' ' . $row1[1];
            }
            ?></span></div>

    <?php
    if (isset($tip) && $tip == 1) {
        if (isset($id_pre) && $id_pre != "" || isset($id_blo) && $id_blo != "") {
            
        } else {
            ?>
            <div class="col-xs-4 col-xs-offset-4">
                <?php
                $db_conexion->consultar("*", "ubicacion", "libro_id", "=", $_POST['libro'], TRUE);
                while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    $sala = $row2['sala'];
                    $estante = $row2['estante'];
                    $fila = $row2['fila'];
                    $columna = $row2['columna'];
                    $area = $row2['area'];
                }
                if (!isset($sala) || !isset($estante) || !isset($fila) || !isset($columna) || !isset($area)) {
                    ?>


                    <a><div class="btn text-success" id="ubicacion" name="ubicacion" value="<?php echo $_POST['libro']; ?>"><b>Agrega una Ubicacion</b></div></a>


                    <?php
                } else {
                    if ($sala == 1) {
                        $sala = "Biblioteca Primaria";
                    } else if ($sala == 2) {
                        $sala = "Biblioteca Bachillerato";
                    } else {
                        $sala = "-";
                    }

                    if ($estante == 1) {
                        $estante = "ST # 1";
                    } else if ($estante == 2) {
                        $estante = "ST # 2";
                    } else if ($estante == 3) {
                        $estante = "ST # 3";
                    } else if ($estante == 4) {
                        $estante = "ST # 4";
                    } else if ($estante == 5) {
                        $estante = "ST # 5";
                    } else if ($estante == 6) {
                        $estante = "ST # 6";
                    } else if ($estante == 7) {
                        $estante = "ST # 7";
                    } else if ($estante == 8) {
                        $estante = "ST # 8";
                    } else if ($estante == 9) {
                        $estante = "ST # 9";
                    } else if ($estante == 10) {
                        $estante = "ST # 10";
                    } else if ($estante == 11) {
                        $estante = "ST # 11";
                    } else if ($estante == 12) {
                        $estante = "ST # 12";
                    } else {
                        $estante = "-";
                    }

                    if ($fila == 1) {
                        $fila = "F # 1";
                    } else if ($fila == 2) {
                        $fila = "F # 2";
                    } else if ($fila == 3) {
                        $fila = "F # 3";
                    } else if ($fila == 4) {
                        $fila = "F # 4";
                    } else if ($fila == 5) {
                        $fila = "F # 5";
                    } else {
                        $fila = "-";
                    }

                    if ($columna == 1) {
                        $columna = "C # 1";
                    } else if ($columna == 2) {
                        $columna = "C # 2";
                    } else if ($columna == 3) {
                        $columna = "C # 3";
                    } else if ($columna == 4) {
                        $columna = "C # 4";
                    } else if ($columna == 5) {
                        $columna = "C # 5";
                    } else if ($columna == 6) {
                        $columna = "C # 6";
                    } else if ($columna == 7) {
                        $columna = "C # 7";
                    } else if ($columna == 8) {
                        $columna = "C # 8";
                    } else {
                        $columna = "-";
                    }
                }
                ?>
                <div class="text-warning"><b>SALA: </b><span class="badge"><?php
                        if (isset($sala) && $sala != null) {
                            echo $sala;
                        } else {
                            echo '-';
                        };
                        ?></span></div>
                <div class="text-warning"><b>ESTANTE: </b><span class="badge"><?php
                        if (isset($estante) && $estante != null) {
                            echo $estante;
                        } else {
                            echo '-';
                        };
                        ?></span></div>
                <div class="text-warning"><b>FILA: </b><span class="badge"><?php
                        if (isset($fila) && $fila != null) {
                            echo $fila;
                        } else {
                            echo '-';
                        };
                        ?></span></div>
                <div class="text-warning"><b>COLUMNA: </b><span class="badge"><?php
                        if (isset($columna) && $columna != null) {
                            echo $columna;
                        } else {
                            echo '-';
                        };
                        ?></span></div>
            </div>

            <?php
        }
    }
    ?>
    <div class="clearfix"></div>
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
            if (isset($clas) && $clas != null) {
                echo $clas;
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
            if (isset($nomb) && $nomb != null) {
                echo $nomb;
            };
            ?>" placeholder="Nombre Libro"/>
        </div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="nom_autor">Nombre Autor</label>
            <input class="form-control" type="text" name="nombre_autor" id="nom_autor" value="<?php
            if (isset($aut) && $aut != null) {
                echo $aut;
            };
            ?>" placeholder="Nombre Autor"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="area">Area</label>
            <select class="form-control" id="area" name="area">
                <?php
                if (isset($area) && $area != null) {
                    if ($area == 1) {
                        echo'<option>Matematicas</option>';
                    } else if ($area == 2) {
                        echo'<option>Fisica</option>';
                    } else if ($area == 3) {
                        echo'<option>Quimica</option>';
                    } else if ($area == 4) {
                        echo'<option>Filosofia</option>';
                    } else if ($area == 5) {
                        echo'<option>Literatura</option>';
                    } else if ($area == 6) {
                        echo'<option>Informaticca</option>';
                    };
                }
                ?>
            </select>
        </div>
        <div class="text-left form-group has-success  col-xs-3">
            <label class="control-label" for="tema">Tema</label>
            <input class="form-control" type="text" name="tema" id="tema" value="<?php
            if (isset($tem) && $tem != null) {
                echo $tem;
            };
            ?>" placeholder="Tema"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="estado_fisico">Estado fisico</label>
            <select class="form-control" id="estado_fisico" name="estado_fisico">
                <?php
                if (isset($est_fis) && $est_fis != null) {
                    if ($est_fis == 1) {
                        echo'<option>Excelente</option>';
                    } else if ($est_fis == 2) {
                        echo'<option>Sobresaliente</option>';
                    } else if ($est_fis == 3) {
                        echo'<option>Aceptable</option>';
                    } else if ($est_fis == 4) {
                        echo'<option>Insufisiente</option>';
                    } else if ($est_fis == 5) {
                        echo'<option>Deficiente</option>';
                    };
                }
                ?>
            </select>
        </div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo">
                <?php
                if (isset($tip) && $tip != null) {
                    if ($tip == 1) {
                        echo'<option>Fisico</option>';
                    } else if ($tip == 2) {
                        echo'<option>Virtual</option>';
                    };
                }
                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="modalidad">Modalidad</label>
            <select class="form-control" id="modalidad" name="modalidad">
                <?php
                if (isset($mod) && $mod != null) {
                    if ($mod == 1) {
                        echo'<option>Institucional</option>';
                    } else if ($mod == 2) {
                        echo'<option>Personal</option>';
                    };
                }
                ?>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="text-left form-group has-success  col-xs-4">
            <label class="control-label" for="descripcion">Descripcion</label>
            <div class="text-warning"><span class="badge col-xs-12 row-xs-12"><?php
                    if (isset($desc) && $desc != null) {
                        echo $desc;
                    };
                    ?></span></div>


        </div>
        <div class="text-left form-group has-success  col-xs-4">
            <label class="control-label" for="pal_clave">Palabras Clave</label>
            <div class="text-warning"><span class="badge col-xs-4"><?php
                    if (isset($pal_cla) && $pal_cla != null) {
                        echo $pal_cla;
                    };
                    ?></span></div>

        </div>
        <div class="clearfix"></div>

    </div>
</form>

<form action="../dir_bloquear/bloquear.php" method="post">
    <!-- Modal -->
    <div class="modal fade bs-example-modal-sm" id="bloquear" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Esta seguro de que desea bloquear a este libro?</h4>
                </div>
                <div class="modal-body">
                    Ingrese la observacion por la cual desea bloquear este libro<br>
                    <label>Observacion: </label>
                    <textarea class="form-control" white="30" height="30" name="observaciontext" id="observaciontext"></textarea>
                    <input type="hidden" name="id_l" id="id_l" value="<?php
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

<form action="../dir_ubicacion/ubicacion.php" method="post" target="contenedor" name="formlib">
    <input type="hidden" id="id_lib" name="id_lib" value="">
</form>
<script type="text/javascript">
    $(document).on("ready", function () {
        $("#ubicacion").click(function () {
            var idl = $("#ubicacion").attr("value");
            $("#id_lib").attr("value", idl);
            document.formlib.submit();

        });
        $("#prestar_lib").click(function () {
            var id_lib = $("#prestar_lib").attr("value");
            $("#id_libr").attr("value", id_lib);
            document.form_lib.submit();
        });
        $("#ver_mas").click(function () {
            var id_pres = $("#ver_mas").attr("value");
            $("#id_pres").attr("value", id_pres);
            document.form_pres.submit();
        });
        $('#bloqueo').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
        $('#reservar').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
        $("#bloq").click(function () {
            var id_bloq = $("#bloq").attr("value");
            $("#id_bloq_l").attr("value", id_bloq);
            document.form_bloq_l.submit();
        });
        $("#trueque").click(function () {
            var idl = $("#trueque").attr("value");
            $("#id_lib_t").attr("value", idl);
            document.form_true.submit();

        });
        $("#efectuar").click(function () {
            document.form_efec.submit();
        });
    });
</script>
<form action="../dir_res_bus/busqueda.php" method="post" target="contenedor" name="form_lib">
    <input type="hidden" id="id_libr" name="id_libr" value="">
</form>
<form action="../dir_res_bus/info_prestamo.php" method="post" target="contenedor" name="form_pres">
    <input type="hidden" id="id_pres" name="id_pres" value="">
</form>
<form action="../dir_bloquear/desbloquear.php" method="post" target="contenedor" name="form_bloq_l">
    <input type="hidden" id="id_bloq_l" name="id_bloq_l" value="">
</form>
<form action="../dir_trueque/trueque.php" method="post" target="contenedor" name="form_true">
    <input type="hidden" id="id_lib_t" name="id_lib_t" value="">
</form>
<form action="../dir_reservar/reservar.php" method="post" name="">
    <div class="modal fade bs-example-modal-sm" id="reservar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Esta seguro de que desea reservar a este libro?</h4>
                </div>
                <div class="modal-body">
                    Ingrese el codigo de la persona que reserva el libro<br>
                    <label>Codigo: </label>
                    <input class="form-control" type="text" id="cod" name="cod" value=""/>
                    <input type="hidden" name="id_l" id="id_l" value="<?php
                    if (isset($id) && $id != "") {
                        echo $id;
                    }
                    ?>"/>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="hidden" class="btn btn-danger" name="envi" value="enviado"/>
                    <input type="submit" class="btn btn-danger" value="Buscar"/>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" id="id_lib_r" name="id_lib_r" value="<?php $id; ?>">
</form>
<form action="../dir_prestamo/prestado.php" method="post" target="contenedor" name="form_efec">
    <input type="hidden" id="id_1" name="id_1" value="<?php echo $id_per; ?>">
    <input type="hidden" id="id_2" name="id_2" value="<?php echo $id; ?>">
    <input type="hidden" id="id_res" name="id_res" value="<?php echo $id_res; ?>">
  
</form>