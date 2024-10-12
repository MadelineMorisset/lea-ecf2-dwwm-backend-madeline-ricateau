<?php
// Je mets le liens ici, car normalement cette page 
// n'est pas censée être accessible à tous; 
// et comme je ne sais pas comment m'y prendre autrement,
// voici le lien type pour y accéder ... :
// http://localhost/lea-ecf2-dwwm-backend-madeline-ricateau/create_admin.php

session_start();

$host = "localhost";
$user = 'root';
$pass = 'V3nDta!';
$db = 'share_my_links';

$ajout_admin_execution_message= ''; 

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("La connexion a échouée : ".$connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_login = $_POST['login'];
    $admin_password = $_POST['password'];
    
    $hash = password_hash($admin_password, PASSWORD_DEFAULT);

    $ajout_admin_requete = $connection->prepare("INSERT INTO admin_user(login_admin, password_admin)
                                                 VALUES(?, ?)");
    $ajout_admin_requete->bind_param("ss", $admin_login, $admin_password);

    if ($ajout_admin_requete) {
        $ajout_admin_execution_message = "<p>Admin ajouté avec succès !</p>";
    } else {
        $ajout_admin_execution_message = "<p>Erreur lors de l'ajout de l'Admin ...</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Share my Links</title>
</head>

<body>
    <header>
        <h1>SHARE MY LINKS</h1>
    </header>

    <main>
        <div>
            <h2>Créer un admin</h2>

            <form method="POST">
                <div>
                    <label for="login">Login (*) :</label>
                    <input type="text" name="login" id="login" required>
                </div>
                <div>
                    <label for="password">Mot de passe (*) :</label>
                    <input type="text" name="password" id="password" required>
                </div>
                <button type="submit">Créer Admin</button>
            </form>


            <?php if ($ajout_admin_execution_message) { ?>
            <div>
                <p><?php echo $ajout_admin_execution_message ?></p>
            </div>
            <?php }; ?>
        </div>
    </main>

    <footer>
        <nav>
            <ul>
                <li><a href="/">Connexion admin</a> / </li>
                <li><a href="/">Déconnexion</a></li>
            </ul>
        </nav>
    </footer>
</body>

</html>

<?php
$connection->close();
?>