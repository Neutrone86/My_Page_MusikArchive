<?php
require_once 'header.php';
$post_id = $_GET['post_id'] ?? 0;
if (!is_numeric($post_id)) {
    exit('Некоректний ідентифікатор запису');
}
$post = get_post_by_id($post_id);
?>
<main class="container mt-5">
    <?php if (!$post): ?>
        <div class="alert alert-warning">Запис не знайдено.</div>
    <?php else: ?>
        <?php $category = get_category_title($post['category_id']); ?>
        <div class="card post-card">
            <img src="<?= e($post['image']); ?>" class="card-img-top" alt="Зображення запису">
            <div class="card-body">
                <span class="badge badge-secondary mb-2"><?= e($category['name'] ?? 'Без категорії'); ?></span>
                <h1 class="card-title"><?= e($post['header']); ?></h1>
                <p class="meta">Виконавець: <?= e($post['artist'] ?? 'Невідомо'); ?> | Рік: <?= e($post['release_year'] ?? '-'); ?> | Дата: <?= e($post['datatime']); ?></p>
                <p class="card-text"><?= nl2br(e($post['content'])); ?></p>
                <div class="d-flex flex-wrap post-actions">
                    <a href="index.php" class="btn btn-primary">До архіву</a>
                    <a href="category.php?category_id=<?= e($post['category_id']); ?>" class="btn btn-outline-secondary">До категорії</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php require_once 'footer.php'; ?>
