<?php
// Inclusion du header pour démarrer la structure HTML de la page
require_once dirname(__DIR__) . '\components\header.html.php';

// Vérification des droits d'administration avant de permettre l'accès à la page
require_once dirname(__DIR__) . '\controllers\verification_admin.php';

// Inclusion du contrôleur de navigation pour gérer la navigation dans l'interface d'administration
require_once dirname(__DIR__) . '\controllers\controller_nav.php';

// Contrôleur responsable du formulaire d'administration des jeux
require_once dirname(__DIR__) . '\controllers\admin_form_game.php';

// Vue du formulaire d'administration des jeux
require_once dirname(__DIR__) . '\views\admin_formu_game.html.php';

// Inclusion du footer spécifique à l'administration pour clore la structure de la page
require_once dirname(__DIR__) . '/components/footeradmin.html.php';
?>
