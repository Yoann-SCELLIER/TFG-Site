<?php

// Inclusion du header
require_once dirname(__DIR__) . '\tfg\components\header.html.php';

// Inclusion du contrôleur de navigation
require_once dirname(__DIR__) . '\tfg\controllers\controller_nav.php';

// Inclusion du contrôleur pour afficher le formulaire d'actualité
require_once dirname(__DIR__) . '\tfg\controllers\view_actu.php';

// Inclusion du gestionnaire de formulaire d'actualité
require_once dirname(__DIR__) . '\tfg\controllers\post_form_handler.php';

// Inclusion de la vue du formulaire d'actualité
require_once dirname(__DIR__) . '\tfg\views\actu_form.html.php';

// Inclusion de la vue des conditions
require_once dirname(__DIR__) . '\tfg\views\condition.html.php';

// Inclusion du footer
require_once dirname(__DIR__) . '\tfg\components\footer.html.php';

?>
