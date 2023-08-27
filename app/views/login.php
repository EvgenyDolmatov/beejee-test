<div class="container py-5">
    <h1>Вход для админа</h1>
    <form action="" method="post">
        <div class="form-group mb-3">
            <label for="name">Имя пользователя</label>
            <input type="text" name="user_name" class="form-control" value="<?php Session::flash('old_user_name'); ?>">
            <small class="text-danger"><?php Session::flash('error_user_name') ?></small>
        </div>
        <div class="form-group mb-3">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control" value="<?php Session::flash('old_password'); ?>">
            <small class="text-danger"><?php Session::flash('error_password') ?></small>
        </div>
        <button class="btn btn-primary">Войти</button>
    </form>
</div>