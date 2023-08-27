<div class="container my-5">
    <h1 class="mb-3">Список дел</h1>
    <div class="mb-3">
        <a href="<?php url('app/taskPage') ?>" class="btn btn-primary">Новая задача</a>
    </div>

    <?php if (Session::has('task_created')): ?>
        <div class="alert alert-success">
            <?php Session::flash('task_created'); ?>
        </div>
    <?php endif; ?>

    <?php if (count($data['tasks']['models'])) : ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><a href="<?php echo sortBy('user_name')['url'] ?>">
                        Имя
                        <?php
                        if (sortBy('user_name')['field'] == 'user_name') : ?>
                            <?php echo '(' . sortBy('user_name')['name'] . ')' ?>
                        <?php endif; ?>
                    </a></th>
                <th><a href="<?php echo sortBy('user_email')['url'] ?>">
                        Email
                        <?php
                        if (sortBy('user_email')['field'] == 'user_email') : ?>
                            <?php echo '(' . sortBy('user_email')['name'] . ')' ?>
                        <?php endif; ?>
                    </a></th>
                <th>Задача</th>
                <th><a href="<?php echo sortBy('status')['url'] ?>">Статус</a></th>
                <?php if (Session::has('authUser')) : ?>
                    <th>Действия</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['tasks']['models'] as $task) : ?>
                <tr class="<?php if ($task->status):echo 'table-success';endif; ?>">
                    <td><?php echo $task->userName ?></td>
                    <td><?php echo $task->userEmail ?></td>
                    <td><?php echo $task->task ?></td>
                    <td><?php echo $task->getStatus() ?></td>
                    <?php if (Session::has('authUser')) : ?>
                        <td>
                            <a href="<?php url('app/editTaskPage?task=' . $task->id) ?>">Редактировать</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (count($data['allTasks']) > 3) : ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($data['tasks']['currentPage'] > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $data['tasks']['currentPage'] - 1 ?>"
                               aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $data['tasks']['pages']; $i++): ?>

                        <li class="page-item <?php if ($i == $data['tasks']['currentPage']) echo 'active' ?>">
                            <a class="page-link" href="<?php echo getPage($i) ?>">
                                <?php echo $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($data['tasks']['pages'] > $data['tasks']['currentPage']) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $data['tasks']['currentPage'] + 1 ?>"
                               aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php else: ?>
        <p>Список задач пуст.</p>
    <?php endif; ?>
</div>