<?php
// Inclure le fichier de fonctions pour gérer les opérations CRUD des articles
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Récupération de l'ID pour la visualisation du post ciblé
$id = $_GET['id'];

// Récupération des détails du post avec l'ID spécifié
$post = getPostById($bdd, $id);

// Vérifier si le post existe
if ($post) {
?>
    <div class="col p-5">
        <div class="card border-2 m-5">
            <?php if (!empty($post['image_url'])) : ?>
                <?php if (strpos($post['image_url'], 'http') === 0) : ?>
                    <!-- Afficher l'image à partir d'une URL externe -->
                    <img class="card-img-top p-2 align-self-center" src="<?= htmlspecialchars($post['image_url']); ?>" alt="Image <?= htmlspecialchars($post['title']) ?>" style="width:50rem; height:auto">
                <?php else : ?>
                    <!-- Afficher l'image à partir d'une URL relative -->
                    <img class="card-img-top p-2 align-self-center" src="/TFG/<?= htmlspecialchars($post['image_url']); ?>" alt="Image <?= htmlspecialchars($post['title']) ?>" style="width:50rem; height:auto">
                <?php endif; ?>
            <?php else : ?>
                <!-- Afficher une image par défaut si aucune image n'est définie -->
                <img class="card-img-top p-2 align-self-center" src="/TFG/default-image.jpg" alt="Image <?= htmlspecialchars($post['title']) ?>" style="width:50rem; height:auto">
            <?php endif; ?>
            <div class="card-body text-center">
                <!-- Afficher le titre de l'article -->
                <h5 class="card-title fs-2"><?= htmlspecialchars($post['title']) ?></h5>
            </div>
            <hr class="border border-2">
            <div class="card-body">
                <!-- Afficher le contenu de l'article -->
                <p class="card-text p-3 fs-5"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <div class="d-flex justify-content-end">
                    <!-- Afficher le nom de l'auteur -->
                    <p><small class="text-body-secondary"><?= htmlspecialchars($post['username']) ?></small></p>
                </div>
            </div>
            <div class="card-footer text-center">
                <!-- Afficher la date de création de l'article -->
                <p>Créé le : <small class="text-body-secondary"><?= htmlspecialchars($post['created_at']) ?></small></p>
                <?php if (!empty($post['modif_at'])) : ?>
                    <!-- Afficher la date de modification si elle existe -->
                    <p>Modifié le : <small class="text-body-secondary"><?= htmlspecialchars($post['modif_at']) ?></small></p>
                <?php endif; ?>
            </div>
            <div class="d-flex text-center align-self-center">
                <!-- Bouton pour modifier l'article -->
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_form_actu.php?id=<?= $post['post_id'] ?>" class="btn btn-warning">Modifier l'article</a>
                </div>
                <!-- Formulaire pour supprimer l'article -->
                <?php if ($id) : ?>
                    <div aria-label="Actions" class="text-center m-3">
                        <form action="/TFG/controllers/delete_post.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id']) ?>">
                            <button type="submit" class="btn btn-danger">Supprimer l'article</button>
                        </form>
                    </div>
                <?php endif; ?>
                <!-- Bouton pour retourner à la liste des articles -->
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_view_list_actu.php" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    // Afficher un message si le post n'existe pas
    header('Location: /TFG/404.php');
}
?>
