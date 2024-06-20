<?php
// Inclure le fichier contenant les fonctions CRUD pour les consoles de jeu
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Récupérer l'ID du membre depuis les paramètres GET, le convertir en entier
$member_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Initialisation des variables
$consoles = [];
$hasConsoles = false;

// Vérifier si l'ID du membre est spécifié et valide
if ($member_id) {
    // Appeler la fonction pour récupérer les consoles de jeu sélectionnées pour le membre
    $consoles = getMemberConsoles($bdd, $member_id);

    // Vérifier si le membre a des consoles de jeu associées
    $hasConsoles = !empty($consoles);
} else {
    // Si l'ID du membre n'est pas spécifié ou invalide, définir $consoles comme un tableau vide et $hasConsoles à false
    $consoles = [];
    $hasConsoles = false;
}

// À ce stade, $consoles contient les données des consoles de jeu sélectionnées pour le membre (ou un tableau vide si aucune console n'est associée)
// $hasConsoles est un booléen qui indique si le membre a des consoles de jeu associées ou non

// Le reste du code pour afficher les consoles ou effectuer d'autres traitements devrait suivre ici
?>
