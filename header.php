<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/include/functions.php';
$menus = get_menu();
$currentPage = basename($_SERVER['PHP_SELF']);
$currentCategoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Музичний архів</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Музичний архів</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $currentPage === 'index.php' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php" <?= $currentPage === 'index.php' ? 'aria-current="page"' : '' ?>>Головна</a>
                </li>
                <?php foreach ($menus as $menu): ?>
                    <li class="nav-item <?= $currentCategoryId === (int)$menu['id'] ? 'active' : '' ?>">
                        <a class="nav-link" href="category.php?category_id=<?= e($menu['id']); ?>" <?= $currentCategoryId === (int)$menu['id'] ? 'aria-current="page"' : '' ?>><?= e($menu['name']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                <input class="form-control mr-sm-2" type="search" name="q" placeholder="Пошук по архіву" value="<?= isset($_GET['q']) ? e($_GET['q']) : '' ?>">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Знайти</button>
            </form>
            <a class="btn btn-warning ml-lg-3" href="login/index.php">Адмін</a>
        </div>
    </div>
</nav>
