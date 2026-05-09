<?php
session_start();
unset($_SESSION['login'], $_SESSION['password']);
session_destroy();
header('Location: ../login/index.php');
exit();
