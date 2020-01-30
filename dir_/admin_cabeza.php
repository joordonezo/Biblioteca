
<div class="col-xs-3 has-success">
    <h1 id="main-logo"><a class="navbar-right has nav-tabs navbar-brand text-danger" href="home.php">Biblioteca <img src="../img/libro.ico" height="20" width="20"><span class="navbar-right has nav-tabs navbar-brand ">Administrador </span></a></h1>
</div>
<div class="col-xs-9">
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
                <a class="navbar-brand" id="nav" href="#" target="contenedor"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav nav-tabs">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle text-danger" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar <span class="caret glyphicons glyphicons-user-add"></span></a>
                        <ul class="dropdown-menu " role="menu">
                            <li><a href="../dir_persona/Persona.php" target="contenedor"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Personas</a></li>
                            <li><a href="../dir_libro/libro.php" target="contenedor"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Libros</a></li>
                            <li><a href="../dir_grupo/grupo.php" target="contenedor"><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> Grupos</a></li>
                            <li class="divider"></li>
                            <li><a href="../dir_dias_festivo/dias_festivo.php" target="contenedor"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Dias Festivo</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle text-danger" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Informes <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../dir_informes/sel_multas.php" target="contenedor"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Multas <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> </a></li>
                            <li class="dropdown-menu-right"><a href="../dir_informes/sel_libro.php" target="contenedor" class="dropup-toggle text-danger" data-toggle="dropdup" role="button" aria-expanded="false"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Libros</a>

                            </li>
                            <li><a href="../dir_informes/sel_prestamos.php" target="contenedor"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Prestamos <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></a></li>
                            <li class="divider"></li>
                            <li><a href="#"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Todo <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></a></li>
                        </ul>
                    </li>
                    <span class="badge btn-warning"><a class="text-danger" href="../dir_res_bus/envio_de_correo.php" target="contenedor"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Enviar Correo</a></span>
                    <ul class="nav navbar-nav navbar-right ">
                        <li class="dropdown right">
                            <a href="#" class="dropdown-toggle text-danger" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notificaciones <span class="badge">3</span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" target="contenedor">Noti 1 <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                                <li><a href="#" target="contenedor">Noti 2 <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>     
                                <li><a href="#" target="contenedor">Noti 3 <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                            </ul>
                        </li>
                    </ul>

                </ul> 


                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><b>Bienvenido: </b> <?php echo $nombres . "  "; ?><img src="../img/hombre.ico" width="20" height="20"> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../dir_actualizar/actualizar_datos.php" target="contenedor">Actualizar Datos <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                            <li><a href="../dir_actualizar/confirme_clave.php" target="contenedor">Cambio De Contraseña <span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a></li>
                            <li class="divider"></li>
                            <li><a href="../dir_actualizar/cambio_img.php" target="contenedor">Cambiar Imagen <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a></li>
                        </ul>
                    </li>
                    <li><a href="../scripts/salir.php">Cerrar Sesion <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> </a></li>

                </ul>
                <form class="navbar-form navbar-left"  action="../dir_resultados/resultados.php" method="get" target="contenedor">

                    <div class="col-xs-12 ">
                        <label class="sr-only" for="busqueda">Codigos, Personas, Libros, Autores</label>
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
                        <input class="form-control" type="text" placeholder="Codigos, Personas, Libros, Autores"  id="busqueda" name="busqueda">
                        <input type="submit" id="" name="buscar" value="Buscar" class="btn btn-danger"  alt="Busque por: Codigos, Nombres, Apellidos, Libros, Autores, Tema"/>
                    </div>




                </form>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>
</div>
<script type="text/javascript">
    $('#nav').click(function (e) {
        e.preventDefault()
        $(this).tab('show');

    });
    });
</script>
