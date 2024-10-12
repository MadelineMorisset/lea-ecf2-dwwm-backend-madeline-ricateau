<?php
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_link=$_POST['id_link'];

    $title_link_requete = $db_connect->prepare("SELECT titre_link FROM link WHERE id_link = ?");
    $title_link_requete->execute([$id_link]);
    $affichage_titre_lien = $title_link_requete->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url=$_POST['url'] ?? '';
    $title=$_POST['title'] ?? '';
    $comment=$_POST['comment'] ?? '';

    if (empty($url)) {
        $error = "Veuillez insérer une URL.";
    }elseif (empty($title)) {
        $error = "Veuillez renseigner un titre.";
    } else {
        $create_link_request = $db_connect->prepare("INSERT INTO link(url_link, titre_link, description_link, date_link)
                                                     VALUES(?,?,?, NOW())");
        $execution_request=$create_link_request->execute([$url, $title, $comment]); 
    
        if ($execution_request) {
            echo "Link ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du link ...";
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
                <li><a href="./backoffice.php">BACKOFFICE</a> / </li>
                <li><a href="./modify_link.php">Modifier</a></li>
            </ul>
        </nav>

        <div>
            <h2>Modifier le link : </h2>

            <form method="POST">
                <div>
                    <label for="url">URL (*) :</label>
                    <input type="url" name="url" id="url_link">
                </div>
                <div>
                    <label for="title">Link (*) :</label>
                    <input type="text" name="title" id="titre_link">
                </div>
                <div>
                    <label for="comment">Commentaire :</label>
                    <input type="text" name="comment" id="description_link">
                </div>
                <button type="submit">PUBLIER</button>
            </form>
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