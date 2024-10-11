<?php
try {
    $db_connect = new PDO("mysql:host=localhost;dbname=share_my_links", 
                          "root", 
                          "V3nDta!");
                          
    $db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connexion réussie ! ";  
} catch (PDOException $e) {
    echo ("Connexion échouée : " . $e->getMessage());    
}