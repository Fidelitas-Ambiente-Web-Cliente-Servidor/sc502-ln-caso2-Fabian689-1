<?php
class Solicitud
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    
    public function existeSolicitud($usuarioId, $tallerId)
    {
        $sql = "SELECT id 
                FROM solicitudes 
                WHERE usuario_id = :usuario_id 
                AND taller_id = :taller_id
                AND estado IN ('pendiente', 'aprobada')";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':taller_id', $tallerId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

   
    public function crear($usuarioId, $tallerId)
    {
        $sql = "INSERT INTO solicitudes (usuario_id, taller_id, estado)
                VALUES (:usuario_id, :taller_id, 'pendiente')";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':taller_id', $tallerId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    
    public function getPendientes()
    {
        $sql = "SELECT 
                    s.id,
                    u.nombre AS usuario,
                    t.nombre AS taller,
                    s.estado
                FROM solicitudes s
                INNER JOIN usuarios u ON s.usuario_id = u.id
                INNER JOIN talleres t ON s.taller_id = t.id
                WHERE s.estado = 'pendiente'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getById($id)
    {
        $sql = "SELECT * FROM solicitudes WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
    public function actualizarEstado($id, $estado)
    {
        $sql = "UPDATE solicitudes
                SET estado = :estado
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}