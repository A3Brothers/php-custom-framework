<?php

namespace App\Model;

use InvalidArgumentException;
use System\App;

class BaseModel
{
    protected $table;
    protected $primaryKey = 'id';
    protected $db;
    protected $query;
    protected $params = [];
    protected $id;

    public function __construct()
    {
        $this->db = (new App)->db;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select($columns = [])
    {
        if (empty($columns)) {
            $columns = '*';
        } else {
            $columns = implode(', ', $columns);
        }

        $this->query = "SELECT $columns FROM $this->table";
        return $this;
    }

    public function where(...$args)
    {
        if (count($args) === 2) {
            $column = $args[0];
            $operator = '=';
            $value = $args[1];
        } elseif (count($args) === 3) {
            $column = $args[0];
            $operator = $args[1];
            $value = $args[2];
        } else {
            throw new InvalidArgumentException;
        }

        $this->query .= " WHERE $column $operator ?";
        $this->params[] = $value;
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $this->query .= " OR $column $operator ?";
        $this->params[] = $value;
        return $this;
    }

    public function get()
    {
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetchAll();
    }

    public function first()
    {

        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetch();
    }

    public function find($id)
    {
        $this->query = "SELECT * FROM $this->table WHERE $this->primaryKey = ?";
        $this->params = [$id];
        return $this->first();
    }

    public function count()
    {
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->rowCount();
    }

    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = rtrim(str_repeat('?,', count($data)), ',');
        $values = array_values($data);

        $query = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);
        $stmt->execute($values);

        return $this->db->lastInsertId();
    }

    public function update($data, $id)
    {
        $sets = '';
        foreach ($data as $column => $value) {
            $sets .= "$column = ?,";
            $this->params[] = $value;
        }
        $sets = rtrim($sets, ',');

        $query = "UPDATE $this->table SET $sets WHERE $this->primaryKey = ?";
        $this->params[] = $id;

        $stmt = $this->db->prepare($query);
        return $stmt->execute($this->params);
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE $this->primaryKey = ?";
        $this->params[] = $id;

        $stmt = $this->db->prepare($query);
        return $stmt->execute($this->params);
    }
}
