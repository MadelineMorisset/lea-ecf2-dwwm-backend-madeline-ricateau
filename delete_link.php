<?php
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_link=$_GET['id_link'];

    $delete_link_request = $db_connect->prepare("DELETE FROM link WHERE id_link=?");
    $execution_request=$delete_link_request->execute([$id_link]); 

    header('Location: backoffice.php');
    exit();
}
?>