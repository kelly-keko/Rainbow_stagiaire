<!DOCTYPE html>
<html>
<head>
    <title>Créer un stagiaire</title>
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>                  
<body>
    <?php
    // Établir la connexion à la base de données
    $mysqli = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

    // Vérifier si la connexion a réussi
    if ($mysqli->connect_errno) {
        echo "Erreur de connexion à la base de données : " . $mysqli->connect_error;
        exit();
    }

    // Vérifier si le formulaire de création a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $mot_passe = $_POST['password'];
        $ville_stagiaire = $_POST['ville'];
        $id_superviseur = $_POST['id_superviseur'];
        $id_stage = $_POST['id_stage'];

        // Préparer la requête d'insertion
        $stmt = $mysqli->prepare("INSERT INTO stagiaire (nom_stagiaire, email_stagiaire, tel_stagiaire, password_stagiaire, ville_stagiaire, id_superviseur, id_stage) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nom, $email, $tel, $mot_passe, $ville_stagiaire, $id_superviseur, $id_stage);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Stagiaire créé avec succès.";
        } else {
            echo "Erreur lors de la création du stagiaire : " . $stmt->error;
        }

        // Fermer la déclaration préparée
        $stmt->close();
    }

    // Fermer la connexion à la base de données
    $mysqli->close();
    ?>

    <div class="container">
        <h2>Ajouter un stagiaire</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="tel">Numéro de téléphone :</label>
                <input type="tel" class="form-control" id="tel" name="tel" required>
            </div>
            <div class="form-group">
                <label for="mot_passe">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="text">Ville du stagiaire :</label>
                <input type="text" class="form-control" id="ville" name="ville" required>
            </div>
            <div class="form-group">
                <label for="id_superviseur">ID du superviseur :</label>
                <input type="number" class="form-control" id="id_superviseur" name="id_superviseur" required>
            </div>
            <div class="form-group">
                <label for="id_stage">ID du stage :</label>
                <input type="number" class="form-control" id="id_stage" name="id_stage" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="read_stagiaire.php" class="btn btn-secondary ml-2">Retour</a>
        </form>
    </div>
</body>
</html>