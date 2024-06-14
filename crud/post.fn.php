<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';

// Fonction pour ajouter un nouveau post dans la base de données
function addPost($bdd, $titre, $contenu, $image_url, $member_id) {
    try {
        $sql = "INSERT INTO post (title, content, image_url, member_id) VALUES (:titre, :contenu, :image_url, :member_id)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':contenu', $contenu);
        $stmt->bindValue(':image_url', $image_url);
        $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit("Erreur lors de l'ajout du post: " . $e->getMessage());
    }
}

function viewsPost($bdd) 
{
    $sqlQuery = 'SELECT *, DATE_FORMAT(created_at, "%d-%m-%Y") as created_at, DATE_FORMAT(modif_at, "%d-%m-%Y") as modif_at FROM post ORDER BY created_at DESC';
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

// Fonction pour supprimer un post de la base de données en utilisant son ID
function deletePost($bdd, $id) 
{
    try {
        $sql = "DELETE FROM `post` WHERE `post_id` = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Fonction pour récupérer les informations d'un post spécifique en utilisant son ID
function getPostById($bdd, $id) 
{
    $sql = "SELECT post.*, 
                   member.username, 
                   DATE_FORMAT(post.created_at, '%d-%m-%Y %H:%i:%s') as created_at_fr, 
                   DATE_FORMAT(post.modif_at, '%d-%m-%Y %H:%i:%s') as modif_at_fr 
            FROM post 
            JOIN member ON post.member_id = member.member_id 
            WHERE post_id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Fonction pour mettre à jour un post existant dans la base de données
function updatePost($bdd, $id, $title, $content, $image_url, $member_id = null) 
{
    try {
        $sql = "UPDATE post SET title = :title, content = :content, image_url = :image_url";
        // Ajouter member_id uniquement s'il est fourni
        if ($member_id !== null) {
            $sql .= ", member_id = :member_id";
        }
        $sql .= ", modif_at = CURRENT_TIMESTAMP WHERE post_id = :id";
        
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image_url', $image_url);
        // Binder member_id uniquement s'il est fourni
        if ($member_id !== null) {
            $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        }
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du post : " . $e->getMessage();
    }
}
