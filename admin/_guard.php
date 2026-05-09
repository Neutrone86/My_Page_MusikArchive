<?php
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: ../login/index.php');
    exit();
}
require_once __DIR__ . '/../include/functions.php';
