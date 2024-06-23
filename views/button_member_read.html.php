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
    <!-- Bouton pour modifier le membre -->
    <!-- <form action="member_form.php" method="get" style="display: inline;">
        <input type="hidden" name="id" value="<?= $member['member_id']; ?>">
        <button type="submit" class="btn btn-success">Modifier</button>
    </form> -->
    <!-- Bouton pour supprimer le membre -->
    <form action="\TFG\controllers\delete_member.php" method="post" style="display: inline;">
        <input type="hidden" name="member_id" value="<?= $member['member_id']; ?>">
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    <!-- Formulaire pour le bouton Retour à la liste -->
    <form action="index.php#staffSection" method="get" style="display: inline;">
        <button type="submit" class="btn btn-secondary">Retour à la liste</button>
    </form>
</div>