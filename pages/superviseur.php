<!DOCTYPE html>
<html>
<head>
  <title>Tableau de bord du superviseur</title>
  <link rel="stylesheet" href="/bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/fontawesome-free-6.4.2-web/css/all.css">
  <style>
    body {
      padding-top: 50px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Tableau de bord du superviseur</a>
    </div>
  </nav>

  <div class="container">
    <h2 class="mt-5">Liste des stagiaires</h2>
    <table class="table mt-4">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Connexion à la base de données
          $serveur = "localhost";
          $utilisateur = "root";
          $motDePasse = "";
          $baseDeDonnees = "rainbow_stagiaire";

          $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

          // Vérifier la connexion
          if (!$connexion) {
              die("Échec de la connexion à la base de données : " . mysqli_connect_error());
          }

          // Récupérer la liste des stagiaires encadrés par le superviseur
          $idSuperviseur = 1; // Remplacez 1 par l'ID du superviseur connecté (peut être récupéré à partir de la session ou de la connexion)

          $requete = "SELECT * FROM stagiaire WHERE id_superviseur = $idSuperviseur";
          $resultat = mysqli_query($connexion, $requete);

          if (!$resultat) {
              die("Échec de la requête : " . mysqli_error($connexion));
          }

          // Afficher la liste des stagiaires
          while ($row = mysqli_fetch_assoc($resultat)) {
              echo '<tr>';
              echo '<td>' . $row['nom_stagiaire'] . '</td>';
              echo '<td>' . $row['email_stagiaire'] . '</td>';
              echo '<td>';
              echo '<a href="message.php?stagiaire=' . $row['email_stagiaire'] . '"><i class="fas fa-envelope"></i> Envoyer un message</a><br>';
              echo '<a href="gst_taches/create_tache.php?stagiaire=' . $row['email_stagiaire'] . '"><i class="fas fa-tasks"></i> Attribuer une tâche</a>';
              echo '</td>';
              echo '</tr>';
          }

          // Fermer la connexion à la base de données
          mysqli_close($connexion);
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>