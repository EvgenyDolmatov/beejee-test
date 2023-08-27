<div class="container my-5">
    <h1>Новая задача</h1>
    <form action="" method="post">
        <div class="form-group mb-3">
            <label for="name">Имя пользователя</label>
            <input type="text" name="user_name" class="form-control" value="<?php Session::flash('old_user_name'); ?>">
            <small class="text-danger"><?php Session::flash('error_user_name') ?></small>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="text" name="user_email" class="form-control" value="<?php Session::flash('old_user_email'); ?>">
            <small class="text-danger"><?php Session::flash('error_user_email') ?></small>
        </div>
        <div class="form-group mb-3">
            <label for="task">Задача</label>
            <input type="text" name="task" class="form-control" value="<?php Session::flash('old_task'); ?>">
            <small class="text-danger"><?php Session::flash('error_task') ?></small>
        </div>
        <button class="btn btn-primary">Добавить</button>
    </form>
</div>