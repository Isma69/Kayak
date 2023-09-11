<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
    <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto" href="#">KayaK</a>
            </div>
        </nav>
    </header>
    
    <div class="container mt-5">
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
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $destination['location']; ?></h5>
                    <p class="card-text">Prix : <?php echo $destination['price']; ?> €</p>
                    <a href="tour_operator.php?destination_id=<?php echo $destination['id']; ?>" class="btn btn-primary">Voir le Tour Opérateur</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>
</html>