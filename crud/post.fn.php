<?php
// Inclusion du fichier de configuration de la base de données
require_once dirname(__DIR__) . '/controller/db.fn.php';

/**
 * Fonction pour ajouter un nouveau post dans la base de données
 * @param PDO $bdd Connexion PDO à la base de données
 * @param string $title Titre du post
 * @param string $content Contenu du post
 * @param string $image_url URL de l'image du post
 * @param int $member_id ID du membre ajoutant le post
 * @return mixed Retourne l'ID du post ajouté en cas de succès, sinon false
 */
function addPost($bdd, $title, $content, $image_url, $member_id)
{
    try {
        // Requête SQL pour insérer un nouveau post
        $sql = "INSERT INTO post (title, content, image_url, member_id) VALUES (:title, :content, :image_url, :member_id)";
        $stmt = $bdd->prepare($sql);
        
        // Liaison des paramètres avec les valeurs
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Retourne l'ID du dernier post inséré
        return $bdd->lastInsertId();
    } catch (PDOException $e) {
        // En cas d'erreur PDO, log l'erreur et termine le script
        error_log("Erreur lors de l'ajout du post : " . $e->getMessage());
        return false;
    }
}

/**
 * Fonction pour récupérer tous les posts avec informations formatées depuis la base de données
 *
 * @param PDO $bdd Connexion PDO à la base de données
 * @return array Tableau associatif contenant tous les posts avec informations formatées
 */
function viewsPost($bdd) 
{
    try {
        // Requête SQL pour récupérer tous les posts avec informations formatées
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
        
        // Retourne tous les posts sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur PDO, affiche l'erreur et termine le script
        exit("Erreur lors de la récupération des posts : " . $e->getMessage());
    }
}

/**
 * Supprime un post de la base de données.
 *
 * @param PDO $bdd La connexion PDO à la base de données.
 * @param int $post_id L'ID du post à supprimer.
 * @param int $member_id L'ID du membre effectuant la suppression.
 * @param string $role_member Le rôle du membre effectuant la suppression.
 * @return bool True si la suppression a réussi, False sinon.
 */
function deletePost($bdd, $post_id, $member_id, $role_member)
{
    try {
        // Déterminer la requête SQL en fonction du rôle du membre
        if ($role_member === 'memberAdmin') {
            // Administrateur : supprime le post sans vérifier le propriétaire
            $sql = "DELETE FROM post WHERE post_id = :post_id";
        } else {
            // Membre non administrateur : vérifie si le post appartient au membre avant de le supprimer
            $sql = "DELETE FROM post WHERE post_id = :post_id AND member_id = :member_id";
        }

        $stmt = $bdd->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        if ($role_member !== 'memberAdmin') {
            $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        }

        // Exécuter la requête
        $stmt->execute();

        // Vérifier si des lignes ont été affectées (post supprimé)
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        // Enregistrer l'erreur dans les logs et afficher un message d'erreur
        error_log("Erreur SQL lors de la suppression du post : " . $e->getMessage());
        echo "<script>alert('Erreur SQL lors de la suppression du post.'); window.history.back();</script>";
        exit();
    }
}

/**
 * Fonction pour récupérer les informations d'un post par son ID
 * @param PDO $bdd Connexion PDO à la base de données
 * @param int $id ID du post à récupérer
 * @return mixed Retourne les informations du post sous forme de tableau associatif, ou false si non trouvé
 */
function getPostById($bdd, $id)
{
    try {
        // Requête SQL pour récupérer les détails d'un post avec le nom d'utilisateur du membre
        $sql = "SELECT p.*, m.username, DATE_FORMAT(p.created_at, '%d-%m-%Y') AS created_at_fr, DATE_FORMAT(p.modif_at, '%d-%m-%Y') AS modif_at_fr
                FROM post p
                LEFT JOIN member m ON p.member_id = m.member_id
                WHERE p.post_id = :id";
        
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Retourne les informations du post sous forme de tableau associatif
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur PDO, affiche l'erreur et termine le script
        exit("Erreur lors de la récupération du post : " . $e->getMessage());
    }
}

/**
 * Fonction pour mettre à jour un post dans la base de données
 * @param PDO $bdd Connexion PDO à la base de données
 * @param int $id ID du post à mettre à jour
 * @param string $title Nouveau titre du post
 * @param string $content Nouveau contenu du post
 * @param string $image_url Nouvelle URL de l'image du post
 * @param int $member_id ID du membre effectuant l'action
 * @return bool Retourne true si la mise à jour est réussie, sinon false
 */
function updatePost($bdd, $id, $title, $content, $image_url, $member_id)
{
    try {
        // Requête SQL pour mettre à jour un post
        $sql = "UPDATE post SET title = :title, content = :content, image_url = :image_url, modif_at = NOW() WHERE post_id = :id";
        
        // Vérifie si l'utilisateur n'est pas administrateur pour restreindre la mise à jour
        if (isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
            $sql .= " AND member_id = :member_id";
        }

        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Si l'utilisateur n'est pas administrateur, bind son member_id pour la vérification
        if (isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
            $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        }

        // Exécute la requête SQL
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        // En cas d'erreur PDO, log l'erreur et termine le script
        error_log("Erreur lors de la mise à jour du post : " . $e->getMessage());
        return false;
    }
}

/**
 * @param PDO $bdd Connexion PDO à la base de données
 * @return array Tableau associatif contenant tous les posts sans aucune jointure ou formatage supplémentaire
 */
function getAllPosts($bdd)
{
    try {
        // Requête SQL pour récupérer tous les posts sans aucune jointure ou formatage supplémentaire
        $sql = "SELECT * FROM post";
        $stmt = $bdd->query($sql);
        
        // Retourne tous les posts sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur PDO, affiche l'erreur et termine le script
        exit("Erreur lors de la récupération des posts : " . $e->getMessage());
    }
}
