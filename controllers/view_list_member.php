<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '/controller/db.fn.php';
// Inclure la fonction pour récupérer les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Appel de la fonction pour récupérer la liste des membres
$members = viewMembers($bdd);

// Inclure la vue pour afficher la liste des membres
require_once dirname(__DIR__) . '/index.php';
?>