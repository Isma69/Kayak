<?php

class Admin {
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=127.0.0.1;dbname=kayak;charset=utf8", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function updateDestination($id, $location, $price, $tour_operator_id) {
        try {
            $sql = "UPDATE destination SET location = :location, price = :price, tour_operator_id = :tour_operator_id WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":location", $location, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":tour_operator_id", $tour_operator_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    }

    public function deleteDestination($id) {
        try {
            $sql = "DELETE FROM destination WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur de suppression : " . $e->getMessage();
        }
    }

    public function getAllDestinations() {
        try {
            $sql = "SELECT * FROM destination";
            $result = $this->conn->query($sql);

            if ($result->rowCount() > 0) {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des destinations : " . $e->getMessage();
            return [];
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>
