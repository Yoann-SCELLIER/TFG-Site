<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

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

// Fonction pour ajouter/modifier un jeu dans la table "game"
function addOrUpdateGame($bdd, $game_id, $cover, $title, $content, $category_id) {
    try {
        if ($game_id) {
            // Si un ID de jeu est fourni, mettez à jour le jeu existant
            $sql = "UPDATE game SET cover = :cover, title = :title, content = :content, category_id = :category_id WHERE game_id = :game_id";
        } else {
            // Sinon, ajoutez un nouveau jeu
            $sql = "INSERT INTO game (cover, title, content, category_id) VALUES (:cover, :title, :content, :category_id)";
        }

        // Préparer et exécuter la requête SQL
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':cover', $cover);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        
        // Si c'est une mise à jour, passez également l'ID du jeu
        if ($game_id) {
            $stmt->bindParam(':game_id', $game_id);
        }

        $stmt->execute();

        // Renvoyer l'ID du jeu ajouté/modifié
        return $bdd->lastInsertId();
    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        exit("Erreur lors de l'ajout/modification du jeu : " . $e->getMessage());
    }
}