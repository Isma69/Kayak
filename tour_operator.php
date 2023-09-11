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
        <h1>Tour Opérateur Disponible :</h1>

        <?php
        require_once('config/autoload.php');

        $db = new PDO('mysql:host=127.0.0.1;dbname=kayak;charset=utf8', 'root');
        $manager = new Manager($db);

        if (isset($_GET['destination_id'])) {
            $destinationId = $_GET['destination_id'];
            $tourOperator = $manager->getTourOperatorForDestination($destinationId);
        
            if ($tourOperator) {
                $details = $manager->getTourOperatorDetails($tourOperator['id']);
        
                // Affichez les informations du tour opérateur
                echo "<h1>Tour Opérateur : {$details['name']}</h1>";
                echo "<p>Site Web : <a href='{$details['link']}' target='_blank'>{$details['link']}</a></p>";
                echo "<p>Note d'avis globale : {$details['average_score']}</p>";
                echo "<p>Prix de la destination : {$details['destination_price']} €</p>";
                
                if (!empty($details['authors'])) {
                    echo "<p>Avis des utilisateurs :<br>{$details['reviews']}</p>";
                } else {
                    echo "Aucun avis disponible pour ce tour opérateur.";
                }
                // Affichez d'autres informations du tour opérateur si nécessaire
            } else {
                echo "Tour Opérateur non trouvé pour cette destination.";
            }
        } else {
            echo "ID de destination non spécifié dans l'URL.";
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>

</body>

</html>