<?php 
class Manager {
    private $db;

    public function setDb(PDO $db){
        $this->db = $db;
    }

    public function __construct(PDO $db){
        $this->setDb($db);
    }

      // CRUD Create - Ajouter une destination
      public function addDestination(Destination $destination) {
        $query = $this->db->prepare("INSERT INTO destination (location, price, tour_operator_id) VALUES (?, ?, ?)");
        $query->execute([$destination->getLocation(), $destination->getPrice(), $destination->getTourOperatorId()]);
    }

    // CRUD Read - Afficher toutes les destinations
    public function getAllDestinations() {
        $query = $this->db->query("SELECT * FROM destination");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // CRUD Delete - Supprimer une destination par ID
    public function deleteDestination($id) {
        $query = $this->db->prepare("DELETE FROM destination WHERE id = ?");
        $query->execute([$id]);
    }


    public function addTourOperator(TourOperator $tourOperator) {
        $query = $this->db->prepare("INSERT INTO tour_operator (name, link) VALUES (?, ?)");
        $query->execute([$tourOperator->getName(), $tourOperator->getLink()]);
    }

    // CRUD Read - Récupérer tous les tour-opérateurs
    public function getAllTourOperators() {
        $query = $this->db->query("SELECT * FROM tour_operator");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTourOperatorForDestination($destinationId) {
        $query = $this->db->prepare("SELECT tour_operator.* FROM destination JOIN tour_operator ON destination.tour_operator_id = tour_operator.id WHERE destination.id = ?");
        $query->execute([$destinationId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // CRUD Update - Mettre à jour un tour-opérateur
    public function updateTourOperator(TourOperator $tourOperator) {
        $query = $this->db->prepare("UPDATE tour_operator SET name = ?, link = ? WHERE id = ?");
        $query->execute([$tourOperator->getName(), $tourOperator->getLink(), $tourOperator->getId()]);
    }

    // CRUD Delete - Supprimer un tour-opérateur par ID
    public function deleteTourOperator($id) {
        $query = $this->db->prepare("DELETE FROM tour_operator WHERE id = ?");
        $query->execute([$id]);
    }


    public function getTourOperatorDetails($tourOperatorId) {
        $query = $this->db->prepare("
            SELECT
                tour_operator.*,
                AVG(score.value) AS average_score,
                destination.price AS destination_price,
                GROUP_CONCAT(DISTINCT author.name SEPARATOR ', ') AS authors,
                GROUP_CONCAT(DISTINCT review.message SEPARATOR '<br>') AS reviews
            FROM tour_operator
            LEFT JOIN score ON tour_operator.id = score.tour_operator_id
            LEFT JOIN destination ON tour_operator.id = destination.tour_operator_id
            LEFT JOIN review ON tour_operator.id = review.tour_operator_id
            LEFT JOIN author ON review.author_id = author.id
            WHERE tour_operator.id = :tour_operator_id
            GROUP BY tour_operator.id, destination_price
        ");
        $query->bindParam(':tour_operator_id', $tourOperatorId);
        $query->execute();
    
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function addReview($tourOperatorId, $authorName, $review) {
        // Insérez d'abord le nom de l'auteur dans la table 'author'
        $query = $this->db->prepare("INSERT INTO author (name) VALUES (?)");
        $query->execute([$authorName]);
    
        // Obtenez l'ID de l'auteur nouvellement créé
        $authorId = $this->db->lastInsertId();
    
        // Insérez ensuite l'avis dans la table 'review' avec l'ID de l'auteur
        $query = $this->db->prepare("INSERT INTO review (message, tour_operator_id, author_id) VALUES (?, ?, ?)");
        $query->execute([$review, $tourOperatorId, $authorId]);
    }
}