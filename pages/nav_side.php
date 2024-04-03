<!DOCTYPE html>
<html>
<head>
  <title>Tableau de bord de l'administrateur</title>
  <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome-free-6.4.2-web/css/all.min.css">
  <style>
    a{
      list-style-type: none;
      text-decoration: none;

    }

  body{
    background-color: #f2f2f2;
    text-decoration: none;
    list-style-type: none;

  }

    .navbar {
      background-color: #e9e9e9;
      padding: 20px;
      overflow: hidden;
      position: fixed;
      top: 0;
      width: 100%;
      display: flex;
      flex-direction: center;
    }
    
    .navbar img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
}
    
    .company-name {
      font-size: 18px;
      font-weight: bold;
      float: left;
      margin-right: 20px;
      white-space: nowrap;
      overflow: hidden;
      animation: marquee 10s linear infinite;
    }
    
    .logout-button {
      float: right;
    }
    
    .content {
      margin-left: 240px; /* Ajustement pour faire de la place au logo et au bouton de déconnexion */
      margin-top: 80px; /* Ajustement pour que le contenu principal soit visible sous la navbar */
      padding: 20px;
    }
    
    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    
    .logo {
      font-size: 24px;
      font-weight: bold;
    }
    
    .sidebar {
      background-color: #e9e9e9;
      color:black;
      padding: 20px;
      height: 110vh;
      position: fixed;
      top: 76px;
      left: 0;
      width: 250px;
      transition: transform 0.3s ease-out;
      z-index: 999;
    }

    
   
    .sidebar:hover li span {
      display: inline; /* Les textes sont affichés lorsqu'on survole la sidebar */
    }
    .sidebar.hidden {
      transform: translateX(-250px);
    }

    .sidebar li span {
      display: none; /* Par défaut, les textes sont masqués */
    }
    
    
    .sidebar ul {
      list-style-type: none;
      text-decoration: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 1em,
      outline: none;

    }
    
    .sidebar ul li a {
      margin-bottom: 10px;
      display: flex;
      flex-direction: row;
      gap: 1em;
      text-decoration: none;
      color: black;
    }
    
    .sidebar li:hover{
      background-color: pink;
      color: white;
    }
    
    .dashboard {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    
    .dashboard-item {
      width: 250px;
      height: 200px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      padding: 20px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <img src="../../asset/logo.png" alt="Logo de l'entreprise">
    <span class="company-name">RAINBOW CL SARL</span>
    <a href="../logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
    <a href="../admin.php" class=""><i class="fas fa-admin"></i> Adminstrateur</a>
  </div>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <ul>
      <li><a href="gst_stage/read_stage.php"><i class="fas fa-clipboard"></i> Gestion des stages</a></li>
      <li><a href="gst_superviseur/read_sup.php"><i class="fas fa-users"></i> Gestion des superviseurs</a></li>
      <li><a href="gst_stagiaire/read_stagiaire.php"><i class="fas fa-user-graduate"></i> Gestion des stagiaires</a></li>
      <li><a href="gst_tache/gestion_taches.php"><i class="fas fa-tasks"></i> Gestion des tâches</a></li>
      <li><a href="gestion_messages.php"><i class="fas fa-envelope"></i> Gestion des messages</a></li>
      <li><a href="gestion_evaluations.php"><i class="fas fa-chart-bar"></i> Gestion des évaluations</a></li>
      <li><a href="gestion_attestations.php"><i class="fas fa-file-alt"></i> Gestion des attestations de stages</a></li>
    </ul>
  </div>

  
  
</body>
</html>



