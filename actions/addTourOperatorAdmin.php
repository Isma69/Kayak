<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=127.0.0.1;dbname=kayak_isma69;charset=utf8", "isma69", "9Janvier1996");        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $name = $_POST["name"];
        $link = $_POST["link"];

        $sql = "INSERT INTO tour_operator (name, link) VALUES (:name, :link)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":link", $link);
        $stmt->execute();

        header("Location: ../admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du tour operator : " . $e->getMessage();
    }
}
?>
