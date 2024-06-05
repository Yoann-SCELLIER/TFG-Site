<?php

// Fonction pour récupérer la liste des consoles depuis la base de données
function listConsoles($bdd) {
    $sqlQuery = 'SELECT * FROM console';
    $stmt = $bdd->query($sqlQuery);
    $consoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $consoles;
}

// Fonction pour récupérer les consoles sélectionnées pour un membre spécifique
function getMemberConsoles($bdd, $member_id) {
    $sqlQuery = '
        SELECT console.*
        FROM console
        INNER JOIN member_game ON console.console_id = member_game.console_id
        WHERE member_game.member_id = :member_id
    ';
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
