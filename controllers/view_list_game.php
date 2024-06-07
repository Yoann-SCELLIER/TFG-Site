<?php
// controllers/game_controller.php

require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Appel de la fonction pour récupérer la liste des jeux
$games = view_list_game($bdd);