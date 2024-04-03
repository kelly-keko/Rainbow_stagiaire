<!DOCTYPE html>
<html>
<head>
    <title>Modifier un stagiaire</title>
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Modifier un stagiaire</h2>

        <?php
        // Vérifier si le paramètre "id" est présent dans l'URL
        if (isset($_GET["id"])) {
            // Récupérer l'ID du stagiaire à partir de l'URL
            $id_stagiaire = $_GET["id"];

            // Établir la connexion à la base de données
            $mysqli = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

            // Vérifier si la connexion a réussi
            if ($mysqli->connect_errno) {
                echo "Erreur de connexion à la base de données : " . $mysqli->connect_error;
                exit();
            }

            // Vérifier si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Vérifier si tous les champs sont renseignés
                if (empty($_POST["nom_stagiaire"]) || empty($_POST["email_stagiaire"]) || empty($_POST["password"]) || empty($_POST["tel_stagiaire"]) || empty($_POST["ville_stagiaire"]) || empty($_POST["id_superviseur"]) || empty($_POST["id_stage"])) {
                    echo "Veuillez remplir tous les champs du formulaire.";
                } else {
                    // Récupérer les données du formulaire
                    $nom_stagiaire = $_POST["nom_stagiaire"];
                    $email_stagiaire = $_POST["email_stagiaire"];
                    $mot_passe = $_POST["password"];
                    $tel_stagiaire = $_POST["tel_stagiaire"];
                    $ville_stagiaire = $_POST["ville_stagiaire"];
                    $id_superviseur = $_POST["id_superviseur"];
                    $id_stage = $_POST["id_stage"];

                    // Préparer la requête de mise à jour
                    $query = "UPDATE stagiaire SET nom_stagiaire='$nom_stagiaire', email_stagiaire='$email_stagiaire',tel_stagiaire='$tel_stagiaire', password_stagiaire='$mot_passe', ville_stagiaire='$ville_stagiaire', id_superviseur='$id_superviseur', id_stage='$id_stage' WHERE id_stagiaire='$id_stagiaire'";

                    // Exécuter la requête de mise à jour
                    if ($mysqli->query($query)) {
                        echo "Stagiaire mis à jour avec succès.";
                    } else {
                        echo "Erreur lors de la mise à jour du stagiaire : " . $mysqli->error;
                    }
                }
            }

            // Récupérer les données du stagiaire à partir de la base de données
            $result = $mysqli->query("SELECT * FROM stagiaire WHERE id_stagiaire='$id_stagiaire'");

            // Vérifier s'il y a des résultats
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Afficher le formulaire de mise à jour pré-rempli
                ?>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id_stagiaire; ?>">
                    <div class="form-group">
                        <label for="nom_stagiaire">Nom:</label>
                        <input type="text" class="form-control" id="nom_stagiaire" name="nom_stagiaire" value="<?php echo $row["nom_stagiaire"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email_stagiaire">Email:</label>
                        <input type="email" class="form-control" id="email_stagiaire" name="email_stagiaire" value="<?php echo $row["email_stagiaire"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mot_passe">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $row["password_stagiaire"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tel_stagiaire">Téléphone:</label>
                        <input type="tel" class="form-control" id="tel_stagiaire" name="tel_stagiaire" value="<?php echo $row["tel_stagiaire"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ville_stagiaire">Nom:</label>
                        <input type="text" class="form-control" id="ville_stagiaire" name="ville_stagiaire" value="<?php echo $row["ville_stagiaire"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_superviseur">ID du superviseur:</label>
                        <input type="number" class="form-control" id="id_superviseur" name="id_superviseur" value="<?php echo $row["id_superviseur"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_stage">ID du stage:</label>
                        <input type="number" class="form-control" id="id_stage" name="id_stage" value="<?php echo $row["id_stage"]; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="read_stagiaire.php" class="btn btn-secondary ml-2">Retour</a>
                </form>
                <?php
            } else {
                echo "Aucun stagiaire trouvé.";
            }

            // Fermer la connexion à la base de données
            $mysqli->close();
        } else {
            echo "ID du stagiaire non spécifié.";
        }
        ?>
    </div>
</body>
</html>