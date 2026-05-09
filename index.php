<?php require_once 'header.php'; ?>
<header class="site-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="badge badge-warning mb-3">Індивідуальний проєкт</p>
                <h1>Музичний архів</h1>
                <p class="lead">Каталог альбомів, виконавців, жанрів і музичних подій з можливістю перегляду за категоріями та керуванням через адмін-панель.</p>
                <a href="#records" class="btn btn-light btn-lg">Переглянути записи</a>
            </div>
        </div>
    </div>
</header>
<main class="container mt-5" id="records">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Останні записи архіву</h2>
            <p class="text-muted">Записи отримуються з таблиці бази даних або з резервного локального сховища.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?php $news = get_news(); ?>
            <?php foreach ($news as $new): ?>
                <?php $category = get_category_title($new['category_id']); ?>
                <div class="card mb-4 archive-card">
                    <img src="<?= e($new['image']); ?>" class="card-img-top" alt="Зображення запису">
                    <div class="card-body">
                        <span class="badge badge-secondary mb-2"><?= e($category['name'] ?? 'Без категорії'); ?></span>
                        <h3 class="card-title"><a href="post.php?post_id=<?= e($new['id']); ?>"><?= e($new['header']); ?></a></h3>
                        <p class="meta">Виконавець: <?= e($new['artist'] ?? 'Невідомо'); ?> | Рік: <?= e($new['release_year'] ?? '-'); ?></p>
                        <p class="card-text"><?= e(excerpt($new['content'], 230)); ?></p>
                        <a href="post.php?post_id=<?= e($new['id']); ?>" class="btn btn-primary">Детальніше &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">Дата публікації: <?= e($new['datatime']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <aside class="col-md-4">
            <div class="sidebar-block">
                <h4>Категорії</h4>
                <ul class="list-group">
                    <?php foreach ($menus as $menu): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="category.php?category_id=<?= e($menu['id']); ?>"><?= e($menu['name']); ?></a>
                            <span class="badge badge-dark badge-pill"><?= count(get_post_by_category($menu['id'])); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div>
</main>
<?php require_once 'footer.php'; ?>
