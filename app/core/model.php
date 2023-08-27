<?php

class Model
{
    /**
     * Insert new entry
     */
    public static function create(array $fields)
    {
        $keys = [];
        foreach ($fields as $key => $value) {
            $keys[] = $key;
            $fields[$key] = trim(htmlspecialchars($value));
        }

        $queryValues = '';
        foreach ($keys as $key => $val) {
            $queryValues .= ':' . $val;
            $queryValues .= $key < count($keys) - 1 ? ',' : '';
        }

        $query = 'INSERT INTO tasks(' . implode(',', $keys) . ') VALUES (' . $queryValues . ')';
        $pdo = DB::connect();
        $result = $pdo->prepare($query);
        $result->execute($fields);
    }

    /**
     * Update entry
     */
    public static function update(array $fields)
    {
        try {
            $keys = [];
            $fields['status'] = !isset($fields['status']) ? 0 : 1;
            foreach ($fields as $key => $value) {
                $keys[] = $key;
                $fields[$key] = trim(htmlspecialchars($value));
            }
            $fields['id'] = trim(htmlspecialchars($_GET['task']));

            $queryValues = '';
            foreach ($keys as $key => $val) {
                $queryValues .= $val . '=:' . $val;
                $queryValues .= $key < count($keys) - 1 ? ',' : '';
            }

            $query = 'UPDATE tasks SET ' . $queryValues . ' WHERE id = :id';
            $pdo = DB::connect();
            $result = $pdo->prepare($query);
            $result->execute($fields);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}