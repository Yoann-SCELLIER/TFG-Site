<?php

// Récupération de l'ID pour la visualisation de l'article ciblé
$id = $_GET['id'];

// Récupération des détails de l'article avec l'ID spécifié
$post = getPostById($bdd, $id);

// Vérifier si l'article existe
if ($post) {
?>

<div class="col p-5 ">
        <div class="card border-2 m-5">
            <img src="<?= $post['image_url'] ?>" class="card-img-top p-2 align-self-center" style="width:50rem; height:auto" alt="Image <?= $post['title'] ?>">
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
                <p>Créé le : <small class="text-body-secondary"><?= $post['created_at_fr'] ?></small></p>
                <?php if (!empty($post['modif_at'])) : ?>
                    <p>Modifié le : <small class="text-body-secondary"><?= $post['modif_at_fr'] ?></small></p>
                <?php endif; ?>
                <div class="d-flex align-items-center justify-content-center text-center">
                    <?php
                    // Inclure le contrôleur pour vérifier et afficher les boutons
                    $_GET['post_id'] = $id;
                    include dirname(__DIR__) . '/controllers/controller_button_card_actu.php';
                    ?>
                    <!-- Bouton de retour à la liste des articles -->
                    <div class="d-flex text-end justify-content-end m-3">
                        <a href="/TFG/actualite.php" class="btn btn-secondary">Retour à la liste des articles</a>
                    </div>
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