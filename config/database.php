<?php

class Database
{
    private $host = "localhost";
    private $db = "appdb";
    private $user = "root";
    private $pass = "";

    public function connect()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $conn = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->db
            );

            $conn->set_charset("utf8");

            return $conn;
        } catch (Exception $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
        if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

echo "Conectado correctamente";
    }
}