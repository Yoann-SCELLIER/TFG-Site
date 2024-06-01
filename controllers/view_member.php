<?php

require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php'; // Modifier le chemin si nécessaire

// Appeler la fonction pour récupérer les membres
$members = viewMembers($bdd);