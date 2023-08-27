<?php

class AppController extends Controller
{
    /**
     * Main page
     */
    public function index()
    {
        $this->view->generate('index.php', 'layouts/app.php', [
            'tasks' => Task::pagination(),
            'allTasks' => Task::all()
        ]);
    }

    /**
     * 404 Not found page
     */
    public function error404()
    {
        $this->view->generate('error404.php', 'layouts/app.php');
    }

    /**
     * Task Validation
     */
    public function taskValidateErrors($request): int
    {
        $errors = 0;
        $userName = $request['user_name'];
        $userEmail = $request['user_email'];
        $task = $request['task'];

        if ($userName == '') {
            Session::put('error_user_name', 'Введите имя пользователя');
            Session::put('old_user_name', $userName);
            $errors++;
        }
        if (isset($userEmail)) {
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                Session::put('error_user_email', 'Не правильно введен email. Пример: username@domain.ru');
                Session::put('old_user_email', $userEmail);
                $errors++;
            }
            if ($userEmail == '') {
                Session::put('error_user_email', 'Введите email пользователя');
                Session::put('old_task', $task);
                $errors++;
            }
        }
        if ($task == '') {
            Session::put('error_task', 'Введите текст задачи');
            $errors++;
        }

        return $errors;
    }

    /**
     * Task page
     */
    public function taskPage()
    {
        if ($_POST) {
            if (self::taskValidateErrors($_POST) == 0) {
                Task::create($_POST);
                Session::put('task_created', 'Задача для пользователя ' . htmlspecialchars($_POST['user_name']) . ' добавлена!');
                redirect('/');
            }
        }
        $this->view->generate('task.php', 'layouts/app.php');
    }

    /**
     * Edit task page
     */
    public function editTaskPage()
    {
        if ($_POST) {
            if (self::taskValidateErrors($_POST) == 0) {
                Task::update($_POST);
                Session::put('task_created', 'Задача успешно изменена!');
                redirect('/');
            }
        }

        $this->view->generate('editTask.php', 'layouts/app.php', [
            'task' => Task::getById($_GET['task']),
        ]);
    }

    public function login()
    {
        if ($_POST) {
            $errors = 0;

            if (isset($_POST['user_name']) && $_POST['user_name'] == '') {
                Session::put('error_user_name', 'Введите имя пользователя');
                $errors++;
            }

            $user = User::where('name', '=', $_POST['user_name']);

            if ($user == null) {
                Session::put('error_password', 'Такой пользователь не найден');
                $errors++;
            } else {
                if (md5($_POST['password']) != $user->password || $user->name != $_POST['user_name']) {
                    Session::put('error_password', 'Логин или пароль не совпадают');
                    $errors++;
                }
            }
            if (isset($_POST['password']) && $_POST['password'] == '') {
                Session::put('error_password', 'Введите пароль');
                $errors++;
            }

            Session::put('old_user_name', $_POST['user_name']);
            Session::put('old_password', $_POST['password']);

            if ($errors == 0) {
                Session::put('authUser', $user->id);
                redirect('/');
            }
        }
        $this->view->generate('login.php', 'layouts/app.php');
    }

    public function logout()
    {
        if (Session::has('authUser')) {
            unset($_SESSION['authUser']);
        }
        redirect('/');
    }
}