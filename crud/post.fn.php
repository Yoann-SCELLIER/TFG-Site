<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';

// Fonction pour ajouter un nouveau post dans la base de données
function addPost($bdd, $titre, $contenu, $image_url, $member_id) 
{
    try {
        $sql = "INSERT INTO post (title, content, image_url, member_id, created_at, modif_at) 
                VALUES (:titre, :contenu, :image_url, :member_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':titre', htmlspecialchars($titre));
        $stmt->bindValue(':contenu', htmlspecialchars($contenu));
        $stmt->bindValue(':image_url', htmlspecialchars($image_url));
        $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        exit("Erreur lors de l'ajout du post : " . $e->getMessage());
    }
}

// Fonction pour afficher tous les posts
function viewsPost($bdd) 
{
    try {
        $sqlQuery = 'SELECT 
                        post.*, 
                        DATE_FORMAT(post.created_at, "%d-%m-%Y") as created_at_fr, 
                        DATE_FORMAT(post.modif_at, "%d-%m-%Y") as modif_at_fr,
                        member.username
                    FROM 
                        post
                    LEFT JOIN 
                        member ON post.member_id = member.member_id
                    ORDER BY 
                        post.created_at DESC';
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des posts : " . $e->getMessage());
    }
}

// Fonction pour supprimer un post de la base de données en utilisant son ID
function deletePost($bdd, $id) 
{
    try {
        $sql = "DELETE FROM post WHERE post_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        exit("Erreur lors de la suppression du post : " . $e->getMessage());
    }
}

// Fonction pour récupérer les informations d'un post spécifique en utilisant son ID
function getPostById($bdd, $id) 
{
    try {
        $sql = "SELECT post.*, 
                       post.image_url,  -- Sélection de l'URL de l'image
                       member.username, 
                       DATE_FORMAT(post.created_at, '%d-%m-%Y %H:%i:%s') as created_at_fr, 
                       DATE_FORMAT(post.modif_at, '%d-%m-%Y %H:%i:%s') as modif_at_fr 
                FROM post 
                JOIN member ON post.member_id = member.member_id 
                WHERE post.post_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération du post : " . $e->getMessage());
    }
}

// Fonction pour mettre à jour un post existant dans la base de données
function updatePost($bdd, $id, $title, $content, $image_url, $member_id = null) 
{
    try {
        $sql = "UPDATE post 
                SET title = :title, 
                    content = :content, 
                    image_url = :image_url, 
                    modif_at = CURRENT_TIMESTAMP";
        
        // Ajouter member_id uniquement s'il est fourni
        if ($member_id !== null) {
            $sql .= ", member_id = :member_id";
        }

        $sql .= " WHERE post_id = :id";

        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', htmlspecialchars($title));
        $stmt->bindValue(':content', htmlspecialchars($content));
        $stmt->bindValue(':image_url', htmlspecialchars($image_url));
        
        // Binder member_id uniquement s'il est fourni
        if ($member_id !== null) {
            $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        exit("Erreur lors de la mise à jour du post : " . $e->getMessage());
    }
}
?>
