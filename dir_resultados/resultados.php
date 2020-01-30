<?php
require_once '../scripts/db_conexion.php';
include '../scripts/librerias.php';
$db_conexion = new db_conexion();
$busqueda = $_GET['busqueda'];
if ($busqueda == "") {
    ?>
<div class="alert alert-warning has col-xs-3 col-xs-offset-5"><strong>Vacio!</strong> El campo de busqueda</div>
    <?php
} else {
    ?>


    <div class="col-xs-12">
        <div class="panel panel-default"> <!-- Default panel contents --> 
            <div class="panel-heading">(...) Resultados encontrados por <b>personas</b>  de (...)</div> 

            <table class="table"> 
                <tr>
                    <td class="alert-warning"><b>ID</b></td>
                    <td class="alert-warning"><b>CODIGO</b></td>
                    <td class="alert-warning"><b>NOMBRES</b></td>
                    <td class="alert-warning"><b>APELLIDOS</b></td>
                    <td class="alert-warning"><b>PERFIL</b></td>
                    <td class="alert-warning"><b>CELULAR</b></td>
                    <td class="alert-warning"><b>TELEFONO</b></td>
                    <td class="alert-warning"><b>CORREO</b></td>
                </tr>

                <?php
                $db_conexion->consultar("*", "persona", "codigo", "LIKE", "'%" . $busqueda . "%' LIMIT 5", True);
                $class = "";
                while ($row1 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    if ($row1['perfil'] == 1) {
                        $perfil = "Administrador";
                        $class = "btn-danger col-sm-9";
                    } else if ($row1['perfil'] == 2) {
                        $perfil = "Estudiante";
                        $class = "btn-success col-sm-9";
                    } else if ($row1['perfil'] == 3) {
                        $perfil = "Docente";
                        $class = "btn-warning col-sm-9";
                    } else if ($row1['perfil'] == 4) {
                        $perfil = "Acudiente";
                        $class = "btn-default col-sm-9";
                    } else {
                        $perfil = "Indefinido";
                        $class = "btn-info col-sm-9";
                    }
                   
                   echo '<tr><td><div class="btn alert-dismissable text-success" id="id_persona" value="'.$row1['id'].'"><b>'. $row1['id'] .'</b></div></td> <td><div class="btn alert-dismissable text-success" id="cod_persona" value="'.$row1['id'].'"><b>'. $row1['codigo'] . '</b></div></td> <td><div class="btn alert-dismissable text-success" id="nom_persona" value="'.$row1['id'].'"><b>'. $row1['nombres'] . '</b></div> </td> <td><div class="btn alert-dismissable text-success" id="apell_persona" value="'.$row1['id'].'"><b>'. $row1['apellidos'] . '</b></div></td> <td><div class="'.$class.'"></di>' . $perfil . '</td> <td><b>' . $row1['celular'] . '</b></td> <td><b>' . $row1['telefono'] . '</b></td> <td><div class="btn col-xs-12 btn-warning" id="correo" value="'.$row1['mail'].'">' . $row1['mail'] . '</div></td></tr>';
                   
                }
                $db_conexion->consultar("*", "persona", "nombres", "LIKE", "'%" . $busqueda . "%' LIMIT 5", True);
                while ($row2 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    if ($row2['perfil'] == 1) {
                        $perfil = "Administrador";
                        $class = "btn-danger col-sm-9";
                    } else if ($row2['perfil'] == 2) {
                        $perfil = "Estudiante";
                        $class = "btn-success col-sm-9";
                    } else if ($row2['perfil'] == 3) {
                        $perfil = "Docente";
                        $class = "btn-warning col-sm-9";
                    } else if ($row2['perfil'] == 4) {
                        $perfil = "Acudiente";
                        $class = "btn-default col-sm-9";
                    } else {
                        $perfil = "Indefinido";
                        $class = "btn-info col-sm-9";
                    }
                    echo '<tr><td><div class="btn alert-dismissable text-success" id="id1_persona" value="'.$row2['id'].'"><b>'. $row2['id'] .'</b></div></td> <td><div class="btn alert-dismissable text-success" id="cod1_persona" value="'.$row2['id'].'"><b>'. $row2['codigo'] . '</b></div></td> <td><div class="btn alert-dismissable text-success" id="nom1_persona" value="'.$row2['id'].'"><b>'. $row2['nombres'] . '</b></div> </td> <td><div class="btn alert-dismissable text-success" id="apell1_persona" value="'.$row2['id'].'"><b>'. $row2['apellidos'] . '</b></div></td> <td><div class="'.$class.'"></di>' . $perfil . '</td> <td><b>' . $row2['celular'] . '</b></td> <td><b>' . $row2['telefono'] . '</b></td> <td><div class="btn col-xs-12 btn-warning" id="correo1" value="'.$row2['mail'].'">' . $row2['mail'] . '</div></td></tr>';
                }
                $db_conexion->consultar("*", "persona", "apellidos", "LIKE", "'%" . $busqueda . "%' LIMIT 5", True);
                while ($row3 = mysqli_fetch_array($GLOBALS['consultar'])) {
                   if ($row3['perfil'] == 1) {
                        $perfil = "Administrador";
                        $class = "btn-danger col-sm-9";
                    } else if ($row3['perfil'] == 2) {
                        $perfil = "Estudiante";
                        $class = "btn-success col-sm-9";
                    } else if ($row3['perfil'] == 3) {
                        $perfil = "Docente";
                        $class = "btn-warning col-sm-9";
                    } else if ($row3['perfil'] == 4) {
                        $perfil = "Acudiente";
                        $class = "btn-default col-sm-9";
                    } else {
                        $perfil = "Indefinido";
                        $class = "btn-info col-sm-9";
                    }
                    echo '<tr><td><div class="btn alert-dismissable text-success" id="id2_persona" value="'.$row3['id'].'"><b>'. $row3['id'] .'</b></div></td> <td><div class="btn alert-dismissable text-success" id="cod2_persona" value="'.$row3['id'].'"><b>'. $row3['codigo'] . '</b></div></td> <td><div class="btn alert-dismissable text-success" id="nom2_persona" value="'.$row3['id'].'"><b>'. $row3['nombres'] . '</b></div> </td> <td><div class="btn alert-dismissable text-success" id="apell2_persona" value="'.$row3['id'].'"><b>'. $row3['apellidos'] . '</b></div></td> <td><div class="'.$class.'"></di>' . $perfil . '</td> <td><b>' . $row3['celular'] . '</b></td> <td><b>' . $row3['telefono'] . '</b></td> <td><div class="btn col-xs-12 btn-warning" id="correo2" value="'.$row3['mail'].'">' . $row3['mail'] . '</div></td></tr>';
                }
                ?>

            </table> 
            <div class="panel-heading">(...) Resultados encontrados por <b>libros</b>  de (...)</div>
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
                $db_conexion->consultar("*", "libro", "codigo", "LIKE", "'%" . $busqueda . "%' LIMIT 50", True);
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
                    echo '<tr><td><div class="btn alert-dismissable text-success" id="id_libro" value="'.$row['id'].'"><b>' . $row['id'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="cod_libro" value="'.$row['id'].'"><b>' . $row['codigo'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="clas_libro" value="'.$row['id'].'"><b>' . $row['clasificacion'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="nom_libro" value="'.$row['id'].'"><b>' . $row['nombre'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="aut_libro" value="'.$row['id'].'"><b>' . $row['autor'] . ' </b></div></td><td><div class="btn alert-dismissable text-success" id="tema_libro" value="'.$row['id'].'"><b>' . $row['tema'] . ' </b></div> </td><td><b> ' . $row['editorial'] . '</b></td><td><b>' . $row['numero_ejemplares'] . '</b></td><td><b>' . $estado_fisico . '</b></td><td><b>' . $modalidad . '</b></td><td><b>' . $tipo . '</b></td></tr>';
                }
                $db_conexion->consultar("*", "libro", "nombre", "LIKE", "'%" . $busqueda . "%' LIMIT 50", True);
                while ($row4 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    if ($row4['estado_fisico'] == 1) {
                        $estado_fisico = "Excelente";
                    } elseif ($row4['estado_fisico'] == 2) {
                        $estado_fisico = "Sobresaliente";
                    } elseif ($row4['estado_fisico'] == 3) {
                        $estado_fisico = "Aceptable";
                    } elseif ($row4['estado_fisico'] == 4) {
                        $estado_fisico = "Insuficiente";
                    } elseif ($row4['estado_fisico'] == 5) {
                        $estado_fisico = "Deficiente";
                    }
                    if ($row4['modalidad'] == 1) {
                        $modalidad = "Institucional";
                    } elseif ($row4['modalidad'] == 2) {
                        $modalidad = "Personal";
                    }
                    if ($row4['tipo'] == 1) {
                        $tipo = "Fisico";
                    } elseif ($row4['tipo'] == 2) {
                        $tipo = "Virtual";
                    }
                    echo '<tr><td><div class="btn alert-dismissable text-success" id="id4_libro" value="'.$row4['id'].'"><b>' . $row4['id'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="cod4_libro" value="'.$row4['id'].'"><b>' . $row4['codigo'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="clas4_libro" value="'.$row4['id'].'"><b>' . $row4['clasificacion'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="nom4_libro" value="'.$row4['id'].'"><b>' . $row4['nombre'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="aut4_libro" value="'.$row4['id'].'"><b>' . $row4['autor'] . ' </b></div></td><td><div class="btn alert-dismissable text-success" id="tema4_libro" value="'.$row4['id'].'"><b>' . $row4['tema'] . ' </b></div> </td><td><b> ' . $row4['editorial'] . '</b></td><td><b>' . $estado_fisico . '</b></td><td><b>' . $modalidad . '</b></td><td><b>' . $tipo . '</b></td></tr>';
                }
                $db_conexion->consultar("*", "libro", "autor", "LIKE", "'%" . $busqueda . "%' LIMIT 50", True);
                while ($row5 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    if ($row5['estado_fisico'] == 1) {
                        $estado_fisico = "Excelente";
                    } elseif ($row5['estado_fisico'] == 2) {
                        $estado_fisico = "Sobresaliente";
                    } elseif ($row5['estado_fisico'] == 3) {
                        $estado_fisico = "Aceptable";
                    } elseif ($row5['estado_fisico'] == 4) {
                        $estado_fisico = "Insuficiente";
                    } elseif ($row5['estado_fisico'] == 5) {
                        $estado_fisico = "Deficiente";
                    }
                    if ($row5['modalidad'] == 1) {
                        $modalidad = "Institucional";
                    } elseif ($row5['modalidad'] == 2) {
                        $modalidad = "Personal";
                    }
                    if ($row5['tipo'] == 1) {
                        $tipo = "Fisico";
                    } elseif ($row5['tipo'] == 2) {
                        $tipo = "Virtual";
                    }
                    echo '<tr><td><div class="btn alert-dismissable text-success" id="id5_libro" value="'.$row5['id'].'"><b>' . $row5['id'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="cod5_libro" value="'.$row5['id'].'"><b>' . $row5['codigo'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="clas5_libro" value="'.$row5['id'].'"><b>' . $row5['clasificacion'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="nom5_libro" value="'.$row5['id'].'"><b>' . $row5['nombre'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="aut5_libro" value="'.$row5['id'].'"><b>' . $row5['autor'] . ' </b></div></td><td><div class="btn alert-dismissable text-success" id="tema5_libro" value="'.$row5['id'].'"><b>' . $row5['tema'] . ' </b></div> </td><td><b> ' . $row5['editorial'] . '</b></td><td><b>' . $estado_fisico . '</b></td><td><b>' . $modalidad . '</b></td><td><b>' . $tipo . '</b></td></tr>';
                }
                $db_conexion->consultar("*", "libro", "tema", "LIKE", "'%" . $busqueda . "%' LIMIT 50", True);
                while ($row6 = mysqli_fetch_array($GLOBALS['consultar'])) {
                    if ($row6['estado_fisico'] == 1) {
                        $estado_fisico = "Excelente";
                    } elseif ($row6['estado_fisico'] == 2) {
                        $estado_fisico = "Sobresaliente";
                    } elseif ($row6['estado_fisico'] == 3) {
                        $estado_fisico = "Aceptable";
                    } elseif ($row6['estado_fisico'] == 4) {
                        $estado_fisico = "Insuficiente";
                    } elseif ($row6['estado_fisico'] == 5) {
                        $estado_fisico = "Deficiente";
                    }
                    if ($row6['modalidad'] == 1) {
                        $modalidad = "Institucional";
                    } elseif ($row6['modalidad'] == 2) {
                        $modalidad = "Personal";
                    }
                    if ($row6['tipo'] == 1) {
                        $tipo = "Fisico";
                    } elseif ($row6['tipo'] == 2) {
                        $tipo = "Virtual";
                    }
                    echo '<tr><td><div class="btn alert-dismissable text-success" id="id6_libro" value="'.$row6['id'].'"><b>' . $row6['id'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="cod6_libro" value="'.$row6['id'].'"><b>' . $row6['codigo'] . '</b></div> </td><td><div class="btn alert-dismissable text-success" id="clas6_libro" value="'.$row6['id'].'"><b>' . $row6['clasificacion'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="nom6_libro" value="'.$row6['id'].'"><b>' . $row6['nombre'] . ' </b></div> </td><td><div class="btn alert-dismissable text-success" id="aut6_libro" value="'.$row6['id'].'"><b>' . $row6['autor'] . ' </b></div></td><td><div class="btn alert-dismissable text-success" id="tema6_libro" value="'.$row6['id'].'"><b>' . $row6['tema'] . ' </b></div> </td><td><b> ' . $row6['editorial'] . '</b></td><td><b>' . $estado_fisico . '</b></td><td><b>' . $modalidad . '</b></td><td><b>' . $tipo . '</b></td></tr>';
                }
            }
            ?>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).on("ready", function () {
           $("#correo").click(function(){
            var para = $("#correo").attr("value");
            $("#destino").attr("value",para);
            document.form.submit();
        }); 
        $("#correo1").click(function(){
            var para = $("#correo1").attr("value");
            $("#destino").attr("value",para);
            document.form.submit();
        });
        $("#correo2").click(function(){
            var para = $("#correo2").attr("value");
            $("#destino").attr("value",para);
            document.form.submit();
        });
        
        $("#id_persona").click(function(){
            var perso = $("#id_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#cod_persona").click(function(){
            var perso = $("#cod_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#nom_persona").click(function(){
            var perso = $("#nom_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#apell_persona").click(function(){
            var perso = $("#apell_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#id1_persona").click(function(){
            var perso = $("#id1_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#cod1_persona").click(function(){
            var perso = $("#cod1_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#nom1_persona").click(function(){
            var perso = $("#nom1_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#apell1_persona").click(function(){
            var perso = $("#apell1_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#id2_persona").click(function(){
            var perso = $("#id2_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#cod2_persona").click(function(){
            var perso = $("#cod2_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#nom2_persona").click(function(){
            var perso = $("#nom2_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#apell2_persona").click(function(){
            var perso = $("#apell2_persona").attr("value");
            $("#persona").attr("value", perso);
            document.form1.submit();
        });
        $("#id_libro").click(function(){
            var lib = $("#id_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#cod_libro").click(function(){
            var lib = $("#cod_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom_libro").click(function(){
            var lib = $("#nom_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#clas_libro").click(function(){
            var lib = $("#clas_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom_libro").click(function(){
            var lib = $("#nom_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#aut_libro").click(function(){
            var lib = $("#aut_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#tema_libro").click(function(){
            var lib = $("#tema_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        //
        $("#id4_libro").click(function(){
            var lib = $("#id4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#cod4_libro").click(function(){
            var lib = $("#cod4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom4_libro").click(function(){
            var lib = $("#nom4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#clas4_libro").click(function(){
            var lib = $("#clas4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom4_libro").click(function(){
            var lib = $("#nom4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#aut4_libro").click(function(){
            var lib = $("#aut4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#tema4_libro").click(function(){
            var lib = $("#tema4_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        //
        $("#id5_libro").click(function(){
            var lib = $("#id5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#cod5_libro").click(function(){
            var lib = $("#cod5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom5_libro").click(function(){
            var lib = $("#nom5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#clas5_libro").click(function(){
            var lib = $("#clas5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom5_libro").click(function(){
            var lib = $("#nom5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#aut5_libro").click(function(){
            var lib = $("#aut5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#tema5_libro").click(function(){
            var lib = $("#tema5_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        //
        $("#id6_libro").click(function(){
            var lib = $("#id6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#cod6_libro").click(function(){
            var lib = $("#cod6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom6_libro").click(function(){
            var lib = $("#nom6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#clas6_libro").click(function(){
            var lib = $("#clas6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#nom6_libro").click(function(){
            var lib = $("#nom6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#aut6_libro").click(function(){
            var lib = $("#aut6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
        $("#tema6_libro").click(function(){
            var lib = $("#tema6_libro").attr("value");
            $("#libro").attr("value", lib);
            document.form2.submit();
        });
    });
</script>

<form action="../dir_res_bus/envio_de_correo.php" method="post" name="form">
    <input type="hidden" name="destino" id="destino" value="">
    
</form>
<form action="../dir_resultados/personas.php" method="post" name="form1">
    <input type="hidden" name="persona" id="persona" value="">
</form>
<form action="../dir_resultados/libros.php" method="post" name="form2">
    <input type="hidden" name="libro" id="libro" value="">
</form>