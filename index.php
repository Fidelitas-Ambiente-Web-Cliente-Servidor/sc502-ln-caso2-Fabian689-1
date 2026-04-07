<?php
session_start();

require_once './app/controllers/UserController.php';
require_once './app/controllers/TallerController.php';
require_once './app/controllers/AdminController.php';

require_once './app/models/Taller.php';
require_once './app/models/Solicitud.php';
require_once './app/models/User.php';

$page = $_GET['page'] ?? 'login';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    
    if ($page === 'api_talleres') {
        $taller = new TallerController();
        $taller->getTalleresJson();
        exit;
    }

    
    if ($page === 'api_solicitudes') {
        $admin = new AdminController();
        $admin->getSolicitudesJson();
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $option = $_POST['option'] ?? '';
    $pagePost = $_GET['page'] ?? '';

    
    if ($option === 'login') {
        $auth = new UserController();
        $auth->login();
        exit;
    }

    
    if ($option === 'register') {
        $auth = new UserController();
        $auth->registro();
        exit;
    }

    
    if ($pagePost === 'solicitar_taller') {
        $taller = new TallerController();
        $taller->solicitar();
        exit;
    }

    
    if ($option === 'aprobar') {
        $admin = new AdminController();
        $admin->aprobar();
        exit;
    }

    
    if ($option === 'rechazar') {
        $admin = new AdminController();
        $admin->rechazar();
        exit;
    }

    
    if ($option === 'logout') {
        $auth = new UserController();
        $auth->logout();
        exit;
    }
}


switch ($page) {

    case 'talleres':
        $taller = new TallerController();
        $taller->index();
        break;

    case 'admin':
        $admin = new AdminController();
        $admin->solicitudes();
        break;

    case 'logout':
        $auth = new UserController();
        $auth->logout();
        break;

    case 'registro':
        $auth = new UserController();
        $auth->showRegistro();
        break;

    case 'login':
    default:
        $auth = new UserController();
        $auth->showLogin();
        break;
}