<!DOCTYPE html>
<html>
<head>
    <title>Liste des superviseurs</title>
    <link href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.min.css">
    <style>
    .navbar {
        background-color: blue;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .navbar-logo {
        display: flex;
        align-items: center;
    }

    .navbar-logo img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-logo">
            <img src="../../asset/logo.png" alt="Logo de l'entreprise">
            <span class="company-name">RAINBOW CL SARL</span>
        </div>
    </nav>
    <div class="container">
        <h2>Liste des stages</h2>
        <a href="create_stage.php" class="btn btn-primary mb-3">Ajouter</a>
        <?php
        // Établir la connexion à la base de données
        $mysqli = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

        // Vérifier si la connexion a réussi
        if ($mysqli->connect_errno) {
            echo "Erreur de connexion à la base de données : " . $mysqli->connect_error;
            exit();
        }

        // Exécuter la requête de lecture
        $result = $mysqli->query("SELECT * FROM stage");

        // Vérifier s'il y a des résultats
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<tr><th>ID Stage</th><th>Date début</th><th>Date fin</th><th>Libellé</th><th>Id type_stage</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_stage'] . "</td>";
                echo "<td>" . $row['debut_stage'] . "</td>";
                echo "<td>" . $row['fin_stage'] . "</td>";
                echo "<td>" . $row['libelle_stage'] . "</td>";
                echo "<td>" . $row['id_type_stage'] . "</td>";
                echo "<td>";
                echo "<a href='update_stage.php?id=" . $row['id_stage'] . "' class='btn btn-sm btn-outline-primary mr-2'><i class='fas fa-edit'></i></a>";
                echo "<a href='delete_stage.php?id=" . $row['id_stage'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce superviseur ?\")'><i class='fas fa-trash-alt'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun stage trouvé.";
        }

        // Fermer le résultat
        $result->close();

        // Fermer la connexion à la base de données
        $mysqli->close();
        ?>
    </div>
</body>
</html>