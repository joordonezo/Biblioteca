<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<?php
include '../scripts/librerias.php';

if (isset($_POST['tipo']) && $_POST['tipo'] != "") {
    $tipo = $_POST['tipo'];
    ?>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <form action="inf_generado.php" method="post" name="">

                <input class="btn btn-danger col-xs-12" type="submit" name="" id="" value="Generar reporte desde el inicio hasta hoy"/>
                <input type="hidden" name="ok" id="ok" value="ok"/>
                <input type="hidden" name="tipo" id="tipo" value="<?php
                if (isset($tipo) && $tipo != "") {
                    echo $tipo;
                }
                ?>"/>
            </form>

        </div><!-- /.col-lg-6 -->
        <div class="clearfix"></div>
        <button type="button" class="btn btn-default btn-lg col-xs-4 col-xs-offset-4" data-toggle="modal" data-target="#myModal">
            Busqueda con filtros avanzados
        </button>
        <a class="btn btn-warning col-xs-2 col-xs-offset-5" href="sel_multas.php">Volver</a>
        <form action="inf_generado_avan.php" method="post">
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Informe avanzado</h4>
                        </div>
                        <div class="modal-body">

                            <div class="col-xs-12">
                                <div class="text-left form-group has-success  col-xs-6">
                                    <label class="control-label" for="fechainicio">Fecha Inicio</label>
                                    <input class="form-control" type="date" name="fechainicio" id="fechainicio" value=""/>
                                </div>
                                <div class="text-left form-group has-success  col-xs-6">
                                    <label class="control-label" for="fecha">Fecha Fin</label>
                                    <input class="form-control" type="date" name="fechafin" id="fechafin" value=""/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group has-success col-xs-6">
                                    <label class="control-label" for="Filtrar">Filtar por</label>
                                    <select class="form-control" id="filtar" name="filtar">
                                        <option value="">---Filtar por---</option>
                                        <option value="1">Persona</option>
                                        <option value="2">Libro</option>
                                        <option value="3">Valor</option>
                                        <option value="4">-----</option>

                                    </select>
                                </div>
                                <div class="text-left form-group has-success  col-xs-6">
                                    <label class="control-label" for="valor">Codigo</label>
                                    <input class="form-control" type="text" name="valor" id="valor" value="" placeholder="Codigo"/>
                                </div>
                            </div>
                            <input type="hidden" name="tipo" id="tipo" value="<?php
                            if (isset($tipo) && $tipo != "") {
                                echo $tipo;
                            }
                            ?>"/>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-danger" value="Generar informe"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    } else {

        header("Location: sel_multas.php");
    }
    if (isset($_POST['ok']) && $_POST['ok'] == "ok") {
        
    }
    ?>
    <script type="text/javascript">
        $(document).on("ready", function () {
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });

        });

    </script>