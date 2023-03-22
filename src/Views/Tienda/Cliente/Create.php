<form action="/register/store" method="POST">
<div class="mb-3 row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nombre"  name="nombre" value="<?= $validator->getOldValue("nombre"); ?>">
      <span class="text-danger"><?= $validator->getMensaje("nombre"); ?></span>
    </div>
</div>
<div class="mb-3 row">
    <label for="apellido" class="col-sm-2 col-form-label">Apellidos</label>
    <div class="col-sm-10">
      <input type="apellido" class="form-control" id="apellido" name="apellido" value="<?= $validator->getOldValue("apellido"); ?>">
      <span class="text-danger"><?= $validator->getMensaje("apellido"); ?></span>

    </div>
</div>
<div class="mb-3 row">
    <label for="nombre_usuario" class="col-sm-2 col-form-label">Usuario</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nombre_usuario" name="usuario" value="<?= $validator->getOldValue("usuario"); ?>">
      <span class="text-danger"><?= $validator->getMensaje("usuario"); ?></span>

    </div>
</div>
<div class="mb-3 row">
    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="correo" name="correo" value="<?= $validator->getOldValue("correo"); ?>">
      <span class="text-danger"><?= $validator->getMensaje("correo"); ?></span>

    </div>
</div>

<div class="mb-3 row">
    <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="password" name="password" >
      <span class="text-danger"><?= $validator->getMensaje("password"); ?></span>

    </div>
</div>
<button class="btn btn-primary">Registrar</button>
</form>