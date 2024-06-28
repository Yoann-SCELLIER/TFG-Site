<?php
// Inclusion du fichier contenant les fonctions CRUD pour les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Appel de la fonction pour récupérer la liste des membres depuis la base de données
$members = viewMembers($bdd);

// Appel de la fonction pour récupérer les rôles depuis la base de données
$roles = getRolesFromDatabase($bdd);

