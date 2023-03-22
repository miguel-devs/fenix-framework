<div class="mb-3 row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombrer producto</label>
    <div class="col-sm-10">
        <input class="form-control" name="nombre" type="text" placeholder="Nombre"
            value="<?php if(isset($producto)){ echo $producto["nombre"]; } ?>">
    </div>
</div>
<div class="mb-3 row">
    <label for="detalles" class="col-sm-2 col-form-label">Detalles producto</label>
    <div class="col-sm-10">
        <input class="form-control" name="detalles" type="text" placeholder="Detalles"
            value="<?php if(isset($producto)){ echo $producto["detalles"]; } ?>">
    </div>
</div>
<div class="mb-3 row">
    <label for="precio" class="col-sm-2 col-form-label">precio</label>
    <div class="col-sm-10">
        <input class="form-control" name="precio" type="text" placeholder="Precio"
            value="<?php if(isset($producto)){ echo $producto["precio"]; } ?>">
    </div>
</div>
<div class="mb-3 row">
    <label for="imagenPrincipal" class="col-sm-2 col-form-label">Imagen principal</label>
    <div class="col-sm-10">
        <input class="form-control" name="imagenPrincipal" type="file" /><br />
    </div>
</div>
<div class="mb-3 row">
    <label for="imagenSecundaria" class="col-sm-2 col-form-label">Imagen secundaria</label>
    <div class="col-sm-10">
        <input class="form-control" name="imagenSecundaria" type="file" /><br />
    </div>
</div>
<div class="mb-3 row">
    <label for="activo" class="col-sm-2 col-form-label">Activo</label>
    <select name="activo" class="form-select form-select-sm mb-3">
        <?php foreach ($opcionesActive as $case) { ?>
        <option value="<?= $case->value; ?>"
            <?php if(isset($producto)){ if($case->value == $producto["activo"]){ echo "selected"; }} ?>>
            <?= $case->label();?></option>
        <?php } ?>
    </select>
</div>
<div class="mb-3 row">
    <label for="categoriaId" class="col-sm-2 col-form-label">Categorias</label>
    <select name="categoriaId" class="form-select form-select-sm mb-3">
        <?php foreach ($categorias as $categoria) { ?>
        <option value="<?= $categoria["id"]; ?>"
            <?php  if(isset($producto)){   if($categoria["id"]==$producto["categoriaId"]){ echo "selected"; }} ?>>
            <?= $categoria["nombre"]; ?></option>
        <?php } ?>
    </select>
</div>
<div>
</div>
<div>
    <button class="float-right btn btn-primary">Enviar</button>
</div>