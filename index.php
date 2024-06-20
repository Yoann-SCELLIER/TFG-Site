<?php

// Inclusion du header
require_once dirname(__DIR__) . '\TFG\components\header.html.php';

// Inclusion du contrôleur de navigation
require_once dirname(__DIR__) . '\tfg\controllers\controller_nav.php';

// Inclusion du contrôleur pour afficher la liste des membres
require_once dirname(__DIR__) . '\TFG\controllers\view_list_member.php';

// Inclusion du contrôleur pour afficher la liste des jeux
require_once dirname(__DIR__) . '\TFG\controllers\view_list_game.php';

// Inclusion de la bannière pour la page d'accueil
require_once dirname(__DIR__) . '\TFG\components\banniere_index.html.php';

// Inclusion de la vue pour afficher l'histoire (story)
require_once dirname(__DIR__) . '\TFG\views\story.html.php';

// Inclusion de la vue pour afficher le personnel (staff)
require_once dirname(__DIR__) . '\TFG\views\staff.html.php';

// Inclusion de la vue pour afficher le gaming
require_once dirname(__DIR__) . '\TFG\views\gaming.html.php';

// Inclusion de la vue du formulaire
require_once dirname(__DIR__) . '\TFG\views\formulaire.html.php';

// Inclusion de la vue des conditions
require_once dirname(__DIR__) . '\TFG\views\condition.html.php';

// Inclusion du footer
require_once dirname(__DIR__) . '\TFG\components\footer.html.php';

?>
