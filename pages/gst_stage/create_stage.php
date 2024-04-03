<!DOCTYPE html>
<html>
<head>
    <title>CRUD - Créer un stage</title>
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    // Code pour la création d'un stage 
    if(isset($_POST['create'])) {
        // Récupérer les données du formulaire
        $debut_stage = $_POST['debut_stage'];
        $fin_stage = $_POST['fin_stage'];
        $libelle_stage = $_POST['libelle_stage'];
        $id_type_stage = $_POST['id_type_stage'];
        $id_admin = $_POST['id_admin'];

        // Effectuer les opérations nécessaires pour créer le stage dans la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rainbow_stagiaire";

        // Créer une connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Requête d'insertion
        $sql = "INSERT INTO stage (debut_stage, fin_stage, libelle_stage, id_type_stage, id_admin) VALUES ('$debut_stage', '$fin_stage', '$libelle_stage', '$id_type_stage', '$id_admin')";

        if ($conn->query($sql) === TRUE) {
            echo "Stage créé avec succès.";
        } else {
            echo "Erreur lors de la création du stage : " . $conn->error;
        }

        // Fermer la connexion
        $conn->close();
    }
    ?>

    <div class="container">
        <h2>Créer un nouveau stage</h2>
        <form method="POST" action="#">
            <div class="form-group">
                <label for="debut_stage">Début du stage:</label>
                <input type="date" class="form-control" name="debut_stage" required>
            </div>
            <div class="form-group">
                <label for="fin_stage">Fin du stage:</label>
                <input type="date" class="form-control" name="fin_stage" required>
            </div>
            <div class="form-group">
                <label for="libelle_stage">Libellé du stage:</label>
                <input type="text" class="form-control" name="libelle_stage" required>
            </div>
            <div class="form-group">
                <label for="id_type_stage">ID du type de stage:</label>
                <input type="number" class="form-control" name="id_type_stage" required>
            </div>
            <div class="form-group">
                <label for="id_admin">ID de l'administrateur:</label>
                <input type="number" class="form-control" name="id_admin" required>
            </div>
            <button type="submit" class="btn btn-primary" name="create">Créer</button>
            <a href="read_stage.php" class="btn btn-secondary ml-2">retour</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>