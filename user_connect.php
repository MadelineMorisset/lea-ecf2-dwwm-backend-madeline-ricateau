<?php
session_start();

$host = "localhost";
$user = 'root';
$pass = 'V3nDta!';
$db = 'share_my_links';

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("La connexion a échouée : ".$connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_login = $_POST['login'];
    $admin_password = $_POST['password']; 

    $connection_admin_requete = $connection->prepare("SELECT password_admin
                                                      FROM admin_user
                                                      WHERE login_admin = ?");
    $connection_admin_requete->bind_param("s", $admin_login);
    $connection_admin_requete->execute();
    $connection_admin = $connection_admin_requete->get_result();

    if ($connection_admin->num_rows > 0) {
        $row = $connection_admin->fetch_assoc();
        $hash = $row['password_admin'];

        if (password_verify($admin_password, $hash)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['login'] = $admin_login;

            header("Location: backoffice.php");
            exit();
        } else {
            echo "Login ou mot de passe incorrect.";
        }
    } else {
        echo "Login ou mot de passe incorrect.";
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
            <h2>Connexion :</h2>

            <form method="POST">
                <div>
                    <label for="login">Login (*) :</label>
                    <input type="text" name="login" id="login" required>
                </div>
                <div>
                    <label for="password">Mot de passe (*) :</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </main>

    <footer>
        <nav>
            <ul>
                <li><a href="./user_connect.php">Connexion admin</a> / </li>
                <li><a href="./user_disconnect.php">Déconnexion</a></li>
            </ul>
        </nav>
    </footer>
</body>

</html>

<?php
$connection->close();
?>