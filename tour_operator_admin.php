<?php
require_once("classes/Admin.php");
$admin = new Admin();

if (isset($_POST["add_premium_id"])) {
    $tour_operator_id = $_POST["add_premium_id"];
    $admin->addPremiumStatus($tour_operator_id);
}

if (isset($_POST["remove_premium_id"])) {
    $tour_operator_id = $_POST["remove_premium_id"];
    $admin->removePremiumStatus($tour_operator_id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin-styles.css">
    <title>TOAdmin</title>
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
    <h2>Ajouter un nouveau Tour Opérateur</h2>
    <form action="actions/addTourOperatorAdmin.php" method="post">
        <div class="form-group">
            <label for="name">Nom du Tour Opérateur :</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="link">Lien du Tour Opérateur</label>
            <input type="url" class="form-control" id="link" name="link" required>
        </div>
        <br/>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<div class="container">
    <h2>Tour operator</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>

        <?php
$tourOperators = $admin->getAllTourOperators();

if (!empty($tourOperators)) {
    foreach ($tourOperators as $row) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["link"] . "</td>";
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
        
        // Boutons "Passer Premium" et "Enlever Premium"
        echo '<td>';
        if ($row["is_premium"]) {
            // Si le tour opérateur est déjà premium, affiche "Enlever Premium"
            echo '<form method="post">';
            echo '<input type="hidden" name="remove_premium_id" value="' . $row["id"] . '">';
            echo '<button type="submit" class="btn btn-warning">Enlever Premium</button>';
            echo '</form>';
        } else {
            // Si le tour opérateur n'est pas premium, affiche "Passer Premium"
            echo '<form method="post">';
            echo '<input type="hidden" name="add_premium_id" value="' . $row["id"] . '">';
            echo '<button type="submit" class="btn btn-success">Passer Premium</button>';
            echo '</form>';
        }
        echo '</td>';
        
        echo "</tr>";
    }
} else {
    echo "Aucun opérateur touristique trouvé dans la base de données.";
}
?>

        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>