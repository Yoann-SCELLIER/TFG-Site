<?php
// Inclusion du header pour démarrer la structure HTML de la page
require_once dirname(__DIR__) . '\components\header.html.php';

// Vérification des droits d'administration avant de permettre l'accès à la page
require_once dirname(__DIR__) . '\controllers\verification_admin.php';

// Inclusion du contrôleur de navigation pour gérer la navigation dans l'interface d'administration
require_once dirname(__DIR__) . '\controllers\controller_nav.php';

// Contrôleur responsable de la logique d'affichage des détails d'un membre pour l'administration
require_once dirname(__DIR__) . '/controllers/view_member.php';

// Contrôleur responsable de la logique d'affichage des consoles pour l'administration
require_once dirname(__DIR__) . '/controllers/view_console.php';

// Vue pour afficher les détails d'un membre dans l'interface d'administration
require_once dirname(__DIR__) . '/views/admin_view_member.html.php'; 

// Inclusion du footer spécifique à l'administration pour clore la structure de la page
require_once dirname(__DIR__) . '/components/footeradmin.html.php';
?>
