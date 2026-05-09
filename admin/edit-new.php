<?php
require_once '_guard.php';
$post_id = $_GET['post_id'] ?? 0;
if (!is_numeric($post_id)) exit('Некоректний ідентифікатор');
$post = get_post_by_id($post_id);
$categories = get_menu();
if (!$post) exit('Запис не знайдено');
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редагування запису</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container admin-container">
    <div class="row"><div class="col"><h3>Редагування запису</h3></div></div>
    <div class="row">
        <div class="col-12">
            <form action="update-new.php" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="id" value="<?= e($post['id']); ?>">
                <div class="form-group">
                    <label>Вкажіть назву запису</label>
                    <input name="header" type="text" class="form-control" value="<?= e($post['header']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Виконавець або джерело</label>
                    <input name="artist" type="text" class="form-control" value="<?= e($post['artist'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Рік</label>
                    <input name="release_year" type="number" class="form-control" value="<?= e($post['release_year'] ?? date('Y')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Категорія</label>
                    <select name="category_id" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= e($category['id']); ?>" <?= (int)$category['id'] === (int)$post['category_id'] ? 'selected' : '' ?>><?= e($category['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Вкажіть текст запису</label>
                    <textarea name="content" class="form-control" rows="6" required><?= e($post['content']); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Вкажіть нове зображення для запису</label>
                    <input name="image" type="file" class="form-control-file">
                    <small class="form-text text-muted">Поточне зображення: <?= e($post['image']); ?></small>
                </div>
                <div class="form-group">
                    <label>Вкажіть дату публікації</label>
                    <input name="datatime" type="date" class="form-control" value="<?= e($post['datatime']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Обновити запис</button>
                <a href="index.php" class="btn btn-secondary">Назад</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
