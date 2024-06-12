<?php

// Inclure la fonction pour récupérer les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Appel de la fonction pour récupérer la liste des membres
$members = viewMembers($bdd);
// Appeler la fonction pour récupérer les rôles depuis la base de données
$roles = getRolesFromDatabase($bdd);