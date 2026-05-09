<?php
$login = 'admin';
$pass = 'Neutron86430';

if ($login === ($_POST['login'] ?? '') && $pass === ($_POST['password'] ?? '')) {
    session_start();
    session_regenerate_id(true);
    $_SESSION['admin'] = true;
    $_SESSION['login'] = $login;
    header('Location: ../admin/index.php');
    exit();
}
header('Location: index.php?error=1');
exit();
