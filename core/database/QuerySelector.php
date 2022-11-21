<?php

class QuerySelector
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }    

    public function getAllRows($table){
        $stmt = $this->pdo->query("SELECT * FROM {$table}");
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

    public function updatePassword($table, $data)
    {
        $request = "UPDATE {$table} SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare("UPDATE {$table} SET password = :password WHERE id = :id");
        $stmt->execute($data);
    }
}

