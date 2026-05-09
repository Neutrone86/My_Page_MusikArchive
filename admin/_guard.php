<?php
session_start();
$login = 'admin';
$pass = '123';
if (($_SESSION['login'] ?? '') !== $login || ($_SESSION['password'] ?? '') !== $pass) {
    header('Location: ../login/index.php');
    exit();
}
require_once __DIR__ . '/../include/functions.php';
