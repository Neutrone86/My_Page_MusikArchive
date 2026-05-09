<?php
require_once '_guard.php';
$imagePath = null;
if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $imagePath = save_uploaded_image('image');
}
update_post($_POST, $imagePath);
header('Location: index.php');
exit();
