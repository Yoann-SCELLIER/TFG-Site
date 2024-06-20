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

<div class="d-flex justify-content-evenly p-3">
    <!-- Bouton pour ajouter une actualité -->
    <a href="/tfg/actu_formu.php" class="btn btn-primary">Ajouter une actualité</a>
</div>