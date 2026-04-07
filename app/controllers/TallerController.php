<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Taller.php';

class TallerController
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $database = new Database();
        $db = $database->connect();

        $this->model = new Taller($db);
    }

    public function index()
    {
        require __DIR__ . '/../views/taller/listado.php';
    }

    public function getTalleresJson()
    {
        header('Content-Type: application/json');

        try {
            $talleres = $this->model->getAll();
            echo json_encode($talleres);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => 'Error al cargar talleres: ' . $e->getMessage()
            ]);
        }
    }

    public function solicitar()
    {
        header('Content-Type: application/json');

        try {

            
            if (!isset($_SESSION['id'])) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Debe iniciar sesión'
                ]);
                return;
            }

            
            if (!isset($_POST['taller_id']) || empty($_POST['taller_id'])) {
                echo json_encode([
                    'success' => false,
                    'error' => 'No se recibió el taller'
                ]);
                return;
            }

            $tallerId = intval($_POST['taller_id']);
            $usuarioId = intval($_SESSION['id']);

            
            $resultado = $this->model->crearSolicitud($tallerId, $usuarioId);

            if ($resultado) {

                
                $this->model->descontarCupo($tallerId);

                echo json_encode([
                    'success' => true,
                    'message' => 'Solicitud enviada correctamente'
                ]);

            } else {

                echo json_encode([
                    'success' => false,
                    'error' => 'Ya solicitaste este taller o no se pudo guardar'
                ]);
            }

        } catch (Exception $e) {

            echo json_encode([
                'success' => false,
                'error' => 'Error del servidor: ' . $e->getMessage()
            ]);
        }
    }
}