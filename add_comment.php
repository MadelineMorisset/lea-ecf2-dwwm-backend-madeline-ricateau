<!-- Pas terminé; lorsqu'on valide ça affiche une page quasi blanche  -->

<?php
require_once('db_connect.php');

$id_link= '';
$affichage_titre_lien= '';
$error="";
// Variable pour stocker le message de $execution_request
$execution_request_message= ''; 

// changement de méthode POST pour GET afin de récupérer l'id du link à partir de l'url
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_link"])) {
    $id_link=$_GET['id_link'];
    
    $title_link_requete = $db_connect->prepare("SELECT * 
                                                FROM link 
                                                WHERE id_link = ?");
    $title_link_requete->execute([$id_link]);
    $affichage_titre_lien = $title_link_requete->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_link=$_POST['id_link'] ?? '';
    $alias=$_POST['alias'] ?? ''; 
    $comment=$_POST['comment'] ?? '';

    if (empty($alias)) {
        $error = "Veuillez renseigner un pseudo.";
    } else {
        $comment_link_request = $db_connect->prepare("INSERT INTO link_comment(login_comment, commentaire, id_link, date_comment, heure_comment)
                                                     VALUES(?, ?, ?, CURRENT_DATE(),  CURRENT_TIME())");
        $execution_request=$comment_link_request->execute([$alias, $comment, $id_link]); 
    
        if ($execution_request) {
            $execution_request_message = "<p>Commentaire publié avec succès !</p>";
        } else {
            $execution_request_message = "<p>Erreur lors de la publication du commentaire ...</p>";
        }
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
        <nav>
            <!-- Pseudo fil d'ariane -->
            <ul>
                <li><a href="./index.php">Home</a> / </li>
                <li>
                    <a href="./link_file.php?id_link=<?php echo $affichage_titre_lien['id_link'] ?>">
                        <?php echo $affichage_titre_lien['titre_link'];?>
                    </a>/
                </li>
                <li><a href="./add_comment.php">Commenter</a></li>
            </ul>
        </nav>

        <div>
            <h2>Ajouter un commentaire sur : <br />
                <?php echo $affichage_titre_lien['titre_link']; ?>
            </h2>

            <form method="POST">
                <input type="hidden" name="id_link" value="<?php echo $affichage_titre_lien['id_link']; ?>">
                <div>
                    <label for="alias">Pseudo (*) :</label>
                    <input type="text" name="alias" id="alias" required>
                </div>
                <div>
                    <label for="comment">Commentaire :</label>
                    <input type="text" name="comment" id="comment">
                </div>
                <button type="submit">Publier</button>
            </form>

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