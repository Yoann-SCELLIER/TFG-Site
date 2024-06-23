<?php
require_once dirname(__DIR__) . '/crud/game_console.fn.php'; // Assurez-vous que le chemin vers votre fichier contenant les fonctions CRUD est correct

// Initialisation des variables
$id = isset($_GET['id']) ? $_GET['id'] : null; // Récupère l'ID du jeu depuis les paramètres GET
$game = null; // Variable pour stocker les détails du jeu

// Vérifier si un ID est fourni dans l'URL pour charger les détails du jeu existant
if ($id) {
    // Appeler la fonction pour récupérer les informations du jeu à partir de l'ID
    $game = getGameById($bdd, $id);
}

// Si le formulaire est soumis (modification ou ajout)
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // Récupérer les données du formulaire soumis
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Si un ID est présent, il s'agit d'une modification
    if ($id) {
        // Appeler la fonction pour mettre à jour les informations du jeu dans la base de données
        updateGame($bdd, $id, $title, $content, $image_url);
    } else {
        // Sinon, il s'agit d'un ajout d'un nouveau jeu
        // Appeler la fonction pour ajouter un nouveau jeu dans la base de données
        addGame($bdd, $title, $content, $image_url);
    }

    // Redirection vers une autre page après le traitement du formulaire
    header('Location: index.php'); // Remplacez index.php par la page souhaitée
    exit();
}

// À ce stade, la variable $game contient les détails du jeu à afficher ou à modifier s'il y a un ID valide
// Si le formulaire est soumis en méthode POST, les données sont traitées pour mettre à jour ou ajouter un jeu dans la base de données
// La redirection est effectuée après le traitement du formulaire pour éviter les soumissions multiples
