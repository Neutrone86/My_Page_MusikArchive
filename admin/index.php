<?php
require_once '_guard.php';
$posts = get_post();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Адмін-панель</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="container admin-container">
    <div class="row align-items-center mb-4">
        <div class="col-8">
            <h2>Адміністративна панель</h2>
            <p class="text-muted mb-0">Керування записами сайту «Музичний архів»</p>
        </div>
        <div class="col-4 text-right">
            <a href="../index.php" class="btn btn-outline-secondary">Сайт</a>
            <a href="logout.php" class="btn btn-primary">Вихід</a>
        </div>
    </div>
    <?php if (!$dbAvailable): ?>
        <div class="alert alert-warning">MySQL не підключено. Дані тимчасово зберігаються у файлі data/storage.json.</div>
    <?php endif; ?>
    <div class="row">
        <div class="col">
            <div class="admin-toolbar d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Усього записів: <?= count($posts); ?></span>
                <a href="add-new.php" class="btn btn-success">Додати запис</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered admin-table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Назва запису</th>
                        <th scope="col">Виконавець</th>
                        <th scope="col">Категорія</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($posts as $post): ?>
                        <?php $category = get_category_title($post['category_id']); ?>
                        <tr>
                            <th scope="row"><?= e($post['id']); ?></th>
                            <td><?= e($post['header']); ?></td>
                            <td><?= e($post['artist'] ?? '-'); ?></td>
                            <td><?= e($category['name'] ?? '-'); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit-new.php?post_id=<?= e($post['id']); ?>" class="btn btn-info btn-sm">Редагувати</a>
                                    <a href="delete-new.php?post_id=<?= e($post['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Видалити запис?')">Видалити</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
