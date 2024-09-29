<?php
// Inclure les fichiers nécessaires
require_once '../Model/Defi.php';
require_once '../Controller/DefiController.php';

// Créer une instance du contrôleur
$controller = new DefiController();

// Récupérer l'action et les autres paramètres GET de l'URL
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Exécuter l'action en fonction des paramètres GET
switch ($action) {
    case 'getAll':
        // Récupérer tous les défis
        $controller->getDefis();
        break;

    case 'getOne':
        // Récupérer un seul défi par ID
        if ($id) {
            $controller->getDefi($id);
        } else {
            echo json_encode(['message' => 'ID is required']);
        }
        break;

    case 'create':
        // Créer un nouveau défi (via POST)
        $data = json_decode(file_get_contents('php://input'), true);
        $controller->createDefi($data);
        break;

    case 'delete':
        // Supprimer un défi par ID
        if ($id) {
            $controller->deleteDefi($id);
        } else {
            echo json_encode(['message' => 'ID is required']);
        }
        break;

    default:
        // Si aucune action n'est définie ou si l'action est inconnue
        echo json_encode(['message' => 'Invalid action']);
        break;
}
?>
