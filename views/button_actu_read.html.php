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

<div class=" d-flex text-center justify-content-evenly">
    <!-- Bouton pour modifier l'article -->
    <div aria-label="Actions" class="text-center m-3">
        <a href="actu_formu.php?id=<?= $post['post_id'] ?>" class="btn btn-warning">Modifier l'article</a>
    </div>
    <?php if ($id) : ?>
        <!-- Form pour supprimer l'article -->
        <div aria-label="Actions" class="text-center m-3">
            <form action="/TFG/controllers/delete_post.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <button type="submit" class="btn btn-danger">Supprimer l'article</button>
            </form>
        </div>
    <?php endif; ?>
</div>
