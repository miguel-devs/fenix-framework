<input name = "nombre"  type="text" placeholder="Nombre" value="<?php if(isset($producto)){ echo $producto["nombre"]; } ?>">
    <input name = "detalles"  type="text" placeholder="Detalles" value="<?php if(isset($producto)){ echo $producto["detalles"]; } ?>">
    <input name = "precio"  type="text" placeholder="Precio" value="<?php if(isset($producto)){ echo $producto["precio"]; } ?>">
    <select name = "activo">

<?php foreach ($opcionesActive as $case) { ?>
<option value="<?= $case->value; ?>" <?php if(isset($producto)){   if($case->value == $producto["activo"]){ echo "selected"; }} ?>><?= $case->label();?></option>
<?php } ?>

</select>
    <select name = "categoriaId">
      <option>Selecciona una categoria</option>
      <?php foreach ($categorias as $categoria) { ?>
       <option value ="<?= $categoria["id"]; ?>" <?php  if(isset($producto)){   if($categoria["id"]==$producto["categoriaId"]){ echo "selected"; }} ?>><?= $categoria["nombre"]; ?></option>
      <?php } ?> 
   </select>
   <button>Enviar</button>