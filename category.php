<?php
require_once 'header.php';
$category_id = $_GET['category_id'] ?? 0;
if (!is_numeric($category_id)) {
    exit('Некоректний ідентифікатор категорії');
}
$posts = get_post_by_category($category_id);
$category = get_category_title($category_id);
?>
<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h2><?= e($category['name'] ?? 'Категорія'); ?></h2>
            <p class="text-muted"><?= e($category['description'] ?? 'Записи обраної категорії'); ?></p>
            <hr>
            <?php if (!$posts): ?>
                <div class="alert alert-info">У цій категорії поки немає записів.</div>
            <?php endif; ?>
            <?php foreach ($posts as $post): ?>
                <div class="card mb-4 archive-card">
                    <img src="<?= e($post['image']); ?>" class="card-img-top" alt="Зображення запису">
                    <div class="card-body">
                        <a href="post.php?post_id=<?= e($post['id']); ?>"><h3 class="card-title"><?= e($post['header']); ?></h3></a>
                        <p class="meta">Виконавець: <?= e($post['artist'] ?? 'Невідомо'); ?> | Рік: <?= e($post['release_year'] ?? '-'); ?></p>
                        <p class="card-text"><?= e(excerpt($post['content'], 220)); ?></p>
                        <a href="post.php?post_id=<?= e($post['id']); ?>" class="btn btn-primary">Детальніше &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">Дата публікації: <?= e($post['datatime']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>
