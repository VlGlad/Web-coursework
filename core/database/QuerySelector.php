<?php

class QuerySelector
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setTab($row)
    {
        $stmt = $this->pdo->query("INSERT INTO deases (deases_name) VALUES ('{$row}')");
        $table = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $table;
    }

    /* public function getRow($table, $id)
    {
        $stmt = $this->pdo->query("SELECT * FROM {$table} LIMIT 1");
        $table = $stmt->fetch(PDO::FETCH_OBJ);
        return $table;
    } */

    public function getAllRows($table, $options=null){
        $stmt = $this->pdo->query("SELECT * FROM {$table} {$options}");
        $table = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $table;
    }

    public function getRowsWhere($table, $condition, $options=null)
    {
        $request = sprintf(
            "SELECT * FROM %s WHERE %s=%s %s",
            $table,
            implode('', array_keys($condition)),
            ':' . implode('', array_keys($condition)),
            $options
        );

        $stmt = $this->pdo->prepare($request);
        $stmt->execute($condition);
        $table = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $table;
    }

    public function insert($table, $data)
    {
        $request = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(', ', array_keys($data)),
            ':' . implode(', :', array_keys($data))
        );
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($data);
    }

    public function delete($table, $data)
    {
        $request = sprintf(
            "DELETE FROM %s WHERE %s=%s",
            $table,
            implode('', array_keys($data)),
            ':' . implode('', array_keys($data))
        );
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($data);
    }

    public function update($table, $data, $id)
    {
        $request = sprintf(
            "UPDATE %s SET %s WHERE %s",
            $table,
            $this->constructRow($data),
            $this->constructRow($id)
        );
        $stmt = $this->pdo->prepare($request);
        $stmt->execute(array_merge($data, $id));
    }

    public function updatePassword($table, $data)
    {
        $request = "UPDATE {$table} SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare("UPDATE {$table} SET password = :password WHERE id = :id");
        $stmt->execute($data);
    }

    private function constructRow($arr, $end=",")
    {
        $temp_arr = [];
        foreach ($arr as $key => $value) {
            $temp_arr[] = $key . "=:" . $key;
        }
        return implode(',', $temp_arr);
    }
}

