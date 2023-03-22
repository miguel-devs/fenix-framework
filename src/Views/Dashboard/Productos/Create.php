<h1><?= $title; ?></h1>
<a href="/">Regresar a mis productos</a>

<form action="/producto/store" method="POST" enctype="multipart/form-data">
    <?php include "src/Views/Dashboard/Productos/Partials/Form.php"; ?>
<form>