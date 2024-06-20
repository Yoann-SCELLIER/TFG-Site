<?php

// Démarrer la session PHP
session_start();

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Redirection vers la page d'accueil après la déconnexion
header('Location: /TFG/index.php');
exit();
?>
