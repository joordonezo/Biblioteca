<?php
include '../scripts/librerias.php';
?>
<form action="" method="post">
    
    <div class="col-xs-12">
        <div class="text-left form-group has-success  col-xs-2">
            <label class="control-label" for="codigo">Codigo</label>
            <input class="form-control" type="text" name="codigotext" id="codigo" value="" placeholder="Codigo"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="nombres">Nombres</label>
            <input class="form-control" type="text" name="nombrestext" id="nombres" value="" placeholder="Nombres"/>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidostext" id="apellidos" value="" placeholder="Apellidos"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="tipo_doc">Tipo Documento</label>
            <select class="form-control" id="tipo_doc" name="tipo_doctext">
                <option value="">---Seleccione---</option>
                <option value="1">Cedula</option>
                <option value="2">Targeta Identidad</option>
                <option value="3">Registro Civil</option>
                <option value="4">Cedula Extrangera</option>
                <option value="5">Pasaporte</option>
            </select>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="num_doc">Numero Documento</label>
            <input class="form-control" type="text" name="num_doctext" id="num_doc" value="" placeholder="Numero Documento"/>
        </div>

        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="mail">e-Mail</label>
            <input class="form-control" type="email" name="mailtext" id="mail" value="" placeholder="e-Mail"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="celular">Celular</label>
            <input class="form-control" type="tel" name="celulartext" id="celular" value="" placeholder="Celular"/>
        </div>
        <div class="form-group has-success col-xs-3 ">
            <label class="control-label" for="telefono">Telefono</label>
            <input class="form-control" type="tel" name="telefonotext" id="telefono" value="" placeholder="Telefono"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="perfil">Perfil</label>
            <select class="form-control" id="perfil" name="perfiltext">
                <option value="">---Seleccione---</option>
                <option value="1">Estudiante</option>
                <option value="2">Acudiente</option>
                <option value="3">Docente</option>
                <option value="4">Administrativo</option>
            </select>
        </div>
        <div class="form-group has-success col-xs-3">
            <label class="control-label" for="grupo">Grupo</label>
            <select class="form-control" id="grupo" name="grupotext">
                <option value="">---Seleccione---</option>
                <option value="1">Decimo-1</option>
                <option value="2">Decimo-2</option>
                <option value="3">Once-1</option>
                <option value="4">Once-2</option>
            </select>
        </div>
        
    </div>
</form>