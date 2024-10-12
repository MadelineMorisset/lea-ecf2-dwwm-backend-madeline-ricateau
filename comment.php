<?php
    session_start();
    
    require_once('db_connect.php');
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
        <!-- Fil d'ariane -->

        <?php 
            if (isset($_GET['id_link'])) {
                $id_link = $_GET['id_link'];
                
                $links_titre_requete = $db_connect->prepare("SELECT titre_link
                                                             FROM link
                                                             WHERE id_link = ?");
                // à poursuivre une fois le crud fini
            }
        ?>

        <div>
            <h2>Ajouter un commentaire sur : <?php ?></h2>

            <form action="" method="$_GET">
                <div>
                    <!-- à poursuivre une fois le crud fini -->
                    <label for=""></label>
                </div>
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