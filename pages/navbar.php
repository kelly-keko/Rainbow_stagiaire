<!DOCTYPE html>
<html>
<head>
  <title>Application de gestion des stagiaires</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .navbar {
      background-color: #007bff; /* Couleur de fond de la navbar (bleu) */
      padding: 5px; /* Réduit la hauteur de la navbar */
      display: flex;
      align-items: center;
      color: #ffffff; /* Couleur du texte (blanc) */
    }

    .company-name {
      font-weight: bold;
      margin-left: 10px;
      animation: scrollText 10s linear infinite; /* Animation pour le défilement du nom de l'entreprise */
    }

    .admin-button {
      margin-right: 10px;
      order: -1; /* Place le bouton administrateur en premier */
    }

    .logout-button {
      margin-left: auto;
    }

    /* Ajoute une marge à droite pour les boutons */
    .admin-button,
    .logout-button {
      margin-right: 10px;
    }

    @keyframes scrollText {
      0% { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }
  </style>
</head>
<body>
  <div class="navbar">
    <img src="../asset/logo.png" alt="Logo de l'entreprise">
    <span class="company-name">RAINBOW CL SARL</span>
    <button class="btn btn-primary admin-button">Administrateur</button>
    <button class="btn btn-outline-light logout-button">Déconnexion</button>
  </div>

  <!-- Chargement des scripts Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>