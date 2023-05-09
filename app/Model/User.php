<?php
namespace App\Model;

use System\App;

class User
{
    private $db;

    public function __construct() 
    {
        $this->db = (new App)->db;
    }

    public function create($name, $email, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $stmt;
    }

    public function find($email, $password)
    {
        $stmt = $this->db->prepare('SELECT * from users WHERE email = :email and password = :password');

        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $stmt->fetch();
    }
}