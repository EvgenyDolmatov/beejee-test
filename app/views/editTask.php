<div class="container my-5">
    <h1><?php echo $data['task']->task ?></h1>
    <form action="" method="post">
        <div class="form-group mb-3">
            <label for="name">Имя пользователя</label>
            <input type="text" name="user_name" class="form-control" value="<?php echo $data['task']->userName ?>">
            <small class="text-danger"><?php Session::flash('error_user_name') ?></small>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="text" name="user_email" class="form-control" value="<?php echo $data['task']->userEmail ?>">
            <small class="text-danger"><?php Session::flash('error_user_email') ?></small>
        </div>
        <div class="form-group mb-3">
            <label for="task">Задача</label>
            <input type="text" name="task" class="form-control" value="<?php echo $data['task']->task ?>">
            <small class="text-danger"><?php Session::flash('error_task') ?></small>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="status"
                   name="status" <?php if ($data['task']->status == 1):echo 'checked';endif; ?>>
            <label class="form-check-label" for="flexCheckChecked">
                Выполнено
            </label>
        </div>
        <button class="btn btn-primary">Изменить</button>
    </form>
</div>