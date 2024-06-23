<?php
// Inclusion du header
require_once dirname(__DIR__) . '\TFG\components\header.html.php';

// Inclusion du contrôleur de navigation
require_once dirname(__DIR__) . '\tfg\controllers\controller_nav.php';

// Inclusion du contrôleur pour la mise à jour du membre
require_once dirname(__DIR__) . '\TFG\controllers\view_member.php';

// Inclusion du contrôleur pour la liste des jeux
require_once dirname(__DIR__) . '\TFG\controllers\view_list_game.php';

// Inclusion du contrôleur pour la liste des métiers
require_once dirname(__DIR__) . '\TFG\controllers\view_list_job.php';

// Inclusion du contrôleur pour les départements
require_once dirname(__DIR__) . '\TFG\controllers\controller_departement.php';

// Inclusion du formulaire de membre
require_once dirname(__DIR__) . '\TFG\views\member_form.html.php';

// Inclusion de la vue du formulaire général
require_once dirname(__DIR__) . '\TFG\views\formulaire.html.php';

// Inclusion des conditions (placez-les avant le footer)
require_once dirname(__DIR__) . '\TFG\views\condition.html.php';

// Inclusion du footer
require_once dirname(__DIR__) . '\TFG\components\footer.html.php'; 

?>
