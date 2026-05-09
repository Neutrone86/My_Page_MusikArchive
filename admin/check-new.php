<?php
require_once '_guard.php';
$imagePath = save_uploaded_image('image');
add_new_post($_POST, $imagePath);
header('Location: index.php');
exit();
