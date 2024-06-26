<div class="container">
    <div class="row">
        <?php if (isset($post) && !empty($post)): ?>
            <!-- Si un post existe et n'est pas vide, afficher les détails -->
            <div class="col p-5">
                <div class="card border-2 m-5">
                    <!-- Affichage de l'image associée au post -->
                    <img src="<?= isset($post['image_url']) ? htmlspecialchars_decode($post['image_url']) : '' ?>" class="card-img-top p-4 align-self-center" alt="Image <?= isset($post['title']) ? htmlspecialchars_decode($post['title']) : '' ?>">
                    <div class="card-body text-center">
                        <!-- Affichage du titre du post -->
                        <h5 class="card-title fs-2"><?= isset($post['title']) ? htmlspecialchars_decode($post['title']) : '' ?></h5>
                    </div>
                    <hr class="border border-2">
                    <div class="card-body">
                        <!-- Affichage du contenu du post avec des sauts de ligne respectés -->
                        <p class="card-text p-3 fs-5"><?= isset($post['content']) ? nl2br(htmlspecialchars_decode($post['content'])) : '' ?></p>
                        <div class="d-flex justify-content-end">
                            <!-- Affichage de l'auteur du post -->
                            <p><small class="text-body-secondary"><?= isset($post['username']) ? htmlspecialchars_decode($post['username']) : '' ?></small></p>
                        </div>
                    </div>
                    <div class="card-footer text-center"> 
                        <!-- Affichage de la date de création du post -->
                        <p>Créé le : <small class="text-body-secondary"><?= isset($post['created_at_fr']) ? htmlspecialchars_decode($post['created_at_fr']) : '' ?></small></p>
                        <!-- Affichage de la date de dernière modification du post (si elle existe) -->
                        <?php if (!empty($post['modif_at_fr'])) : ?>
                            <p>Modifié le : <small class="text-body-secondary"><?= isset($post['modif_at_fr']) ? htmlspecialchars_decode($post['modif_at_fr']) : '' ?></small></p>
                        <?php endif; ?>
                        <div class="d-flex align-items-center justify-content-center text-center">
                            <!-- Inclusion du contrôleur pour les boutons d'action -->
                            <?php
                            $_GET['post_id'] = $post['post_id']; // Assurez-vous que $post['post_id'] est défini correctement
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
        <?php else: 
            // <!-- Si aucun post n'est trouvé, afficher un message d'erreur -->
            header('Location: /TFG/404.php');
        endif; ?>
    </div>
</div>
