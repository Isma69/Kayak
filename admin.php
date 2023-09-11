<?php
require_once __DIR__ . '/config/autoload.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Back Office</title>
</head>
<body>

<div class="container">
<h2>Ajouter une Destination</h2>
    <form action="actions/addDestinationAdmin.php" method="post">
        <div class="form-group">
            <label for="location">Location :</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="tour_operator_id">ID de l'opérateur touristique :</label>
            <input type="number" class="form-control" id="tour_operator_id" name="tour_operator_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>


    <h2>Destinations</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Price</th>
                <th>Tour Operator ID</th>
            </tr>
        </thead>
        <tbody>
            <?php

            try {
                $conn = new PDO("mysql:host=127.0.0.1;dbname=kayak;charset=utf8", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM destination";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>" . $row["tour_operator_id"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Aucune destination trouvée dans la base de données.";
                }
            } catch (PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }

            $conn = null;
            ?>
        </tbody>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Back Office</title>
</head>
<body>
    
</body>
</html>