<?php

include_once "header.php";
require_once('config/autoload.php');

$db = new PDO('mysql:host=127.0.0.1;dbname=kayak;charset=utf8', 'root');
$manager = new Manager($db);
?>

<div class="container mt-5">
    <h1>Tours Opérateurs Disponibles :</h1>

    <?php
    if (isset($_GET['destination_id'])) {
        $destinationId = $_GET['destination_id'];
        $tourOperator = $manager->getTourOperatorForDestination($destinationId);

        if ($tourOperator) {
            $details = $manager->getTourOperatorDetails($tourOperator['id']);
            $averageScore = round($details['average_score']);
            ?>
            <h2>
                <?php echo $details['name']; ?>
            </h2>
            <p>Site Web : <a href="<?php echo $details['link']; ?>" target="_blank"><?php echo $details['link']; ?></a></p>
            <p>Note d'avis globale :
                <?php echo $averageScore; ?>
            </p>
            <p>Prix de la destination :
                <?php echo $details['destination_price']; ?> €
            </p>
            <?php
            if (!empty($details['authors'])) {
                $authorsArray = explode(', ', $details['authors']);
                $reviewsArray = explode('<br>', $details['reviews']);
                ?>
                <section class="review">
                <ul>Avis des utilisateurs :</ul>
                <ul>
                    <?php
                    for ($i = 0; $i < count($authorsArray); $i++) {
                        ?>
                        <li>
                            <?php echo "{$authorsArray[$i]} : {$reviewsArray[$i]}"; ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                </section>
                <?php
            } else {
                echo "Aucun avis disponible pour ce tour opérateur.";
            }
        } else {
            echo "Tour Opérateur non trouvé pour cette destination.";
        }
    }
    ?>

    <form method="post" action="process/addReview.php">
        <div class="form-group">
            <label for="author_name">Nom de l'auteur :</label>
            <input type="text" class="form-control" id="author_name" name="author_name" required>
        </div>
        <div class="form-group">
            <label for="review">Votre avis :</label>
            <textarea class="form-control" id="review" name="review" rows="4" required></textarea>
        </div>
        <!-- Ajoutez un champ caché pour tour_operator_id -->
        <input type="hidden" name="tour_operator_id" value="<?php echo $tourOperator['id']; ?>">
        <!-- Utilisez également un champ caché pour destination_id -->
        <input type="hidden" name="destination_id" value="<?php echo $destinationId; ?>">
        <button type="submit" class="btn btn-primary">Soumettre l'avis</button>
    </form>
</div>

<?php
include_once "footer.php";
?>