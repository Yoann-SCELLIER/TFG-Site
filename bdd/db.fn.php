<?php

// Informations de connexion à la base de données
$servername = "localhost"; // Remplacez par le nom du serveur de votre base de données
$username = "yoann"; // Remplacez par votre nom d'utilisateur de la base de données
$password = "Simplon2023!"; // Remplacez par votre mot de passe de la base de données
$dbname = "association_tf"; // Remplacez par le nom de votre base de données

// Connexion à la base de données
try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO à exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Définir le jeu de caractères utilisé par la connexion
    $bdd->exec("SET NAMES 'utf8'");
} catch(PDOException $e) {
    // En cas d'erreur de connexion, afficher un message d'erreur
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    // Arrêter l'exécution du script
    exit();
}