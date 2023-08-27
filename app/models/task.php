<?php

class Task extends Model
{
    public $userName;
    public $userEmail;
    public $task;
    public $status;

    function __construct($userName, $userEmail, $task, $status, $id = 0)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->task = $task;
        $this->status = $status;
        $this->id = $id;
    }

    /**
     * Get all tasks
     */
    public static function all()
    {
        return self::getByQuery('SELECT * FROM tasks');
    }

    /**
     * Get all tasks for pages
     */
    public static function pagination($items = 3)
    {
        $tasks = self::all();
        $pages = ceil(count($tasks) / $items);
        $sortBy = 'user_name';
        if (isset($_GET['sortBy'])) {
            $sortBy = $_GET['sortBy'];
        }
        if (isset($_GET['sortByDesc'])) {
            $sortBy = $_GET['sortByDesc'] . ' DESC';
        }

        $q = 'SELECT * FROM tasks ORDER BY ' . $sortBy . ' LIMIT ' . $items;
        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $q .= ' OFFSET ' . ($_GET['page'] - 1) * $items;
        }
        $params = [];
        if(count($_GET) > 0) {
            foreach ($_GET as $key => $value) {
                $params[$key] = $value;
                if (isset($value) && $value == 'page') {
                    $params[$key] = $value+1;
                }
            }
        }

        $currentUrl = currentUrl();
        $count = 0;
        foreach ($params as $key => $param) {
            $currentUrl .= $count == 0 ? '?' : "&";
            $currentUrl .= $key.'='.$param;
            $count++;
        }

        return [
            'pages' => $pages,
            'currentPage' => $_GET['page'] ?? 1,
            'currentUrl' => $currentUrl,
            'nextPage' => currentUrl(),
            'models' => self::getByQuery($q),
        ];
    }

    /**
     * Get tasks by custom query
     */
    public static function getByQuery($query)
    {
        $pdo = DB::connect();
        $allItems = $pdo->query($query)->fetchAll();

        $models = array();
        foreach ($allItems as $item) {
            $models[] = new self(
                $item['user_name'],
                $item['user_email'],
                $item['task'],
                $item['status'],
                $item['id']
            );
        }

        return $models;
    }

    /**
     * Get task by ID
     */
    public static function getById($id)
    {
        $pdo = DB::connect();
        $res = $pdo->prepare('SELECT * FROM tasks WHERE id=:id LIMIT 1');
        $res->execute(['id'=>$id]);
        $task = $res->fetch();

        return new self(
            $task['user_name'],
            $task['user_email'],
            $task['task'],
            $task['status'],
            $task['id']
        );
    }

    /**
     * Show status in table
     */
    public function getStatus(): string
    {
        return $this->status ? 'Выполнено' : 'Не выполнено';
    }
}