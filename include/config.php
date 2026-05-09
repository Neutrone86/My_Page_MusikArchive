<?php
// Конфігурація підключення до бази даних MySQL для проєкту "Музичний архів".
// За потреби змініть назву БД, логін або пароль відповідно до налаштувань XAMPP/phpMyAdmin.
$dbHost = 'localhost';
$dbName = 'music_archive';
$dbUser = 'root';
$dbPass = '';
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
