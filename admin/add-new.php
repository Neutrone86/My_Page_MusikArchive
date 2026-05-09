<?php
require_once '_guard.php';
$categories = get_menu();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Додавання нового запису</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container admin-container">
    <div class="row">
        <div class="col">
            <h3>Додавання нового запису</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="check-new.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Вкажіть назву запису</label>
                    <input name="header" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Виконавець або джерело</label>
                    <input name="artist" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Рік</label>
                    <input name="release_year" type="number" class="form-control" value="2026" required>
                </div>
                <div class="form-group">
                    <label>Категорія</label>
                    <select name="category_id" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= e($category['id']); ?>"><?= e($category['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Вкажіть текст запису</label>
                    <textarea name="content" class="form-control" rows="6" required></textarea>
                </div>
                <div class="form-group">
                    <label>Вкажіть зображення для запису</label>
                    <input name="image" type="file" class="form-control-file">
                </div>
                <div class="form-group">
                    <label>Вкажіть дату публікації</label>
                    <input name="datatime" type="date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Створити запис</button>
                <a href="index.php" class="btn btn-secondary">Назад</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
