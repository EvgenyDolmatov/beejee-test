<?php

class DB
{
    /**
     * Database connection
     */
    public static function connect($host = 'localhost', $db = 'beejee_db', $user = 'evgeniy', $password = 'Evgeniy@1989')
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            return new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', $user, $password, $options);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}