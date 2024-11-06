<?php
require_once getAbsolutePath('/app/Model/Defi.php');
require_once getAbsolutePath('/app/Controller/DefiController.php');

$controller = new DefiController();

$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'getAll':
        $controller->getDefis();
        break;

    case 'getOne':
        if ($id) {
            $controller->getDefi($id);
        } else {
            echo json_encode(['message' => 'ID is required']);
        }
        break;

    case 'create':
        $data = json_decode(file_get_contents('php://input'), true);
        $controller->createDefi($data);
        break;

    case 'delete':
        if ($id) {
            $controller->deleteDefi($id);
        } else {
            echo json_encode(['message' => 'ID is required']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
        break;
}
?>
