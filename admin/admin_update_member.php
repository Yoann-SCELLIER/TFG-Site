<?php
// Inclusion du header pour démarrer la structure HTML de la page
require_once dirname(__DIR__) . '\components\header.html.php';

// Vérification des droits d'administration avant de permettre l'accès à la page
require_once dirname(__DIR__) . '\controllers\verification_admin.php';

// Inclusion du contrôleur de navigation pour gérer la navigation dans l'interface d'administration
require_once dirname(__DIR__) . '\controllers\controller_nav.php';

// Contrôleur responsable de la logique de mise à jour des membres administratifs
require_once dirname(__DIR__) . '/controllers/admin_update_member.php';

// Contrôleur de gestion des départements (utilisé dans la vue du formulaire de membre)
require_once dirname(__DIR__) . '/controllers/controller_departement.php';

// Contrôleur pour récupérer la liste des emplois (utilisé dans la vue du formulaire de membre)
require_once dirname(__DIR__) . '/controllers/view_list_job.php';

// Contrôleur pour récupérer la liste des jeux (utilisé dans la vue du formulaire de membre)
require_once dirname(__DIR__) . '/controllers/view_list_game.php';

// Contrôleur responsable de la logique de mise à jour des emplois d'un membre
require_once dirname(__DIR__) . '/controllers/update_member_job.php';

// Vue du formulaire de mise à jour des membres administratifs
require_once dirname(__DIR__) . '\views\admin_member_form.html.php';

// Inclusion du footer spécifique à l'administration pour clore la structure de la page
require_once dirname(__DIR__) . '/components/footeradmin.html.php';
?>
