<?php

// Inclure le fichier contenant la fonction pour récupérer les départements, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '\crud\member.fn.php'; 

// Appeler la fonction pour récupérer les départements depuis la base de données en utilisant la connexion $bdd
$departements = getDepartements($bdd);

?>
