<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

function addGame($bdd, $title, $content, $image_url) {
    try {
        $sql = "INSERT INTO game (title, content, image_url) VALUES (:title, :content, :image_url)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'ajout du jeu : " . $e->getMessage());
    }
}

function updateGame($bdd, $id, $title, $content, $image_url) {
    try {
        $sql = "UPDATE game SET title = :title, content = :content, image_url = :image_url WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la mise à jour du jeu : " . $e->getMessage());
    }
}

function deleteGame($bdd, $id) {
    try {
        $sql = "DELETE FROM game WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la suppression du jeu : " . $e->getMessage());
    }
}

function getGameById($bdd, $id) {
    try {
        $sql = "SELECT * FROM game WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la récupération du jeu : " . $e->getMessage());
    }
}

function view_list_game($bdd) {
    try {
        $sql = "SELECT * FROM game";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la récupération de la liste des jeux : " . $e->getMessage());
    }
}
