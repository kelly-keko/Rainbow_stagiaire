<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour d'un superviseur</title>
    <link href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
<div class="container">
        <h2>Modifier un superviseur</h2>

        <?php
        // Vérifier si le paramètre "id" est présent dans l'URL
        if (isset($_GET["id"])) {
            // Récupérer l'ID du superviseur à partir de l'URL
            $id_superviseur = $_GET["id"];

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
                if (empty($_POST["nom_sup"]) || empty($_POST["email_sup"]) || empty($_POST["tel_sup"]) || empty($_POST["id_stage"])) {
                    echo "Veuillez remplir tous les champs du formulaire.";
                } else {
                // Récupérer les données du formulaire
                $nom_superviseur = $_POST["nom_sup"];
                $email_superviseur = $_POST["email_sup"];
                $tel_superviseur = $_POST["tel_sup"];
                $id_stage = $_POST["id_stage"];

                    // Préparer la requête de mise à jour
                    $query = "UPDATE superviseur SET nom_sup = '$nom_superviseur', email_sup = '$email_superviseur', tel_sup = '$tel_superviseur', id_stage = '$id_stage' WHERE id_superviseur = $id_superviseur";

                    // Exécuter la requête de mise à jour
                    if ($mysqli->query($query)) {
                        echo "superviseur mis à jour avec succès.";
                    } else {
                        echo "Erreur lors de la mise à jour du superviseur : " . $mysqli->error;
                    }
                }
            }

            // Récupérer les données du stagiaire à partir de la base de données
            $result = $mysqli->query("SELECT * FROM superviseur WHERE id_superviseur='$id_superviseur'");

            // Vérifier s'il y a des résultats
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Afficher le formulaire de mise à jour pré-rempli
                ?>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id_superviseur; ?>">
                    <div class="form-group">
                        <label for="nom_superviseur">Nom:</label>
                        <input type="text" class="form-control" id="nom_sup" name="nom_sup" value="<?php echo $row["nom_sup"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email_superviseur">Email:</label>
                        <input type="email" class="form-control" id="email_sup" name="email_sup" value="<?php echo $row["email_sup"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tel_superviseur">Numéro de téléphone:</label>
                        <input type="text" class="form-control" id="tel_sup" name="tel_sup" value="<?php echo $row["tel_sup"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_stage">ID du stage:</label>
                        <input type="text" class="form-control" id="id_stage" name="id_stage" value="<?php echo $row["id_stage"]; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="read_sup.php" class="btn btn-secondary ml-2">Retour</a>
                </form>
                <?php
            } else {
                echo "Aucun superviseur trouvé.";
            }

            // Fermer la connexion à la base de données
            $mysqli->close();
        } else {
            echo "ID du superviseur non spécifié.";
        }
        ?>
    </div>
</body>
</html>