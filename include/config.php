<?php
// Конфігурація підключення до бази даних MySQL для проєкту "Музичний архів".
// Для локального запуску або іншого хостингу змініть ці значення під свою базу.
$dbHost = 'sql111.byetcluster.com';
$dbName = 'if0_41874177_music_archive';
$dbUser = 'if0_41874177';
$dbPass = 'GCL4Nyh59eQ';
$charset = 'utf8mb4';

$pdo = null;
$dbAvailable = false;

try {
    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$charset}";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    $dbAvailable = true;
} catch (Throwable $e) {
    // Якщо MySQL ще не налаштовано, сайт працює з локальним JSON-сховищем.
    // Це дозволяє переглядати сторінки та робити скріншоти навіть без імпортованої БД.
    $pdo = null;
    $dbAvailable = false;
}
