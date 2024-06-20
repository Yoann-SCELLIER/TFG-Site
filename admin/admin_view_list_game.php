<?php
// Inclusion du header pour démarrer la structure HTML de la page
require_once dirname(__DIR__) . '\components\header.html.php';

// Vérification des droits d'administration avant de permettre l'accès à la page
require_once dirname(__DIR__) . '\controllers\verification_admin.php';

// Inclusion du contrôleur de navigation pour gérer la navigation dans l'interface d'administration
require_once dirname(__DIR__) . '\controllers\controller_nav.php';

// Vue pour afficher le formulaire de boutons d'action spécifique à l'administration
require_once dirname(__DIR__) . '\views\admin_button_form.html.php';

// Contrôleur responsable de la logique d'affichage de la liste des jeux pour l'administration
require_once dirname(__DIR__) . '/controllers/view_list_game.php';

// Vue pour afficher la table des jeux dans l'interface d'administration
require_once dirname(__DIR__) . '\views\table_games.html.php';

// Inclusion du footer spécifique à l'administration pour clore la structure de la page
require_once dirname(__DIR__) . '/components/footeradmin.html.php';
?>
