<?php
session_start();

require_once('db_connect.php');

$links_requete = "SELECT * FROM link ORDER BY date_link DESC";
$links_recuperes = $db_connect->query($links_requete);
$affichage_liens = $links_recuperes->fetchAll();
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
        <?php 
        foreach ($affichage_liens as $lien) { 

            $calculer_commentaires_requete = $db_connect->prepare("SELECT COUNT(*) AS nombre_commentaires
                                                                FROM link_comment
                                                                WHERE id_link = ?");
            $calculer_commentaires_requete->execute([$lien['id_link']]);
            $affichage_nombre_commentaires = $calculer_commentaires_requete->fetch();
        ?>

        <div>
            <div>
                <h2><?php echo $lien['titre_link'] ?></h2>
                <p><?php echo $lien['description_link'] ?></p>
                <div>
                    <a href="<?php echo $lien['url_link'] ?>"><?php echo $lien['url_link'] ?></a>
                    <p>Publié le : <?php echo date('d M Y', strtotime($lien['date_link'])) ?></p>
                </div>
            </div>
            <p>Il y a : <?php echo $affichage_nombre_commentaires['nombre_commentaires'] ?> commentaires</p>
        </div>
        <?php }; ?>
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