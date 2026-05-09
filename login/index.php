<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вхід в адмін-панель</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="login-page">
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="main-form">
                <form class="login" action="check-login.php" method="post">
                    <h3>Вхід в адмін-панель</h3>
                    <p class="text-muted mb-4">Введіть дані адміністратора, щоб керувати музичним архівом.</p>
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger">Невірний логін або пароль.</div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="login">Логін</label>
                        <input type="text" name="login" class="form-control" id="login" autocomplete="username" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary formbtn">Увійти</button>
                    <a href="../index.php" class="btn btn-link">На головну</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
