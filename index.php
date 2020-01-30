<html>

    <head>  
        <title>Biblioteca - Ingresar</title>
        <link rel="icon" type="image/png" href="img/librop.png" />
        <link rel="shortcut icon" type="image/x-icon" href="img/libro.ico" />
        <link rel="stylesheet" mdia="screen" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" mdia="screen" href="css/bootstrap.css.map" type="text/css">
        <link rel="stylesheet" mdia="screen" href="css/bootstrapcss" type="text/css">
        <link rel="stylesheet" mdia="screen" href="css/bootstrap-theme.css" type="text/css">
        <link rel="stylesheet" mdia="screen" href="css/bootstrap-theme.css.map" type="text/css">
        <link rel="stylesheet" mdia="screen" href="css/bootstrap-theme.min.css" type="text/css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/npm.js" type="text/javascript"></script>
    </head>

    <?php
        if(session_status() ==1){
        if (isset($_POST['formLogin']) && $_POST['formLogin'] == "enviado") {
            if ($_POST["usuario"] != null && $_POST["clave"] != null) {
               
                require_once 'scripts/db_conexion.php';
                $db_conexion = new db_conexion();
                $db_conexion->consultar("id, usuario, clave", "persona", "usuario", "=", "'".$_POST["usuario"]."' and clave = '".md5($_POST["clave"])."' and estado = ".TRUE."", TRUE);
               
                while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
                    $id = $row[0];
                    $usu = $row[1];
                    $clave = $row[2];
                }
                if(isset($id) && $id !=""){
                session_start();
                $_SESSION['id'] = $id;
                    header("Location: dir_/home.php");
                }
                if($usu == "" || $usu != $_POST["usuario"] || $clave == "" || $clave != md5($_POST["clave"])){
                    
                    ?>
                    <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Incorrectos!</strong> Usuario o 
                        contraseña</div>
                    <?php
                    } else {
                if(isset($id) && $id !=""){
                session_start();
                $_SESSION['id'] = $id;
                    header("Location: dir_/home.php");
                }
                    
                }
            } else {
                ?>
                <div class="alert alert-warning has col-xs-4 col-xs-offset-4"><strong>Campos vacios!</strong> Ingrese Los datos 
                    por favor</div>
                <?php
            }
        }
        ?>
        <div class="well col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <form role="form" action="" method="post" class="formValidate">    

                <div class="form-grup has-warning">
                    <label class="control-label" for="usuario">Usuario: </label>
                    <input type="text" name= "usuario" id= "usuario" class="form-control required" />
                    <br>
                </div>        
                <div class="form-grup has-warning">
                    <label class="control-label" for="clave">Contraseña: </label>
                    <input type="password" class="form-control required" name="clave" id="password"/>
                </div>
                <br>
                <a>¿Olvide mi contraseña?</a>  <a>Politica de privacidad</a>
                <br>
                <input class="btn btn-danger btn-block" type="submit" id="guardarbtn" name="guardarbtn" value="Ingresar"/>
                <input type="hidden" name="formLogin" value="enviado" />
            </form>
            <div class="clearfix"></div>
            <div class=" has-success">
                <label class="control-label">Copyright <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> 2015. By Jorge Luis</label>
            </div>
        </div>
    
    </html>
    <?php
        }else{
            header("Location: dir_/home.php");
        }