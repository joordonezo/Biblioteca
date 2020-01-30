<nav>
  <ul class="pagination">
    <li class="active"><a href="#"><span aria-hidden="true"><<</span><span class="sr-only">Previous</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    <li class="active"><a href="#">2 <span class="sr-only">(current)</span></a></li>
    <li class="active"><a href="#">3 <span class="sr-only">(current)</span></a></li>
    <li class="active"><a href="#">4 <span class="sr-only">(current)</span></a></li>
    <li class="active"><a href="#">5 <span class="sr-only">(current)</span></a></li>
    <li class="active"><a href="#"><span aria-hidden="true">>></span><span class="sr-only">Previous</span></a></li>
  </ul>
</nav>
<a href="#">Inbox <span class="badge">42</span></a>

<button class="btn btn-primary" type="button">
  Messages <span class="badge">4</span>
</button>
<form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
 <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><b>Bienvenido: </b> <?php echo $nombres."  "; ?><img src="../img/BRM.ico" width="20" height="20"> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Actualizar Datos</a></li>
                                    <li><a href="#">Cambio De Contraseña</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Cambiar Imagen</a></li>
                                </ul>
                            </li>
                            <li><a href="../scripts/salir.php">Cerrar Sesion</a></li>
                            
                        </ul>

