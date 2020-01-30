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
            <td class="alert-warning"><b>CODIGO</b></td>
            <td class="alert-warning"><b>CLASIFICACION</b></td>
            <td class="alert-warning"><b>NOMBRE</b></td>
            <td class="alert-warning"><b>AUTOR</b></td>
            <td class="alert-warning"><b>TEMA</b></td>
            <td class="alert-warning"><b>EDITORIAL</b></td>
            <td class="alert-warning"><b>ESTADO FISICO</b></td>
            <td class="alert-warning"><b>MODALIDAD</b></td>
            <td class="alert-warning"><b>TIPO</b></td>
        </tr>
        <?php
        if (isset($_POST['filtrar']) && $_POST['filtrar'] != "") {
            $filtrar = $_POST['filtrar'];
            $valor = $_POST['valor'];
        }
if(isset($_POST['valor']) && $_POST['valor'] != ""){
    $valor = $_POST['valor'];
}else if(isset($_POST['valor1']) && $_POST['valor1'] != ""){
    $valor = $_POST['valor1'];
}else if(isset($_POST['valor2']) && $_POST['valor2'] != ""){
    $valor = $_POST['valor2'];
}


        if ($filtrar == 1) {
            if ($tipo == 5) {
                $db_conexion->consultar("*", "libro", "nombre", "LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 1) {
                $db_conexion->consultar("*", "libro", "estado", "=", 1 . " AND nombre LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 2) {
                $db_conexion->consultar("*", "libro", "estado", "=", 0 . " AND nombre LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 3) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 1 . " AND nombre LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 4) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 2 . " AND nombre LIKE '%" . $valor . "%'", TRUE);
            } else {
                ?>
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
                <?php
            }
        } else if ($filtrar == 2) {
            if ($tipo == 5) {
                $db_conexion->consultar("*", "libro", "autor", "LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 1) {
                $db_conexion->consultar("*", "libro", "estado", "=", 1 . " AND autor LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 2) {
                $db_conexion->consultar("*", "libro", "estado", "=", 0 . " AND autor LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 3) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 1 . " AND autor LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 4) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 2 . " AND autor LIKE '%" . $valor . "%'", TRUE);
            } else {
                ?>
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
                <?php
            }
        } else if ($filtrar == 3) {
            if ($tipo == 5) {
                $db_conexion->consultar("*", "libro", "tema", "LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 1) {
                $db_conexion->consultar("*", "libro", "estado", "=", 1 . " AND tema LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 2) {
                $db_conexion->consultar("*", "libro", "estado", "=", 0 . " AND tema LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 3) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 1 . " AND tema LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 4) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 2 . " AND tema LIKE '%" . $valor . "%'", TRUE);
            } else {
                ?>
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
                <?php
            }
        } else if ($filtrar == 4) {
            if ($tipo == 5) {
                $db_conexion->consultar("*", "libro", "editorial", "LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 1) {
                $db_conexion->consultar("*", "libro", "estado", "=", 1 . " AND editorial LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 2) {
                $db_conexion->consultar("*", "libro", "estado", "=", 0 . " AND editorial LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 3) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 1 . " AND editorial LIKE '%" . $valor . "%'", TRUE);
            } else if ($tipo == 4) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 2 . " AND editorial LIKE '%" . $valor . "%'", TRUE);
            } else {
                ?>
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
                <?php
            }
        } else if ($filtrar == 5) {
            if ($tipo == 5) {
                $db_conexion->consultar("*", "libro", "estado_fisico", "=" . $valor, TRUE);
            } else if ($tipo == 1) {
                $db_conexion->consultar("*", "libro", "estado", "=", 1 . " AND estado_fisico = " . $valor, TRUE);
            } else if ($tipo == 2) {
                $db_conexion->consultar("*", "libro", "estado", "=", 0 . " AND estado_fisico = " . $valor, TRUE);
            } else if ($tipo == 3) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 1 . " AND estado_fisico = " . $valor, TRUE);
            } else if ($tipo == 4) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 2 . " AND estado_fisico = " . $valor, TRUE);
            } else {
                ?>
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
                <?php
            }
        } else if ($filtrar == 6) {
            if ($tipo == 5) {
                $db_conexion->consultar("*", "libro", "modalidad", "=" . $valor . "%'", TRUE);
            } else if ($tipo == 1) {
                $db_conexion->consultar("*", "libro", "estado", "=", 1 . " AND modalidad = " . $valor, TRUE);
            } else if ($tipo == 2) {
                $db_conexion->consultar("*", "libro", "estado", "=", 0 . " AND modalidad =" . $valor, TRUE);
            } else if ($tipo == 3) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 1 . " AND modalidad =" . $valor, TRUE);
            } else if ($tipo == 4) {
                $db_conexion->consultar("*", "libro", "tipo", "=", 2 . " AND modalidad =" . $valor, TRUE);
            } else {
                ?>
                <div class="alert alert-warning">
                    No se han encontrado registros
                </div>
                <?php
            }
        } 
        while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
            if ($row['estado_fisico'] == 1) {
                $estado_fisico = "Excelente";
            } elseif ($row['estado_fisico'] == 2) {
                $estado_fisico = "Sobresaliente";
            } elseif ($row['estado_fisico'] == 3) {
                $estado_fisico = "Aceptable";
            } elseif ($row['estado_fisico'] == 4) {
                $estado_fisico = "Insuficiente";
            } elseif ($row['estado_fisico'] == 5) {
                $estado_fisico = "Deficiente";
            }
            if ($row['modalidad'] == 1) {
                $modalidad = "Institucional";
            } elseif ($row['modalidad'] == 2) {
                $modalidad = "Personal";
            }
            if ($row['tipo'] == 1) {
                $tipo = "Fisico";
            } elseif ($row['tipo'] == 2) {
                $tipo = "Virtual";
            }
            echo '<tr><td>' . $row['id'] . '</td><td>' . $row['codigo'] . '</td><td>' . $row['clasificacion'] . '</td><td>' . $row['nombre'] . '</td><td>' . $row['autor'] . '</td><td>' . $row['tema'] . '</td><td>' . $row['editorial'] . '</td><td>' . $estado_fisico . '</td><td>' . $modalidad . '</td><td>' . $tipo . '</td>';
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

