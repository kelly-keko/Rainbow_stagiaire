<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un stage</title>
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Supprimer un stage</h2>

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
                // Supprimer le stagiaire de la base de données
                $query = "DELETE FROM stage WHERE id_stage='$id_stage'";

                if ($mysqli->query($query)) {
                    echo "Stage supprimé avec succès.";
                } else {
                    echo "Erreur lors de la suppression du stage : " . $mysqli->error;
                }

                // Fermer la connexion à la base de données
                $mysqli->close();
                exit();
            }

            // Récupérer les données du stagiaire à partir de la base de données
            $result = $mysqli->query("SELECT * FROM stage WHERE id_stage='$id_stage'");

            // Vérifier s'il y a des résultats
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Afficher les détails du stagiaire
                ?>
                <p><strong>ID stage:</strong> <?php echo $row["id_stage"]; ?></p>
                <p><strong>Date début:</strong> <?php echo $row["debut_stage"]; ?></p>
                <p><strong>Date fin:</strong> <?php echo $row["fin_stage"]; ?></p>
                <p><strong>Libelle stage:</strong> <?php echo $row["libelle_stage"]; ?></p>
                <p><strong>Id type stage:</strong> <?php echo $row["id_type_stage"]; ?></p>

                <p>Êtes-vous sûr de vouloir supprimer ce stagiaire ?</p>

                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id_stage; ?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                    <a href="read_stage.php" class="btn btn-secondary">Annuler</a>
                </form>
                <?php
            } else {
                echo "Aucun stagiaire trouvé.";
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