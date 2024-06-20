<?php
// Inclusion du header pour démarrer la structure HTML de la page
require_once dirname(__DIR__) . '\components\header.html.php';

// Vérification des droits d'administration avant de permettre l'accès au tableau de bord
require_once dirname(__DIR__) . '\controllers\verification_admin.php';

// Inclusion du contrôleur de navigation pour gérer la navigation dans l'interface d'administration
require_once dirname(__DIR__) . '\controllers\controller_nav.php';

// Vue contenant les boutons d'action pour les formulaires dans l'interface d'administration
require_once dirname(__DIR__) . '\views\admin_button_form.html.php';

// Contrôleur responsable de l'affichage de la liste des membres pour l'administration
require_once dirname(__DIR__) . '/controllers/view_list_member.php';

// Vue pour afficher le tableau des membres dans l'interface d'administration
require_once dirname(__DIR__) . '\views\table_members.html.php';

// Inclusion du footer spécifique à l'administration pour clore la structure de la page
require_once dirname(__DIR__) . '/components/footeradmin.html.php';
?>