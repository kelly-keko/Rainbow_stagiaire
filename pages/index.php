<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>

        body {
            background-image: linear-gradient(to right, #ffc3a0, #ffafcc, #d7a0ff, #a0b9ff, #a0e6ff, #a0ffe2, #a0ffd1);
            background-size: 200% auto;
            animation: animateBackground 10s linear infinite;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        @keyframes animateBackground {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        /*body {
            background-color: #f8f9fa;
        }*/

        .container {
            max-width: 400px;
            margin: 100px auto;
        }

        .card {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="mb-4">Connexion</h2>
        
            <?php
            session_start();
            // Connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=rainbow_stagiaire;charset=utf8;', 'root', '');

            if (isset($_POST['submit'])) {
                if (!empty($_POST['email']) && !empty($_POST['motDePasse'])) {
                    $email = htmlspecialchars($_POST['email']);
                    $motDePasse = $_POST['motDePasse'];
            
                    $recupUser = $bdd->prepare('SELECT * FROM superviseur WHERE email_sup=? AND password_sup=?');
                    $recupUser->execute(array($email, $motDePasse));
            
                    if ($recupUser->rowCount() > 0) {
                        $_SESSION['email'] = $email;
                        $_SESSION['motDePasse'] = $motDePasse;
                        $_SESSION['id'] = $recupUser->fetch()['id'];
            
                        header('Location: gst_superviseur/read_sup.php');
                        exit();
                    } else {
                        echo "Erreur";
                    }
                } else {
                    echo "Merci de compléter tous les champs";
                }
            }

            if (isset($_POST['submit'])) {
                if (!empty($_POST['email']) && !empty($_POST['motDePasse'])) {
                    $email = htmlspecialchars($_POST['email']);
                    $motDePasse = $_POST['motDePasse'];
            
                    $recupUser = $bdd->prepare('SELECT * FROM stagiaire WHERE email_stagiaire=? AND password_stagiaire=?');
                    $recupUser->execute(array($email, $motDePasse));
            
                    if ($recupUser->rowCount() > 0) {
                        $_SESSION['email'] = $email;
                        $_SESSION['motDePasse'] = $motDePasse;
                        $_SESSION['id'] = $recupUser->fetch()['id'];
            
                        header('Location: gst_stagiaire/read_stagiaire.php');
                        exit();
                    } else {
                        echo "Erreur";
                    }
                } else {
                    echo "Merci de compléter tous les champs";
                }
            }


        if (isset($_POST['submit'])) {
            if (!empty($_POST['email']) && !empty($_POST['motDePasse'])) {
                $email = htmlspecialchars($_POST['email']);
                $motDePasse = $_POST['motDePasse'];
        
                $recupUser = $bdd->prepare('SELECT * FROM administrateur WHERE email_admin=? AND password_admin=?');
                $recupUser->execute(array($email, $motDePasse));
        
                if ($recupUser->rowCount() > 0) {
                    $_SESSION['email'] = $email;
                    $_SESSION['motDePasse'] = $motDePasse;
                    $_SESSION['id'] = $recupUser->fetch()['id'];
        
                    header('Location: admin.php');
                    exit();
                } else {
                    echo "Erreur";
                }
            } else {
                echo "Merci de compléter tous les champs";
            }
        }
        ?>

            <?php if (isset($messageErreur)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $messageErreur; ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="motDePasse">Mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse" name="motDePasse" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>