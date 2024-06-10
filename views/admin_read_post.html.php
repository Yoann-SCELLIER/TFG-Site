<?php

// Récupération de l'ID pour la modification de la signature ciblée
$id = $_GET['id'];

// Récupération de la vue de l'article avec l'ID spécifié
$post = getPostById($bdd, $id);

// Vérifier si l'article existe
if ($post) { 
?>

<div class="col p-5">
    <div class="card border-2 m-5">
        <img src="<?= $post['image_url'] ?>" class="card-img-top p-5" alt="Image <?= $post['title'] ?>">
        <div class="card-body text-center">
            <h5 class="card-title"><?= $post['title'] ?></h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?= $post['content'] ?></p>
        </div>
        <div class="card-footer text-center">
            <p>Créé le : <small class="text-body-secondary"><?= $post['created_at'] ?></small></p>
            <?php if (!empty($post['modif_at'])) : ?>
                <p>Modifié le : <small class="text-body-secondary"><?= $post['modif_at'] ?></small></p>
            <?php endif; ?>
        </div>
        <div aria-label="Actions" class="text-center m-3">
            <a href="/TFG/admin/admin_form_actu.php?id=<?= $post['post_id'] ?>" class="btn btn-warning">Modifier l'article</a>
        </div>
        <?php if ($id) : ?>
            <div aria-label="Actions" class="text-center m-3">
                <form action="/TFG/controllers/delete_post.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <button type="submit" class="btn btn-danger">Supprimer l'article</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
} else {
    // Afficher un message si l'article n'existe pas
    echo "L'article demandé n'existe pas.";
}
?>