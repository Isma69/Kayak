<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'Administrateur et Connexion</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-top: 20px;
        }
        form {
            margin-top: 20px;
            display: inline-block;
            text-align: left;
        }
        label, input {
            display: block;
            margin: 10px 0;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"] {
            background-color: #28A745;
        }
    </style>
</head>
<body>
    <a href="adminCreation.php">
        <button>Créer un admin</button>
    </a>
    <h1>Connexion d'Administrateur</h1>
    <form action="process/adminLogin.php" method="post">
        <label for="login_username">Nom d'utilisateur :</label>
        <input type="text" id="login_username" name="login_username" required>

        <label for="login_password">Mot de passe :</label>
        <input type="password" id="login_password" name="login_password" required>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>