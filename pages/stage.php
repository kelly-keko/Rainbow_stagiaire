<!DOCTYPE html>
<html>
<head>
    <title>CRUD - Stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rainbow_stagiaire";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Enregistrement ou suppression des données du stage
        if (isset($_POST['save'])) {
            $id_stage = $_POST['id_stage'];
            $debut_stage = $_POST['debut_stage'];
            $fin_stage = $_POST['fin_stage'];
            $libelle_stage = $_POST['libelle_stage'];
            $id_type_stage = $_POST['id_type_stage'];
            $id_admin = $_POST['id_admin'];

            // Vérifie si l'ID du stage est vide pour effectuer une insertion
            if (empty($id_stage)) {
                $sql = "INSERT INTO STAGE (debut_stage, fin_stage, libelle_stage, id_type_stage, id_admin)
                        VALUES ('$debut_stage', '$fin_stage', '$libelle_stage', '$id_type_stage', '$id_admin')";
            } else { // Sinon, effectue une mise à jour
                $sql = "UPDATE STAGE SET debut_stage='$debut_stage', fin_stage='$fin_stage', libelle_stage='$libelle_stage',
                        id_type_stage='$id_type_stage',id_admin='$id_admin' WHERE id_stage='$id_stage'";
            }

            if ($conn->query($sql) === TRUE) {
                echo "Données du stage enregistrées avec succès.";
            } else {
                echo "Erreur lors de l'enregistrement des données du stage : " . $conn->error;
            }
        }

        if (isset($_POST['delete'])) {
            $id_stage = $_POST['id_stage'];

            $sql = "DELETE FROM STAGE WHERE id_stage='$id_stage'";

            if ($conn->query($sql) === TRUE) {
                echo "Données du stage supprimées avec succès.";
            } else {
                echo "Erreur lors de la suppression des données du stage : " . $conn->error;
            }
        }

        // Récupération des données du stage pour affichage dans le tableau
        $sql = "SELECT * FROM STAGE";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_stage'] . "</td>";
                echo "<td>" . $row['debut_stage'] . "</td>";
                echo "<td>" . $row['fin_stage'] . "</td>";
                echo "<td>" . $row['libelle_stage'] . "</td>";
                echo "<td>" . $row['id_type_stage'] . "</td>";
                echo "<td>" . $row['id_admin'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucune donnée de stage disponible.</td></tr>";
        }

        $conn->close();
    ?>

    <div class="container">
        <h2>CRUD - Stage</h2>
        <form method="POST" action="crud.php">
            <input type="hidden" name="id_stage" value="">
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
            <button type="submit" class="btn btn-primary" name="save">Enregistrer</button>
            <button type="submit" class="btn btn-danger" name="delete">Supprimer</button>
        </form>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Début du stage</th>
                    <th>Fin du stage</th>
                    <th>Libellé du stage</th>
                    <th>ID du type de stage</th>
                    <th>ID de l'administrateur</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les données du stage seront affichées ici -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="crud.js"></script>
</body>
</html>