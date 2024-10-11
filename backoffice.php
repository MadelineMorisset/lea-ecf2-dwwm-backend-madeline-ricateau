<?php
require_once('db_connect.php');

$links_requete = "SELECT * FROM link ORDER BY date_link ASC";
$links_recuperes = $db_connect->query($links_requete);
$affichage_liens = $links_recuperes->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/23c1a897ea.js" crossorigin="anonymous"></script>
    <title>Share my Links</title>
</head>

<body>
    <header>
        <h1>SHARE MY LINKS</h1>
    </header>

    <main>
        <nav>
            <!-- Pseudo fil d'ariane -->
            <ul>
                <li><a href="./backoffice.php">BACKOFFICE</a></li>
            </ul>
        </nav>

        <div>
            <h3><a href="./create_link.php">Ajouter un link</a></h3>

            <h2>Modifier / Supprimer un link</h2>
            <?php foreach ($affichage_liens as $lien) { ?>
            <div>
                <h4>- <?php echo $lien['titre_link'] ?></h4>
                <div>
                    <a href="./modify_link.php?id_link=<?php echo $lien['id_link'] ?>">Modifier</a>
                    <a href="./delete_link.php?id_link=<?php echo $lien['id_link'] ?>">Supprimer</a>
                </div>
            </div>
            <?php }; ?>
        </div>
    </main>

    <footer>
        <nav>
            <ul>
                <li><a href=" /">Connexion admin</a> / </li>
                <li><a href="/">Déconnexion</a></li>
            </ul>
        </nav>
    </footer>
</body>

</html>