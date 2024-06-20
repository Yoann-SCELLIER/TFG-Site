<?php
// Inclusion du fichier contenant les fonctions CRUD pour les jeux
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Appel de la fonction pour récupérer la liste des jeux depuis la base de données
$games = view_list_game($bdd);
