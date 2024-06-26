<?php
// Vérifier si $member_id est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
} else {
    // Gérer le cas où $member_id n'est pas défini
    // Vous pouvez rediriger l'utilisateur vers une page de connexion ou afficher un message d'erreur
    header('Location: /TFG/404.php');
}
?>

<div class="container text-center p-2">
    <!-- Conteneur principal avec une marge interne de 3 -->
    <div class="row d-flex justify-content-evenly">
        <!-- Ligne avec des colonnes justifiées de manière équitable -->
        <div class="col-3">
            <!-- Colonne de largeur 3/12 (pour les petits écrans) -->
            <a href="/tfg/admin/admin_form_actu.php" class="btn bg-warning text-dark fw-bold">Formulaire actualité</a>
            <!-- Bouton pour accéder au formulaire d'actualité -->
        </div>
        <div class="col-3">
            <!-- Deuxième colonne de largeur 3/12 (pour les petits écrans) -->
            <a href="/tfg/admin/admin_form_game.php" class="btn bg-success text-dark fw-bold">Formulaire game</a>
            <!-- Bouton pour accéder au formulaire de jeu -->
        </div>
    </div>
</div>
