<?php
require_once('db_connect.php');

$id_link= '';
$affichage_titre_lien= '';
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

    // Débogage :
    // var_dump($affichage_titre_lien);
    // if ($affichage_titre_lien) {
    //     echo "Link récupéré avec succès ";
    // } else {
    //     echo "Erreur : le lien n'a pas été trouvé.";
    // }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_link"])) {
    $id_link=$_POST['id_link'];
    $url=$_POST['url'];
    $title=$_POST['title'];
    $description=$_POST['description'];

    $update_link_requete = $db_connect->prepare("UPDATE link
                                                 SET url_link = ?, titre_link = ?, description_link = ?
                                                 WHERE id_link = ?");
    $execution_request=$update_link_requete->execute([$url, $title, $description, $id_link]);

    if ($execution_request) {
        $execution_request_message = "<p>Link modifié avec succès !</p>";
    } else {
        $execution_request_message = "<p>Erreur lors de la modification du link ...</p>";
    }
    
    // Recharger les données du lien après la modification,
    $title_link_requete = $db_connect->prepare("SELECT * 
                                                FROM link 
                                                WHERE id_link = ?");
    $title_link_requete->execute([$id_link]);
    $affichage_titre_lien = $title_link_requete->fetch(PDO::FETCH_ASSOC);

    // pour garder les valeurs une fois le formulaire validé
    $url = htmlspecialchars($url);
    $title = htmlspecialchars($title);
    $description = htmlspecialchars($description);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_link"])) {
    // en cas de soucis on garde de coté les valeurs dans $affichage_titre_lien
    $url=htmlspecialchars($affichage_titre_lien['url_link']);
    $title=htmlspecialchars($affichage_titre_lien['titre_link']);
    $description=htmlspecialchars($affichage_titre_lien['description_link']);
} else {
    // si aucun link n'est trouvé
    $url='';
    $title='';
    $description='';
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
            <h2>Modifier le link : <br />
                <?php echo $affichage_titre_lien['titre_link']; ?>
            </h2>

            <form method="POST">
                <input type="hidden" name="id_link" value="<?php echo $affichage_titre_lien['id_link']; ?>">

                <div>
                    <label for="url">URL :</label>
                    <input type="url" name="url" value="<?php echo $url; ?>" id="url_link">
                </div>
                <div>
                    <label for="title">Link :</label>
                    <input type="text" name="title" value="<?php echo $title; ?>" id="titre_link">
                </div>
                <div>
                    <label for="description">Description :</label>
                    <input type="text" name="description" value="<?php echo $description; ?>" id="description_link">
                </div>
                <button type="submit">Modifier</button>
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