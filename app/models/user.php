<?php

class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;

    function __construct($userName, $userEmail, $password, $id = 0)
    {
        $this->name = $userName;
        $this->email = $userEmail;
        $this->password = $password;
        $this->id = $id;
    }

    /**
     * Get all users
     */
    public static function all()
    {
        return self::getByQuery('SELECT * FROM users');
    }

    /**
     * Get users by filter
     */
    public static function where($key, $type, $value)
    {
        try {
            $pdo = DB::connect();
            $res = $pdo->prepare('SELECT * FROM users WHERE ' . $key . $type . ':' . $key . ' LIMIT 1');
            $res->execute([$key => $value]);
            $user = $res->fetch();

            if ($user) {
                return new User(
                    $user['name'],
                    $user['email'],
                    $user['password'],
                    $user['id']
                );
            }
        } catch (PDOException $e) {
            return null;
        }
    }
}