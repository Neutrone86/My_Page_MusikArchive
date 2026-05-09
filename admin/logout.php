<?php
session_start();
unset($_SESSION['admin'], $_SESSION['login']);
session_destroy();
header('Location: ../login/index.php');
exit();
