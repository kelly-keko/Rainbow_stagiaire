

<?php
session_start();

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['utilisateur'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    // Connexion à la base de données
    $connexion = new mysqli('localhost', 'root', '', 'rainbow_stagiaire');

    // Vérification des erreurs de connexion
    if ($connexion->connect_error) {
        die('Erreur de connexion à la base de données: ' . $connexion->connect_error);
    }

    // Requête pour récupérer les informations de l'utilisateur
    $requete = $connexion->prepare("SELECT * FROM stagiaire WHERE email_stagiaire = ?");
    $requete->bind_param('s', $email);
    $requete->execute();
    $resultat = $requete->get_result();
    $utilisateur = $resultat->fetch_assoc();

    if ($utilisateur && password_verify($motDePasse, $utilisateur['password_stagiaire'])) {
        // Authentification réussie pour le stagiaire
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: ../read_stagiaire.php');
        exit();
    }

    $requete = $connexion->prepare("SELECT * FROM superviseur WHERE email_sup = ?");
    $requete->bind_param('s', $email);
    $requete->execute();
    $resultat = $requete->get_result();
    $utilisateur = $resultat->fetch_assoc();

    if ($utilisateur && password_verify($motDePasse, $utilisateur['password_sup'])) {
        // Authentification réussie pour le superviseur
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: ../read_sup.php');
        exit();
    }

    $requete = $connexion->prepare("SELECT * FROM administrateur WHERE email_admin = ?");
    $requete->bind_param('s', $email);
    $requete->execute();
    $resultat = $requete->get_result();
    $utilisateur = $resultat->fetch_assoc();

    if ($utilisateur && password_verify($motDePasse, $utilisateur['password_admin'])) {
        // Authentification réussie pour l'administrateur
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: admin.php');
        exit();
    }

    // Échec de l'authentification
    echo "Identifiant ou mot de passe incorrect.";

    // Fermeture de la connexion
    $connexion->close();
}
?>

