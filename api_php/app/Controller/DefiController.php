<?php
require_once getAbsolutePath('/app/Model/Defi.php');

class DefiController {
    private $db;
    private $defi;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->defi = new Defi($this->db);
    }

    // Retourner tous les défis
    public function getDefis() {
        $stmt = $this->defi->getDefis();
        $defis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($defis);
    }

    // Retourner un défi par ID
    public function getDefi($id) {
        $defi = $this->defi->getDefiById($id);
        if ($defi) {
            echo json_encode($defi);
        } else {
            echo json_encode(['message' => 'Defi not found']);
        }
    }

    // Ajouter un nouveau défi
    public function createDefi($data) {
        if (!empty($data['points']) && !empty($data['defi'])) {
            if ($this->defi->createDefi($data['points'], $data['defi'])) {
                echo json_encode(['message' => 'Defi created successfully']);
            } else {
                echo json_encode(['message' => 'Failed to create Defi']);
            }
        } else {
            echo json_encode(['message' => 'Incomplete data']);
        }
    }

    // Supprimer un défi
    public function deleteDefi($id) {
        if ($this->defi->deleteDefi($id)) {
            echo json_encode(['message' => 'Defi deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete Defi']);
        }
    }
}
?>
