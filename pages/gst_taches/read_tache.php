<?php
// Établir la connexion à la base de données
$connexion = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

// Vérifier si la connexion a réussi
if ($connexion->connect_errno) {
    echo "Erreur de connexion à la base de données : " . $connexion->connect_error;
    exit();
}

// Récupérer toutes les tâches de la base de données
$requete = $connexion->prepare("SELECT * FROM tache");
$requete->execute();
$resultat = $requete->get_result();
$taches = $resultat->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des tâches</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h2>Liste des tâches</h2>

        <!-- Affichage de la liste des tâches -->
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Id_superviseur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taches as $tache) : ?>
                    <tr>
                        <td><?php echo $tache['description_tache']; ?></td>
                        <td><?php echo $tache['debut_tache']; ?></td>
                        <td><?php echo $tache['fin_tache']; ?></td>
                        <td><?php echo $tache['id_superviseur']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>