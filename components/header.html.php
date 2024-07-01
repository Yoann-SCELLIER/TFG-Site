<?php
session_start(); // Démarrage de la session 

// Inclusion du fichier de meta-descriptions (assurez-vous que le chemin est correct)
require_once dirname(__DIR__) . '/controllers/meta_descriptions.php';

// Récupération de l'URL demandée et normalisation du chemin
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = strtolower(parse_url($requestUri, PHP_URL_PATH));

// Définition de la meta-description par défaut
$defaultMetaDescription = "Bienvenue sur True Fighters Gaming.";

// Vérification si la route demandée a une meta-description spécifique définie
$metaDescription = isset($metaDescriptions[$requestPath]) ? htmlspecialchars($metaDescriptions[$requestPath]) : $defaultMetaDescription;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <meta name="keywords" content="TF, True, Fighters, Gaming, France, association, Team, Esport, Équipe">
    <link rel="stylesheet" href="/tfg/assets/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>TF - True Fighters Gaming</title>
</head>
<body> <!-- Début du corps de la page HTML -->

<main>