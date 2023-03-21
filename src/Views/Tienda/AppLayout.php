<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/dashboard.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
<title><?=$title;?></title>
</head>
<body>
<div class="container-fluid p-4">   

<?php

require_once self::$routePath.$view.".php";

?>

</div>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.js"></script>
<script src="/assets\js\dashboard.js"></script>
</body>
</html>