<!DOCTYPE html>
<html>
<head>
    <title>Suppression d'un superviseur</title>
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Suppression d'un superviseur</h2>

        <?php
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier si l'ID du superviseur est vide
            if (empty($_POST["id_superviseur"])) {
                echo "Veuillez saisir l'ID du superviseur à supprimer.";
            } else {
                // Établir la connexion à la base de données
                $mysqli = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

                // Vérifier si la connexion a réussi
                if ($mysqli->connect_errno) {
                    echo "Erreur de connexion à la base de données : " . $mysqli->connect_error;
                    exit();
                }

                // Récupérer l'ID du superviseur à supprimer
                $id_superviseur = $_POST["id_superviseur"];

                // Préparer la requête de suppression
                $query = "DELETE FROM superviseur WHERE id_superviseur = $id_superviseur";

                // Exécuter la requête de suppression
                if ($mysqli->query($query)) {
                    echo "Superviseur supprimé avec succès.";
                } else {
                    echo "Erreur lors de la suppression du superviseur : " . $mysqli->error;
                }

                // Fermer la connexion à la base de données
                $mysqli->close();
            }
        }
        ?>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="id_superviseur">ID Superviseur à supprimer:</label>
                <input type="text" class="form-control" id="id_superviseur" name="id_superviseur">
            </div>
            <button type="submit" class="btn btn-danger">Supprimer</button>
            <a href="read_sup.php" class="btn btn-secondary ml-2">Retour</a>
        </form>
    </div>
</body>
</html>