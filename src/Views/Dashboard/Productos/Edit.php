<h1>Editar Producto</h1>
<a href="/">Regresar a mis productos</a>
<form action="/producto/update/<?= $producto["id"]; ?>" method="POST">
     <?php include "src\Views/Dashboard/Productos/Partials/Form.php"; ?>
<form>
