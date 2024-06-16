<?php
// Récupération de l'ID pour la visualisation de l'article ciblé
$id = $_GET['id'];

// Récupération des détails de l'article avec l'ID spécifié
$post = getPostById($bdd, $id);

// Vérifier si l'article existe
if ($post) {
?>

    <div class="col p-5">
        <div class="card border-2 m-5">
            <?php if (!empty($post['image_url'])) : ?>
                <?php if (strpos($post['image_url'], 'http') === 0) : ?>
                    <img class="card-img-top p-2 align-self-center" src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="Image <?= $post['title'] ?>" style="width:50rem; height:auto">
                <?php else : ?>
                    <img class="card-img-top p-2 align-self-center" src="/TFG/<?php echo htmlspecialchars($post['image_url']); ?>" alt="Image <?= $post['title'] ?>" style="width:50rem; height:auto">
                <?php endif; ?>
            <?php else : ?>
                <img class="card-img-top p-2 align-self-center" src="/TFG/default-image.jpg" alt="Image <?= $post['title'] ?>" style="width:50rem; height:auto">
            <?php endif; ?>
            <div class="card-body text-center">
                <h5 class="card-title fs-2"><?= $post['title'] ?></h5>
            </div>
            <hr class="border border-2">
            <div class="card-body">
                <p class="card-text p-3 fs-5"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <div class="d-flex justify-content-end">
                    <p><small class="text-body-secondary"><?= $post['username'] ?></small></p>
                </div>
            </div>
            <div class="card-footer text-center">
                <p>Créé le : <small class="text-body-secondary"><?= $post['created_at'] ?></small></p>
                <?php if (!empty($post['modif_at'])) : ?>
                    <p>Modifié le : <small class="text-body-secondary"><?= $post['modif_at'] ?></small></p>
                <?php endif; ?>
            </div>
            <div class="d-flex text-center align-self-center">
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
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_view_list_actu.php" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    // Afficher un message si l'article n'existe pas
    echo "L'article demandé n'existe pas.";
}
?>