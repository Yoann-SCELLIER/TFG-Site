<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';

// Fonction pour ajouter un nouveau post dans la base de données
function addPost($bdd, $title, $content)
{
    try {
        $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
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
function deletePost($bdd, $id)
{
    try {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit("Erreur lors de la suppression du post : " . $e->getMessage());
    }
}

// Fonction pour récupérer les informations d'un post spécifique en utilisant son ID
function getPostById($bdd, $id)
{
    try {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération du post : " . $e->getMessage());
    }
}


// Fonction pour mettre à jour un post existant dans la base de données
function updatePost($bdd, $id, $title, $content)
{
    try {
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit("Erreur lors de la mise à jour du post : " . $e->getMessage());
    }
}

function getAllPosts($bdd)
{
    try {
        $sql = "SELECT * FROM posts";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des posts : " . $e->getMessage());
    }
}