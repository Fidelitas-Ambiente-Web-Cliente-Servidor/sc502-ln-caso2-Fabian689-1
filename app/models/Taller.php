<?php

class Taller
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    
    public function getAll()
    {
        $sql = "SELECT * FROM talleres";
        $result = $this->conn->query($sql);

        $talleres = [];

        while ($row = $result->fetch_assoc()) {
            $talleres[] = $row;
        }

        return $talleres;
    }

    
    public function getAllDisponibles()
    {
        $sql = "SELECT *
                FROM talleres
                WHERE cupo_disponible > 0
                ORDER BY nombre";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        $talleres = [];

        while ($row = $result->fetch_assoc()) {
            $talleres[] = $row;
        }

        return $talleres;
    }

    
    public function getById($id)
    {
        $sql = "SELECT *
                FROM talleres
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    
    public function crearSolicitud($tallerId, $usuarioId)
    {
        
        $sqlCheck = "SELECT id
                     FROM solicitudes
                     WHERE taller_id = ?
                     AND usuario_id = ?";

        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bind_param("ii", $tallerId, $usuarioId);
        $stmtCheck->execute();

        $result = $stmtCheck->get_result();

        if ($result->num_rows > 0) {
            return false;
        }

        
        $sql = "INSERT INTO solicitudes (taller_id, usuario_id)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $tallerId, $usuarioId);

        return $stmt->execute();
    }

    
    public function descontarCupo($tallerId)
    {
        $sql = "UPDATE talleres
                SET cupo_disponible = cupo_disponible - 1
                WHERE id = ?
                AND cupo_disponible > 0";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $tallerId);

        return $stmt->execute();
    }

    
    public function sumarCupo($tallerId)
    {
        $sql = "UPDATE talleres
                SET cupo_disponible = cupo_disponible + 1
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $tallerId);

        return $stmt->execute();
    }
}