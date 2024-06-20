<?php

// Inclusion du header
require_once dirname(__DIR__) . '\tfg\components\header.html.php';

// Inclusion du contrôleur de navigation
require_once dirname(__DIR__) . '\tfg\controllers\controller_nav.php';

// Inclusion du contrôleur pour afficher l'actualité
require_once dirname(__DIR__) . '\tfg\controllers\view_actu.php';

// Inclusion de la vue pour lire l'actualité
require_once dirname(__DIR__) . '\tfg\views\actu_read.html.php';

// Inclusion du contrôleur pour les boutons de carte d'actualité
require_once dirname(__DIR__) . '\tfg\controllers\controller_button_card_actu.php';

// Inclusion de la vue du formulaire
require_once dirname(__DIR__) . '\tfg\views\formulaire.html.php';

// Inclusion de la vue des conditions
require_once dirname(__DIR__) . '\tfg\views\condition.html.php';

// Inclusion du footer
require_once dirname(__DIR__) . '\tfg\components\footer.html.php';

?>
