<!DOCTYPE html>
<html>
<head>
    <title>Création d'une tâche</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Styles spécifiques à cette page */
    </style>
</head>
<body>
    <div class="container">
        <h1>Création d'une tâche</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="description">Description :</label>
                <input type="text" class="form-control" name="description" id="description" required>
            </div>
            <div class="form-group">
                <label for="debut">Date de début :</label>
                <input type="date" class="form-control" name="debut" id="debut" required>
            </div>
            <div class="form-group">
                <label for="fin">Date de fin :</label>
                <input type="date" class="form-control" name="fin" id="fin" required>
            </div>
            <div class="form-group">
                <label for="superviseur">Superviseur :</label>
                <select class="form-control" name="superviseur" id="superviseur" required>
                    <?php
                    // Code PHP pour récupérer les superviseurs depuis la table "superviseur" dans la base de données
                    // et afficher les options de sélection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "rainbow_stagiaire";

                    // Connexion à la base de données
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Récupération des superviseurs depuis la table "superviseur"
                    $sql = "SELECT id_superviseur, nom_sup FROM superviseur";
                    $result = $conn->query($sql);

                    // Affichage des options de sélection pour les superviseurs
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id_superviseur"] . "'>" . $row["nom_sup"] . "</option>";
                        }
                    }

                    // Fermeture de la connexion à la base de données
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="stagiaire">Stagiaire :</label>
                <select class="form-control" name="stagiaire" id="stagiaire" required>
                    <?php
                    // Code PHP pour récupérer les stagiaires depuis la table "stagiaire" dans la base de données
                    // et afficher les options de sélection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "rainbow_stagiaire";

                    // Connexion à la base de données
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Récupération des stagiaires depuis la table "stagiaire"
                    $sql = "SELECT id_stagiaire, nom_stagiaire FROM stagiaire";
                    $result = $conn->query($sql);

                    // Affichage des options de sélection pour les stagiaires
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id_stagiaire"] . "'>" . $row["nom_stagiaire"] . "</option>";
                        }
                    }

                    // Fermeture de la connexion à la base de données
                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Traitement du formulaire lorsqu'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST["description"];
    $debut = $_POST["debut"];
    $fin = $_POST["fin"];
    $superviseur = $_POST["superviseur"];
    $stagiaire = $_POST["stagiaire"];

    // Code PHP pour insérer les données dans la table "tache" et "effectuer" de la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rainbow_stagiaire";

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insertion de la tâche dans la table "tache"
    $sql = "INSERT INTO tache (description_tache, debut_tache, fin_tache, id_superviseur) VALUES ('$description', '$debut', '$fin', '$superviseur')";
    if ($conn->query($sql) === TRUE) {
        $task_id = $conn->insert_id;

        // Insertion de l'association entre la tâche, le superviseur et le stagiaire dans la table "effectuer"
        $sql = "INSERT INTO effectuer (id_tache, id_stagiaire) VALUES ('$task_id', '$stagiaire')";
        if ($conn->query($sql) === TRUE) {
            echo "La tâche a été créée avec succès.";
        } else {
            echo "Erreur lors de la création de la tâche : " . $conn->error;
        }
    } else {
        echo "Erreur lors de la création de la tâche : " . $conn->error;
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
}
?>