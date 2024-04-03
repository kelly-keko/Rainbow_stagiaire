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
            $id_stage = $_GET["id"];

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
                if (empty($_POST["debut_stage"]) || empty($_POST["fin_stage"]) || empty($_POST["libelle_stage"]) || empty($_POST["id_type_stage"])) {
                    echo "Veuillez remplir tous les champs du formulaire.";
                } else {
                    // Récupérer les données du formulaire
                    $debut_stage = $_POST["debut_stage"];
                    $fin_stage = $_POST["fin_stage"];
                    $libelle_stage = $_POST["libelle_stage"];
                    $id_type_stage = $_POST["id_type_stage"];

                    // Préparer la requête de mise à jour
                    $query = "UPDATE stage SET debut_stage='$debut_stage', fin_stage='$fin_stage', libelle_stage='$libelle_stage', id_type_stage='$id_type_stage' WHERE id_stage='$id_stage'";

                    // Exécuter la requête de mise à jour
                    if ($mysqli->query($query)) {
                        echo "stage mis à jour avec succès.";
                    } else {
                        echo "Erreur lors de la mise à jour du stage : " . $mysqli->error;
                    }
                }
            }

            // Récupérer les données du stagiaire à partir de la base de données
            $result = $mysqli->query("SELECT * FROM stage WHERE id_stage='$id_stage'");

            // Vérifier s'il y a des résultats
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Afficher le formulaire de mise à jour pré-rempli
                ?>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id_stage; ?>">
                    <div class="form-group">
                        <label for="debut_stage">Date de début:</label>
                        <input type="date" class="form-control" id="debut_stage" name="debut_stage" value="<?php echo $row["debut_stage"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="debut_stage">Date de fin:</label>
                        <input type="date" class="form-control" id="fin_stage" name="fin_stage" value="<?php echo $row["fin_stage"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="libelle_stage">Libelle du stage:</label>
                        <input type="text" class="form-control" id="libelle_stage" name="libelle_stage" value="<?php echo $row["libelle_stage"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="number">Id type_stage:</label>
                        <input type="number" class="form-control" id="id_type_stage" name="id_type_stage" value="<?php echo $row["id_type_stage"]; ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="read_stage.php" class="btn btn-secondary ml-2">Retour</a>
                </form>
                <?php
            } else {
                echo "Aucun stage trouvé.";

            }

            // Fermer la connexion à la base de données
            $mysqli->close();
        } else {
            echo "ID du stage non spécifié.";
        }
        ?>
    </div>
</body>
</html>