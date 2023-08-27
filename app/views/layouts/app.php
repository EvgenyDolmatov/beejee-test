<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do List</title>
    <link rel="stylesheet" href="<?php url('assets/css/bootstrap.css'); ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                </li>

                <li class="nav-item">
                    <?php if (!Session::has('authUser')) : ?>
                        <a class="nav-link" href="<?php url('app/login') ?>">Войти как админ</a>
                    <?php else: ?>
                        <form action="<?php url('app/logout'); ?>">
                            <button class="btn btn-danger">Выйти</button>
                        </form>
                    <?php endif; ?>
                </li>

            </ul>
        </div>
    </div>
</nav>
<?php require '../app/views/' . $contentView ?>

<script src="<?php url('assets/js/bootstrap.bundle.js'); ?>"></script>
</body>
</html>