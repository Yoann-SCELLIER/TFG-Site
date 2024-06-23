<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

/**
 * Fonction pour récupérer la liste des consoles depuis la base de données.
 * @param PDO $bdd Connexion PDO à la base de données.
 * @return array Tableau associatif des consoles avec leurs détails.
 */
function listConsoles($bdd) 
{
    $sqlQuery = 'SELECT * FROM console';
    $stmt = $bdd->query($sqlQuery);
    $consoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $consoles;
}

/**
 * Fonction pour ajouter ou mettre à jour un jeu dans la table "game".
 * @param PDO $bdd Connexion PDO à la base de données.
 * @param int|null $game_id ID du jeu à mettre à jour (null pour ajouter un nouveau jeu).
 * @param string $cover Chemin de l'image de couverture du jeu.
 * @param string $title Titre du jeu.
 * @param string $content Description du jeu.
 * @param int $category_id ID de la catégorie du jeu.
 * @return int|null ID du jeu ajouté ou modifié, null en cas d'échec.
 */
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

        // Renvoyer l'ID du jeu ajouté ou modifié
        return $bdd->lastInsertId();
    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        exit("Erreur lors de l'ajout/modification du jeu : " . $e->getMessage());
    }
}

/**
 * Fonction pour récupérer la liste complète des jeux depuis la table "game".
 * @param PDO $bdd Connexion PDO à la base de données.
 * @return array Tableau associatif des jeux avec leurs détails.
 */
function view_list_game($bdd) 
{
    $sql = "SELECT * FROM game";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fonction pour récupérer les détails d'un jeu par son ID depuis la base de données.
 *
 * @param PDO $bdd Connexion PDO à la base de données.
 * @param int $id ID du jeu à récupérer.
 * @return mixed Tableau associatif contenant les détails du jeu, ou null si non trouvé.
 */
function getGameById($bdd, $id)
{
    try {
        $sql = "SELECT * FROM game WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return null;
    }
}

/**
 * Fonction pour ajouter un nouveau jeu dans la table "game".
 *
 * @param PDO $bdd Connexion PDO à la base de données.
 * @param string $title Titre du nouveau jeu.
 * @param string $content Description du nouveau jeu.
 * @param string $image_url URL de l'image associée au nouveau jeu.
 */
function addGame($bdd, $title, $content, $image_url)
{
    try {
        $sql = "INSERT INTO game (title, content, image_url) VALUES (:title, :content, :image_url)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

/**
 * Fonction pour mettre à jour les détails d'un jeu dans la table "game".
 *
 * @param PDO $bdd Connexion PDO à la base de données.
 * @param int $id ID du jeu à mettre à jour.
 * @param string $title Nouveau titre du jeu.
 * @param string $content Nouvelle description du jeu.
 * @param string $image_url Nouvelle URL de l'image associée au jeu.
 */
function updateGame($bdd, $id, $title, $content, $image_url) 
{
    try {
        $sql = "UPDATE game SET title = :title, content = :content, image_url = :image_url WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

/**
 * Fonction pour supprimer un jeu de la table "game".
 * @param PDO $bdd Connexion PDO à la base de données.
 * @param int $id ID du jeu à supprimer.
 */
function deleteGame($bdd, $id) 
{
    try {
        // Vérifier si l'ID est un entier positif
        if (!is_int($id) || $id <= 0) {
            throw new InvalidArgumentException("L'ID du jeu n'est pas valide.");
        }

        $sql = "DELETE FROM game WHERE game_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        // Enregistrer l'erreur dans le journal des erreurs
        error_log("Erreur lors de la suppression du jeu : " . $e->getMessage());
        // Afficher un message d'erreur générique à l'utilisateur
        echo "Erreur lors de la suppression du jeu.";
    } catch (InvalidArgumentException $e) {
        // Enregistrer l'erreur dans le journal des erreurs
        error_log("Erreur lors de la suppression du jeu : " . $e->getMessage());
        // Afficher un message d'erreur spécifique à l'utilisateur
        echo $e->getMessage();
    }
}

/**
 * Fonction pour récupérer les jeux associés à un membre spécifique.
 * @param PDO $bdd Connexion PDO à la base de données.
 * @param int $member_id ID du membre pour lequel récupérer les jeux.
 * @return array Tableau associatif des jeux associés au membre.
 */
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

/**
 * Fonction pour mettre à jour les jeux sélectionnés d'un membre dans la base de données
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param int $member_id ID du membre à mettre à jour
 * @param array $games_selected Tableau des IDs des jeux sélectionnés
 */
function updateMemberGames($bdd, $member_id, $games_selected)
{
    try {
        // Suppression des jeux actuels du membre
        $sqlDelete = "DELETE FROM member_game WHERE member_id = :member_id";
        $stmtDelete = $bdd->prepare($sqlDelete);
        $stmtDelete->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $stmtDelete->execute();

        // Insertion des nouveaux jeux sélectionnés
        $sqlInsert = "INSERT INTO member_game (member_id, game_id) VALUES (:member_id, :game_id)";
        $stmtInsert = $bdd->prepare($sqlInsert);
        $stmtInsert->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        
        foreach ($games_selected as $game_id) {
            $stmtInsert->bindParam(':game_id', $game_id, PDO::PARAM_INT);
            $stmtInsert->execute();
        }
    } catch (PDOException $e) {
        // En cas d'erreur PDO, throw pour annuler la transaction
        throw new PDOException("Erreur lors de la mise à jour des jeux du membre : " . $e->getMessage());
    }
}
