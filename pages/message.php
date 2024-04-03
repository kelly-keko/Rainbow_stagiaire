<!DOCTYPE html>
<html>
<head>
    <title>Envoyer un message</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Envoyer un message</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="stagiaire">Stagiaire :</label>
                <select class="form-control" id="stagiaire" name="stagiaire">
                    <?php
                    // Fonction pour récupérer la liste des stagiaires depuis la base de données
                    function get_all_stagiaires() {
                        $conn = mysqli_connect("localhost", "root", "", "rainbow_stagiaire");

                        if (!$conn) {
                            die("Échec de la connexion à la base de données: " . mysqli_connect_error());
                        }

                        $query = "SELECT * FROM stagiaire";
                        $result = mysqli_query($conn, $query);

                        $stagiaires = array();

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $stagiaires[] = $row;
                            }
                        }

                        mysqli_close($conn);

                        return $stagiaires;
                    }

                    $stagiaires = get_all_stagiaires();

                    foreach ($stagiaires as $stagiaire) {
                        echo "<option value='" . $stagiaire['id_stagiaire'] . "'>" . $stagiaire['nom_stagiaire'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="saisissez votre message ici"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $stagiaire_id = $_POST["stagiaire"];
            $message = $_POST["message"];

            // Enregistrer le message dans la base de données
            $conn = mysqli_connect("localhost", "root", "", "rainbow_stagiaire");

            if (!$conn) {
                die("Échec de la connexion à la base de données: " . mysqli_connect_error());
            }

            $superviseur_id = 1; // Remplacez par l'ID du superviseur connecté

            $query = "INSERT INTO message (contenu_message, id_superviseur, id_stagiaire) VALUES ('$message', '$superviseur_id', '$stagiaire_id')";

            if (mysqli_query($conn, $query)) {
                echo "<p>Message envoyé avec succès.</p>";
            } else {
                echo "<p>Erreur lors de l'envoi du message: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>