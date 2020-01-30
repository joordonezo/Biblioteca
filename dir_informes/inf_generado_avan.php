<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
if (isset($_POST['tipo']) && $_POST['tipo'] != "") {
    $tipo = $_POST['tipo'];
    ?>
    <div class="btn-group col-xs-4 col-xs-offset-4" role="group" aria-label="...">
        <div class="col-xs-12">
            <button type="button" class="btn btn-default col-xs-4" onclick="window.print();">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default col-xs-4">Guardar PDF <span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default col-xs-4" onclick="document.close();">Cerrar <span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
        </div>
    </div>
    <table class="table"> 
        <tr>
            <td class="alert-warning"><b>ID</b></td>
            <td class="alert-warning"><b>VALOR</b></td>
            <td class="alert-warning"><b>FECHA</b></td>
            <td class="alert-warning"><b>CODIGO</b></td>
            <td class="alert-warning"><b>NOMBRE</b></td>
            <td class="alert-warning"><b>APELLIDO</b></td>
            <td class="alert-warning"><b>CODIGO LIBRO</b></td>
            <td class="alert-warning"><b>NOMBRE</b></td>
            <td class="alert-warning"><b>NOMBRE PRESTADO</b></td>
            <td class="alert-warning"><b>APELLIDO</b></td>
            <td class="alert-warning"><b>ESTADO</b></td>
        </tr>
        <?php
        if (isset($_POST['fechainicio']) && $_POST['fechainicio'] != "") {
            $fecha_inicio = $_POST['fechainicio'];
        }

        if (isset($_POST['fechafin']) && $_POST['fechafin'] != "") {
            $fecha_fin = $_POST['fechafin'];
        }

        if (isset($_POST['filtrar']) && $_POST['filtrar'] != "") {
            $filtar = $_POST['filtrar'];

            if (isset($_POST['valor']) && $_POST['valor'] != "") {
                $valor = $_POST['valor'];
            }

            if ($filtar == 1) {
                //filtar por persona
                
                $db_conexion->consultar("id, codigo, nombres, apellidos", "persona", "codigo", "=", $valor, TRUE);
                
                while ($row5 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    echo '- '.$row5[1]." - ".$row5[2].' - '.$row5[3];
                    
                }
            }else if($filtar == 2){
                $db_conexion->consultar("id, codigo, nombre, autor", "libro", "codigo", "=", $valor, TRUE);
                
                while ($row6 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    echo '- '.$row6[1]." - ".$row6[2].' - '.$row6[3];
                    
                }
            }else if($filtar == 3){
                $db_conexion->consultar("id, codigo, nombre, autor", "libro", "codigo", "=", $valor, TRUE);
                
                while ($row6 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    echo '- '.$row6[1]." - ".$row6[2].' - '.$row6[3];
                    
                }
            }else if($filtar == 4){
                
            }
        }


        $db_conexion->consultar("*", "multa", "estado", "=", $tipo . " AND fecha_inicio >= " . $fecha_inicio . " AND fecha_corte <= " . $fecha_fin, TRUE);

        while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {

            echo '<tr><td>' . $row['id'] . '</td><td> $ ' . $row['valor'] . '</td><td>' . $row['fecha_inicio'] . '</td>';
            $id_prestamo = $row['prestamo_id'];
            $id_persona_p = $row['persona_id'];
        }

        $db_conexion->consultar("libro_id, persona_id1", "prestamo", "id", "=", $id_prestamo, TRUE);

        while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
            $id_libro = $row2[0];
            $id_persona = $row2[1];
        }
        $db_conexion->consultar("codigo, nombres, apellidos", "persona", "id", "=", $id_persona_p, TRUE);

        while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
            echo '<td>' . $row3[0] . '</td><td>' . $row3[1] . '</td><td>' . $row3[2] . '</td>';
        }

        $db_conexion->consultar("codigo, nombre", "libro", "id", "=", $id_libro, TRUE);

        while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
            echo '<td>' . $row4[0] . '</td><td>' . $row4[1] . '</td>';
        }
        $ico = "";
        if ($tipo == 1) {
            $tipo = "Paga";
            $ico = "ok";
        } else if ($tipo == 2) {
            $tipo = "Pendiente";
            $ico = "remove";
        } else if ($tipo == 3) {
            $tipo = "Condonada";
            $ico = "minus-sign";
        }
        $db_conexion->consultar("nombres, apellidos", "persona", "id", "=", $id_persona, TRUE);

        while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
            echo '<td>' . $row1[0] . '</td><td>' . $row1[1] . '</td><td>' . $tipo . ' <span class="glyphicon glyphicon-' . $ico . ' sussess" aria-hidden="true"></span></td><br>';
        }
    } else {
        ?>
        <div class="alert alert-warning">
            No se han encontrado registros
        </div>
        <?php
    }
    ?>
</table>
<div class="btn-group col-xs-4 col-xs-offset-4" role="group" aria-label="...">
    <div class="col-xs-12">
        <button type="button" class="btn btn-default col-xs-4" onclick="window.print();">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-default col-xs-4">Guardar PDF <span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-default col-xs-4" onclick="document.close();">Cerrar <span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
    </div>
</div>