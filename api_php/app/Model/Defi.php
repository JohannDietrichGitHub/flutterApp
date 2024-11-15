<?php

class Defi {
    private $conn;
    private $table = "cartes_defi"; 

    public $id_cartes_defi;
    public $points;
    public $defi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDefis() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getDefiById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_cartes_defi = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createDefi($points, $defi) {
        $query = "INSERT INTO " . $this->table . " (points, defi) VALUES (:points, :defi)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':points', $points);
        $stmt->bindParam(':defi', $defi);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteDefi($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_cartes_defi = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
