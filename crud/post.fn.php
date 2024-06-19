<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';

// Fonction pour ajouter un nouveau post dans la base de données
function addPost($bdd, $title, $content, $image_url, $member_id)
{
    try {
        $sql = "INSERT INTO post (title, content, image_url, member_id) VALUES (:title, :content, :image_url, :member_id)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();
        return $bdd->lastInsertId();
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
function deletePost($bdd, $post_id, $member_id, $role_member)
{
    try {
        // Vérifier si l'utilisateur est administrateur ou propriétaire du post
        $sql = "";
        if ($role_member === 'memberAdmin') {
            // Administrateur : supprime sans vérifier le propriétaire
            $sql = "DELETE FROM post WHERE post_id = :post_id";
            $stmt = $bdd->prepare($sql); 
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        } else {
            // Vérifier si le post appartient à ce membre
            $sql = "DELETE FROM post WHERE post_id = :post_id AND member_id = :member_id";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        }

        $stmt->execute();

        // Vérifier si des lignes ont été affectées (post supprimé)
        if ($stmt->rowCount() > 0) {
            return true; // Suppression réussie
        } else {
            return false; // Aucune ligne n'a été supprimée (conditions non remplies)
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL lors de la suppression du post : " . $e->getMessage());
        exit("Erreur SQL lors de la suppression du post : " . $e->getMessage());
    }
}

// Fonction pour récupérer les informations d'un post spécifique en utilisant son ID
function getPostById($bdd, $id)
{
    try {
        $sql = "SELECT p.*, m.username, DATE_FORMAT(p.created_at, '%d-%m-%Y') AS created_at_fr, DATE_FORMAT(p.modif_at, '%d-%m-%Y') AS modif_at_fr
                FROM post p
                LEFT JOIN member m ON p.member_id = m.member_id
                WHERE p.post_id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération du post : " . $e->getMessage());
    }
}

// Fonction pour mettre à jour un post existant dans la base de données
function updatePost($bdd, $id, $title, $content, $image_url, $member_id)
{
    try {
        $sql = "UPDATE post SET title = :title, content = :content, image_url = :image_url WHERE post_id = :id";
        
        // Si l'utilisateur n'est pas administrateur, restreindre à son member_id
        if (isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
            $sql .= " AND member_id = :member_id";
        }

        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Si l'utilisateur n'est pas administrateur, binder son member_id
        if (isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
            $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        }

        $stmt->execute();
    } catch (PDOException $e) {
        exit("Erreur lors de la mise à jour du post : " . $e->getMessage());
    }
}

function getAllPosts($bdd)
{
    try {
        $sql = "SELECT * FROM post";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des posts : " . $e->getMessage());
    }
}