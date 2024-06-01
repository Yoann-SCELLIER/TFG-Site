<?php 

function addActualite($bdd) {
    // Récupération des informations saisies dans le formulaire d'ajout d'actualité

    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $lien_image = $_POST['lien_image']; // Champ supplémentaire pour le lien de l'image

    // Préparation des données à insérer dans la base de données
    $donnees = [
        $titre,
        $contenu,
        $lien_image,
    ];

    // Requête SQL pour insérer les données dans la table des actualités
    $sql = "INSERT INTO post (titre, contenu, lien_image) VALUES (?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute($donnees);
}