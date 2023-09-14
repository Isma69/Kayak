<?php
include('config/autoload.php');


$admin = new Admin();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["edit_id"])) {
        try {
            $conn = new PDO("mysql:host=127.0.0.1;dbname=kayak;charset=utf8", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_POST["edit_id"];
            $location = $_POST["edit_location"];
            $price = $_POST["edit_price"];
            $tour_operator_id = $_POST["edit_tour_operator_id"];

            $sql = "UPDATE destination SET location = :location, price = :price, tour_operator_id = :tour_operator_id WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":location", $location, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":tour_operator_id", $tour_operator_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
        }
    } elseif (isset($_POST["delete_id"])) {
        try {
            $conn = new PDO("mysql:host=127.0.0.1;dbname=kayak;charset=utf8", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_POST["delete_id"];

            $sql = "DELETE FROM destination WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur de suppression : " . $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin-styles.css">
    <title>Back Office</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active btn btn-large" href="index.php">
                            Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-large" href="admin.php">
                            Back Office
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-large" href="tour_operator_admin.php">
                            Tour Operator
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        </main>
    </div>
</div>


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
        <br/>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>


<div class="container">
    <h2>Destinations</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Price</th>
                <th>Tour Operator ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $destinations = $admin->getAllDestinations();

            if (!empty($destinations)) {
                foreach ($destinations as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    // Location
                    echo '<td><input type="text" class="form-control" name="edit_location" value="' . $row["location"] . '"></td>';
                    // Price
                    echo '<td><input type="number" class="form-control" name="edit_price" value="' . $row["price"] . '"></td>';
                    // Tour Operator ID
                    echo '<td><input type="number" class="form-control" name="edit_tour_operator_id" value="' . $row["tour_operator_id"] . '"></td>';
                    // Modifier et Supprimer
                    echo '<td>';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="edit_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn btn-primary">Modifier</button>';
                    echo '</form>';
                    echo '<br />';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="delete_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn btn-danger">Supprimer</button>';
                    echo '</form>';
                    echo '</td>';
                    echo "</tr>";
                }
            } else {
                echo "Aucune destination trouvée dans la base de données.";
            }
            ?>
        </tbody>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>