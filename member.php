<?php

// Inclusion du header
require_once dirname(__DIR__) . '/TFG/components/header.html.php';

// Inclusion du contrôleur de navigation
require_once dirname(__DIR__) . '\tfg\controllers\controller_nav.php';

// Inclusion du contrôleur pour la vue du membre
require_once dirname(__DIR__) . '/TFG/controllers/view_member.php';

// Inclusion du contrôleur pour la vue du jeu
require_once dirname(__DIR__) . '/TFG/controllers/view_game.php';

// Inclusion de la vue détaillée du membre
require_once dirname(__DIR__) . '/TFG/views/member_detail.html.php';

// Inclusion du contrôleur pour le bouton de carte de membre
require_once dirname(__DIR__) . '\TFG\controllers\controller_button_card_member.php';

// Inclusion de la vue du formulaire général
require_once dirname(__DIR__) . '\TFG\views\formulaire.html.php';

// Inclusion des conditions (placez-les avant le footer)
require_once dirname(__DIR__) . '\TFG\views\condition.html.php';

// Inclusion du footer
require_once dirname(__DIR__) . '\TFG\components\footer.html.php';

?>