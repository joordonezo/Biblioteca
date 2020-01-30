<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<?php
include '../scripts/librerias.php';

if (isset($_POST['tipo']) && $_POST['tipo'] != "") {
    $tipo = $_POST['tipo'];
    ?>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <form action="inf_generado_lib.php" method="post" name="">

                <input class="btn btn-danger col-xs-12" type="submit" name="" id="" value="Generar reporte"/>
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
        <a class="btn btn-warning col-xs-2 col-xs-offset-5" href="sel_libro.php">Volver</a>
        <form action="inf_generado_lib_avan.php" method="post">
            <!-- Modal -->
            <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Informe avanzado</h4>
                        </div>
                        <div class="modal-body">

                            <div class="col-xs-12">

                                <div class="form-group has-success col-xs-12">
                                    <label class="control-label" for="Filtrar">Filtar por</label>
                                    <select class="form-control" id="filtrar" name="filtrar">
                                        <option value="">---Filtar por---</option>
                                        <option value="1">Nombre Libro</option>
                                        <option value="2">Autor Libro</option>
                                        <option value="3">Tema</option>
                                        <option value="4">Editorial</option>
                                        <option value="5">Estado Fisico</option>
                                        <option value="6">Modalidad</option>

                                    </select>
                                    <label class="control-label" for="valor">Valor</label>
                                    <input class="form-control" type="text" name="valor" id="valor" value="" placeholder="Codigo"/>
                                    
                                    <select class="form-control" id="estado" name="valor1">
                                        <option value="">---Seleccione---</option>
                                        <option value="1">Excelente</option>
                                        <option value="2">Sobresaliente</option>
                                        <option value="3">Aceptable</option>
                                        <option value="4">Insuficiente</option>
                                        <option value="5">Deficiente</option>


                                    </select>

                                    <select class="form-control" id="modalidad" name="valor2">
                                        <option value="">---Seleccione---</option>
                                        <option value="1">Institucional</option>
                                        <option value="2">Personal</option>

                                    </select>
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

        header("Location: sel_libro.php");
    }
    if (isset($_POST['ok']) && $_POST['ok'] == "ok") {
        
    }
    ?>
    <script type="text/javascript">
        $(document).on("ready", function () {
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });


            $("#estado").slideUp('fast');
            $("#modalidad").slideUp('fast');

            $("select#filtrar").on("change", function () {
                var id = $(this).val();

                if (id == 5) {
                    $("#valor").slideUp('fast');
                    $("#estado").slideDown('fast');
                    $("#modalidad").slideUp('fast');
                } else if (id == 6) {
                    $("#valor").slideUp('fast');
                    $("#modalidad").slideDown('fast');
                    $("#estado").slideUp('fast');
                } else {
                    $("#valor").slideDown('fast');
                    $("#estado").slideUp('fast');
                    $("#modalidad").slideUp('fast');
                }
            });
        });

    </script>
