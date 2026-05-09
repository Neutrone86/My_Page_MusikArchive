<?php
require_once '_guard.php';
$post_id = $_GET['post_id'] ?? 0;
if (!is_numeric($post_id)) exit('Некоректний ідентифікатор');
delete_new($post_id);
header('Location: index.php');
exit();
