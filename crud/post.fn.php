<?php

//--------------------------------------------------------------------------------------------------------------------------------------

// Fonction pour ajouter un nouveau post dans la base de données
function addPost($bdd, $titre, $contenu, $image_url) {
    $sql = "INSERT INTO post (title, content, image_url) VALUES (:titre, :contenu, :image_url)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':contenu', $contenu);
    $stmt->bindValue(':image_url', $image_url);
    $stmt->execute();
}

//--------------------------------------------------------------------------------------------------------------------------------------

// Fonction pour récupérer tous les posts de la base de données
function viewPost($bdd) {
    $sqlQuery = 'SELECT * FROM post';
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

//--------------------------------------------------------------------------------------------------------------------------------------

// Fonction pour supprimer un post de la base de données en utilisant son ID
function deletePost($bdd) {
    try {
        $id = $_GET['id'];
        $sql = "DELETE FROM `post` WHERE `post_id` = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        // Gérer les erreurs, éventuellement les enregistrer ou afficher un message convivial à l'utilisateur
        echo "Erreur : " . $e->getMessage();
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------

// Fonction pour récupérer les informations d'un post spécifique en utilisant son ID
function getPostById($bdd, $id) {
    $sql = "SELECT * FROM post WHERE post_id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//--------------------------------------------------------------------------------------------------------------------------------------

// Fonction pour mettre à jour les informations d'un post dans la base de données
function updatePost($bdd, $id, $titre, $contenu, $image_url) {
    $sql = "UPDATE post SET title = :titre, content = :contenu, image_url = :image_url WHERE post_id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':contenu', $contenu);
    $stmt->bindValue(':image_url', $image_url);
    $stmt->execute();
}
