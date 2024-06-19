<div class="container">
    <div class="row">
        <?php if (isset($post) && !empty($post)): ?>
            <div class="col p-5">
                <div class="card border-2 m-5">
                    <img src="<?= isset($post['image_url']) ? htmlspecialchars($post['image_url']) : '' ?>" class="card-img-top p-2 align-self-center" style="width:50rem; height:auto" alt="Image <?= isset($post['title']) ? htmlspecialchars($post['title']) : '' ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title fs-2"><?= isset($post['title']) ? htmlspecialchars($post['title']) : '' ?></h5>
                    </div>
                    <hr class="border border-2">
                    <div class="card-body">
                        <p class="card-text p-3 fs-5"><?= isset($post['content']) ? nl2br(htmlspecialchars($post['content'])) : '' ?></p>
                        <div class="d-flex justify-content-end">
                            <p><small class="text-body-secondary"><?= isset($post['username']) ? htmlspecialchars($post['username']) : '' ?></small></p>
                        </div>
                    </div>
                    <div class="card-footer text-center"> 
                        <p>Créé le : <small class="text-body-secondary"><?= isset($post['created_at_fr']) ? htmlspecialchars($post['created_at_fr']) : '' ?></small></p>
                        <?php if (!empty($post['modif_at_fr'])) : ?>
                            <p>Modifié le : <small class="text-body-secondary"><?= isset($post['modif_at_fr']) ? htmlspecialchars($post['modif_at_fr']) : '' ?></small></p>
                        <?php endif; ?>
                        <div class="d-flex align-items-center justify-content-center text-center">
                            <!-- Inclure le contrôleur pour les boutons -->
                            <?php
                            $_GET['post_id'] = $id; // Assurez-vous que $id est défini correctement
                            include dirname(__DIR__) . '/controllers/controller_button_card_actu.php';
                            ?>
                            <!-- Bouton de retour -->
                            <div class="d-flex text-end justify-content-end m-3">
                                <a href="/TFG/actualite.php" class="btn btn-secondary">Retour à la liste des articles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col p-5">
                <p>L'article demandé n'existe pas.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
