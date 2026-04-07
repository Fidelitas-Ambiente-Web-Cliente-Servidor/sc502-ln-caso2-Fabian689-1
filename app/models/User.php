<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($username)
    {
        $query = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function create($username, $password)
    {
        $query = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);

        return $stmt->execute();
    }
}