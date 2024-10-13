<?php
require_once('db_connect.php');

$id_link= '';
$affichage_titre_lien= '';
// Variable pour stocker le message de $execution_request
$execution_request_message= ''; 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_link"])) {
    $id_link=$_GET['id_link'];
    
    // Requête pour l'article
    $title_link_requete = $db_connect->prepare("SELECT * 
                                                FROM link 
                                                WHERE id_link = ?");
    $title_link_requete->execute([$id_link]);
    $affichage_titre_lien = $title_link_requete->fetch(PDO::FETCH_ASSOC);
    
    // Requête pour les commentaire liés à l'article
    $comment_link_requete = $db_connect->prepare("SELECT * 
                                                   FROM link_comment 
                                                   WHERE id_link = ?
                                                   ORDER BY date_comment DESC, heure_comment DESC");
    $comment_link_requete->execute([$id_link]);
    $affichage_commentaires = $comment_link_requete->fetchAll();
} else {
        $execution_request_message = "<p>Link non trouvé ...</p>";
        exit();
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
        <nav>
            <!-- Pseudo fil d'ariane -->
            <ul>
                <li><a href="./index.php">Home</a> / </li>
                <li>
                    <a href="./modify_link.php">
                        <?php echo isset($affichage_titre_lien['titre_link']) ? htmlspecialchars($affichage_titre_lien['titre_link']) : ''; ?>
                    </a>
                </li>
            </ul>
        </nav>

        <div>
            <div>
                <div>
                    <h2><?php echo $affichage_titre_lien['titre_link'] ?></h2>
                    <p><?php echo $affichage_titre_lien['description_link'] ?></p>
                    <div>
                        <a
                            href="<?php echo $affichage_titre_lien['url_link'] ?>"><?php echo $affichage_titre_lien['url_link'] ?></a>
                        <p>Publié le : <?php echo date('d M Y', strtotime($affichage_titre_lien['date_link'])) ?></p>
                    </div>
                </div>

                <div>
                    <h4>Commentaires</h4>
                    <?php foreach ($affichage_commentaires as $commentaire) { ?>
                    <div>
                        <p><?php echo $commentaire['commentaire'] ?></p>
                        <h5>
                            Publié par <?php echo $commentaire['login_comment'] ?> le
                            <?php echo date('d M Y', strtotime($commentaire['date_comment'])) ?> à
                            <?php echo date('H:i', strtotime($commentaire['heure_comment'])) ?>
                        </h5>
                    </div>
                    <?php }; ?>
                </div>
                <a href="./add_comment.php?id_link=<?php echo $affichage_titre_lien['id_link'] ?>">
                    Ajouter un commentaire
                </a>
            </div>

            <?php if ($execution_request_message) { ?>
            <div>
                <p><?php echo $execution_request_message ?></p>
            </div>
            <?php }; ?>

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