<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php

require_once "config.php";
require_once "DogApi.php";
require_once "DogApp.php";

$api = new DogApi(DOG_BASE_URL,DOG_API_KEY);

$app = new DogApp($api);

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<!doctype html>
<html lang="eng">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8">
    <meta name="description" content="Assignment 1 - Api Integration">
    <title>Assignment 1</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <header>
        <h1>Dog Image Gallery</h1>
    </header>
<?php
$app->showDogImages($currentPage);
?>
</body>
</html>