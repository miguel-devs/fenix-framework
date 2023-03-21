<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?=$title;?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
        </div>
      </div>     
<h1>Listar Productos</h1>
<a href="/producto/create">Agregar Producto</a>
<div class="table-responsive">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Detalles</th>
      <th scope="col">Precio</th>
      <th scope="col">Activo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Acciones</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos as $dato){?>
      <tr>
      <th scope="row"><?= $dato["id"]; ?></th>
      <td><?= $dato["nombre"]; ?></td>
      <td><?= $dato["detalles"]; ?></td>
      <td><?= $dato["precio"]; ?></td>
      <td><?= $dato["activo"]; ?></td>
      <td><?= $dato["nombreCategoria"]; ?></td>
      <td>
        <a href="/producto/edit/<?=$dato["id"];?>">Editar </a>
        <form action="/producto/delete/<?=$dato["id"];?>" method="POST">
        <button>Eliminar </button>
        </form>
      </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?php  if(isset($links)){ echo $links; } ?>

