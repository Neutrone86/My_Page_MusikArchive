<?php
require_once 'header.php';
$q = $_GET['q'] ?? '';
$results = search_posts($q);
?>
<main class="container mt-5">
    <h2>Пошук по музичному архіву</h2>
    <p class="text-muted">Результати для запиту: <strong><?= e($q); ?></strong></p>
    <?php if (trim($q) !== ''): ?>
        <p class="meta">Знайдено <?= count($results); ?> запис(ів)</p>
    <?php endif; ?>
    <hr>
    <?php if (trim($q) === ''): ?>
        <div class="alert alert-info">Введіть пошуковий запит у полі навігації.</div>
    <?php elseif (!$results): ?>
        <div class="alert alert-warning">За цим запитом записи не знайдено.</div>
    <?php endif; ?>
    <?php foreach ($results as $post): ?>
        <div class="card mb-3 archive-card compact-card">
            <div class="card-body">
                <h3><a href="post.php?post_id=<?= e($post['id']); ?>"><?= e($post['header']); ?></a></h3>
                <p class="meta">Виконавець: <?= e($post['artist'] ?? 'Невідомо'); ?> | Рік: <?= e($post['release_year'] ?? '-'); ?></p>
                <p><?= e(excerpt($post['content'], 240)); ?></p>
                <a href="post.php?post_id=<?= e($post['id']); ?>" class="btn btn-primary">Відкрити</a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (trim($q) !== '' && $results): ?>
        <a href="index.php" class="btn btn-outline-secondary">Повернутися до архіву</a>
    <?php endif; ?>
</main>
<?php require_once 'footer.php'; ?>
