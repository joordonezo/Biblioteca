<?php
include '../scripts/librerias.php';
?>
<form action="busqueda_prestamos.php" method="post" name="form_tip2">
<div class="col-xs-12">
    <div class="col-xs-4 col-xs-offset-4 alert alert-warning">
        <b>CREAR INFORME DE PRESTAMOS:</b>
    </div>
    <div class="col-xs-4 col-xs-offset-4">
        <select class="form-control" name="tipo" id="tipo">
            <option value="">---Seleccione---</option>
            <option value="1">Activos</option>
            <option value="2">Inactivos</option>
            <option value="" class="divider disabled">________________</option>
            <option value="5">Todos</option>
        </select>
    </div>
</div>
    </form>
<script type="text/javascript">
$(document).on("ready", function () {

            $("select#tipo").on("change", function () {
                document.form_tip2.submit();
                
            });
            
    });

</script>

