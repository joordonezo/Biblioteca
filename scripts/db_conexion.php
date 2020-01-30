<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db_conexion
 *
 * @author GEORGE
 */
class db_conexion {

    //put your code here
    public function conectar() {

        try {
            
            $GLOBALS['link'] = mysqli_connect("sql204.epizy.com", "epiz_24874039", "etk71nOkh0rf", "epiz_24874039_btdb");
            //$GLOBALS['link'] = mysqli_connect("sql312.tonohost.com", "ottos_25030827", "3135441620Jorge", "ottos_25030827_btdb");
            //$GLOBALS['link'] = mysqli_connect("localhost", "btdb", "root", "");
if ($GLOBALS['link']->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $GLOBALS['link']->connect_errno . ") " . $GLOBALS['link']->connect_error;
}

        } catch (Exception $e) {
            echo '$e';
        }
    }

     public function insertar($tabla, $campos, $valores) {

        
        try {
            $this->conectar();
            $insertar = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";


            if (mysqli_query($GLOBALS['link'], $insertar)) {
                echo 'ok';
            } else {
                ?>
                <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Error!</strong> No se ha podido insertar los datos</div>
                <?php
            }
            $this->desconectar();
        } catch (Exception $exc) {
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Opss!</strong> Ha ocurrido un error con los datos</div>
            <?php
        }
    }

    public function consultar($campos, $tabla, $condicion, $comparacion = "=", $valoresCondicion, $compuesta = FALSE) {
        $consultar1 = " WHERE " . $condicion . " " . $comparacion . " " . $valoresCondicion;
        try {
            if($compuesta==FALSE || $compuesta==TRUE){
            $this->conectar();
            $consultar = "SELECT " . $campos . " FROM " . $tabla;
            if ($compuesta == TRUE) {
                $consultar = $consultar . $consultar1;
            }
            $GLOBALS['consultar'] = mysqli_query($GLOBALS['link'], $consultar);
            $this->desconectar();
            
            
            }else{
                ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Error!</strong> No se ha podido realizar la consulta</div>
            <?php 
            }
            
        } catch (Exception $exc) {
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Opss!</strong> Ha ocurrido un error interno en la consulta</div>
            <?php
        }
    }
    public function eliminar($campos, $tabla, $condicion, $comparacion = "=", $valoresCondicion, $compuesta = FALSE) {
        $eliminar1 = " WHERE " . $condicion . " " . $comparacion . " " . $valoresCondicion;
        try {
            $this->conectar();
            $eliminar = "DELETE " . $campos . " FROM " . $tabla;
            if ($compuesta == TRUE) {
                $eliminar = $eliminar . $eliminar1;
            }
             $GLOBALS['eliminar'] = mysqli_query($GLOBALS['link'], $eliminar);
            $this->desconectar();
          
        } catch (Exception $exc) {
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Opss!</strong> Ha ocurrido un error interno en la modificacion</div>
            <?php
        }
        }
        public function actualizar($tabla, $campos, $nuevoCampo,  $condicion, $comparacion = "=", $valoresCondicion, $compuesta = FALSE) {
            $actualizar1 = " WHERE " . $condicion . " " . $comparacion . " " . $valoresCondicion;
        try {
            $this->conectar();
            $actualizar = "UPDATE " . $tabla . " SET " . $campos." = ".$nuevoCampo;
            if ($compuesta == TRUE) {
                $actualizar = $actualizar . $actualizar1;
            }
             $GLOBALS['actualizar'] = mysqli_query($GLOBALS['link'], $actualizar);
            $this->desconectar();
            
        } catch (Exception $exc) {
            ?>
            <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Opss!</strong> Ha ocurrido un error interno en la modificacion</div>
            <?php
        }
        }
    public function desconectar() {
        mysqli_close($GLOBALS['link']);
    }

}
