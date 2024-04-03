<!DOCTYPE html>
<html>
<head>
    <title>Liste des stagiaires</title>
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
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
        <h2>Liste des stagiaires</h2>
        <a href="create_stagiaire.php" class="btn btn-primary mb-3">Ajouter</a>
        <?php
        // Établir la connexion à la base de données
        $mysqli = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

        // Vérifier si la connexion a réussi
        if ($mysqli->connect_errno) {
            echo "Erreur de connexion à la base de données : " . $mysqli->connect_error;
            exit();
        }

        // Exécuter la requête de lecture
        $result = $mysqli->query("SELECT s.*, sp.nom_sup FROM stagiaire s LEFT JOIN superviseur sp ON s.id_superviseur = sp.id_superviseur");

        // Vérifier s'il y a des résultats
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<tr><th>ID Stagiaire</th><th>Nom</th><th>Email</th><th>Téléphone</th><th>Password</th><th>Ville</th><th>ID superviseur</th><th>ID stage</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_stagiaire'] . "</td>";
                echo "<td>" . $row['nom_stagiaire'] . "</td>";
                echo "<td>" . $row['email_stagiaire'] . "</td>";
                echo "<td>" . $row['tel_stagiaire'] . "</td>";
                echo "<td>" . $row['password_stagiaire'] . "</td>";
                echo "<td>". $row['ville_stagiaire'] ."</td>";
                echo "<td>" . $row['id_superviseur'] . "</td>";
                echo "<td>" . $row['id_stage'] . "</td>";
                echo "<td>";
                echo "<a href='update_stagiaire.php?id=" . $row['id_stagiaire'] . "' class='btn btn-sm btn-outline-primary mr-2'><i class='fas fa-edit'></i></a>";
                echo "<a href='delete_stagiaire.php?id=" . $row['id_stagiaire'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce stagiaire ?\")'><i class='fas fa-trash-alt'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun stagiaire trouvé.";
        }

        // Fermer le résultat
        $result->close();

        // Fermer la connexion à la base de données
        $mysqli->close();
        ?>
    </div>
</body>
</html>