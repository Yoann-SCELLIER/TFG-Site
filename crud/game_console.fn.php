<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

// Fonction pour récupérer la liste des consoles depuis la base de données
function listConsoles($bdd) 
{
    $sqlQuery = 'SELECT * FROM console';
    $stmt = $bdd->query($sqlQuery);
    $consoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $consoles;
}

// Fonction pour récupérer les consoles sélectionnées pour un membre spécifique
function getMemberConsoles($bdd, $member_id)
{
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
function addOrUpdateGame($bdd, $game_id, $cover, $title, $content, $category_id) 
{
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

function view_list_game($bdd) 
{
    $sql = "SELECT * FROM game";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGameById($bdd, $id) 
{
    try {
        // Prépare la requête SQL pour récupérer un jeu par son ID
        $stmt = $bdd->prepare("SELECT * FROM game WHERE game_id = :id");
        // Exécute la requête en liant le paramètre ID
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Récupère le jeu sous forme de tableau associatif
        $game = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retourne le jeu s'il est trouvé, sinon null
        return $game ? $game : null;
    } catch (PDOException $e) {
        // Gérer les erreurs potentielles
        echo "Erreur: " . $e->getMessage();
        return null;
    }
}

function addGame($bdd, $title, $content, $image_url) 
{
    try {
        $sql = "INSERT INTO game (title, content, image_url) VALUES (:title, :content, :image_url)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function updateGame($bdd, $id, $title, $content, $image_url) 
{
    try {
        $sql = "UPDATE game SET title = :title, content = :content, image_url = :image_url WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function deleteGame($bdd, $id) 
{
    try {
        $sql = "DELETE FROM game WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function getMemberGames($bdd, $member_id)
{
    try {
        $sqlQuery = '
            SELECT game.*
            FROM game
            INNER JOIN member_game ON game.game_id = member_game.game_id
            WHERE member_game.member_id = :member_id
        ';
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des jeux du membre : " . $e->getMessage());
    }
}

function updateMemberGames($bdd, $member_id, $games_selected) 
{
    try {
        // Supprimer les anciennes associations de jeux pour ce membre
        $stmtDelete = $bdd->prepare("DELETE FROM member_game WHERE member_id = ?");
        $stmtDelete->execute([$member_id]);

        // Insérer les nouvelles associations de jeux sélectionnés
        $stmtInsert = $bdd->prepare("INSERT INTO member_game (member_id, game_id) VALUES (?, ?)");
        foreach ($games_selected as $game_id) {
            // Vérifier si l'association existe déjà
            $stmtCheck = $bdd->prepare("SELECT COUNT(*) AS count FROM member_game WHERE member_id = ? AND game_id = ?");
            $stmtCheck->execute([$member_id, $game_id]);
            $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                // Insérer seulement si l'association n'existe pas déjà
                $stmtInsert->execute([$member_id, $game_id]);
            }
        }
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la mise à jour des jeux du membre : " . $e->getMessage());
    }
}