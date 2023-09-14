<?php
include_once "header.php";

$currentURL = $_SERVER['REQUEST_URI'];

if (substr($currentURL, -6) === '/admin') {
    header('Location: admin.php');
    exit();
}
?>
        <h1>Liste des Destinations</h1>

        <?php
        require_once('config/autoload.php');

        $db = new PDO('mysql:host=127.0.0.1;dbname=kayak;charset=utf8', 'root');
        $manager = new Manager($db);

        // Afficher toutes les destinations
        $destinations = $manager->getAllDestinations();
        ?>

<div class="row">
    <?php foreach ($destinations as $destination) { ?>
        <div class="col-md-4 mt-3 d-flex">
            <div class="card">
                <div class="card-body d-flex flex-column"> <!-- Utilisez la classe flex-column pour aligner le contenu à l'intérieur de la carte -->
                    <h5 class="card-title text-center"><?php echo $destination['location']; ?></h5>
                    <img src="<?php echo $destination['picture']; ?>" class="cardImage"></img>
                    <p class="card-text mt-2">Prix : <?php echo $destination['price']; ?> €</p>
                    <a href="tour_operator.php?destination_id=<?php echo $destination['id']; ?>" class="btn btn-primary mt-auto">Voir le Tour Opérateur</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</div>

<?php
include_once "footer.php";
?>