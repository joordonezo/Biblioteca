<?php
include '../scripts/librerias.php';
?>
<form action="busqueda_libro.php" method="post" name="form_tip1">
<div class="col-xs-12">
    <div class="col-xs-4 col-xs-offset-4 alert alert-warning">
        <b>CREAR INFORME DE LIBROS:</b>
    </div>
    <div class="col-xs-4 col-xs-offset-4">
        <select class="form-control" name="tipo" id="tipo">
            <option value="">---Seleccione---</option>
            <option value="1">Activos</option>
            <option value="2">Dados de baja</option>
            <option value="3">Fisicos</ption>
            <option value="4">Virtuales</option>
            <option value="" class="divider disabled">________________</option>
            <option value="5">Todo</option>
        </select>
    </div>
</div>
    </form>
<script type="text/javascript">
$(document).on("ready", function () {

            $("select#tipo").on("change", function () {
                document.form_tip1.submit();
                
            });
            
    });

</script>
