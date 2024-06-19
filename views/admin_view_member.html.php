<div class="text-center">
    <h1 class="p-5 mb-0">Détails du Membre</h1>
</div>
<?php if (isset($member) && !empty($member)) : ?>
    <section class="p-5">
        <div class="card border border-3">
            <div class="row g-0">
                <div class="col-md-3 text-center">
                    <img src="<?= htmlspecialchars($member['cover']); ?>" class="img-fluid rounded-start" 
                    alt="Image de <?= htmlspecialchars($member['username']); ?>">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Username : <?= htmlspecialchars($member['username'] ?? ''); ?></h5>
                        <p class="card-text">Description : <?= htmlspecialchars($member['content']); ?></p>
                    </div>
                </div>
                <div class="col-md-2 text-white text-center">
                <div class="card-body bg-grey">
                        <p>Rôle :<br>
                            <span class="<?= isset($member['role_member_class']) ? htmlspecialchars($member['role_member_class']) : ''; ?>">
                                <?= isset($member['role_member_name']) ? htmlspecialchars($member['role_member_name']) : ''; ?>
                            </span>
                        </p>
                        <p><strong>Spécialités :</strong><br>
                            <?php if (!empty($member['jobs'])) : ?>
                        <ul class="list-unstyled">
                            <?php foreach ($member['jobs'] as $job_title) : ?>
                                <li class="fs-7"><?= htmlspecialchars($job_title); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        Aucune spécialité.
                    <?php endif; ?>
                    </p>
                    <!-- Affichage des jeux du membre -->
                    <p><strong>Les jeux :</strong><br>
                        <?php if ($hasGames) : ?>
                            <?php foreach ($games as $game) : ?>
                    <ul class="list-unstyled">
                        <li class="text-white fs-7"><?= htmlspecialchars($game['title']); ?></li>
                    </ul>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-white">Ce membre n'a aucun jeu pour le moment.</p>
            <?php endif; ?>
            </p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <p class="card-text m-0 p-0 b-0 g-0"><small class="text-body-secondary">Créé le : <?= htmlspecialchars($member['created_at'] ?? ''); ?></small></p>
                    <p class="card-text m-0 p-0 b-0 g-0"><small class="text-body-secondary">Mis à jour le : <?= htmlspecialchars($member['modif_at'] ?? ''); ?></small></p>
                </div>
                <div class="col-md-3 text-center">
                    <p class="card-text m-0 p-0 b-0 g-0">
                        <small class="text-body-secondary">
                            <a href="mailto:<?= htmlspecialchars($member['email'] ?? ''); ?>">
                                <img src="/TFG/assets/images/mail.png" style="width: 5rem;" alt="Mail de <?= htmlspecialchars($member['username'] ?? ''); ?>">
                            </a>
                        </small>
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <p>Si vous le souhaitez, vous pouvez contacter le membre directement par e-mail. Il vous répondra dès que possible.</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-evenly p-3">
            <!-- Bouton pour modifier le membre -->
            <form action="admin_update_member.php" method="get" style="display: inline;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($member['member_id']); ?>">
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
            <!-- Bouton pour supprimer le membre -->
            <form action="\TFG\controllers\admin_delete_member.php" method="post" style="display: inline;">
                <input type="hidden" name="member_id" value="<?= htmlspecialchars($member['member_id']); ?>">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            <!-- Formulaire pour le bouton Retour à la liste -->
            <form action="\TFG\admin\dashboard.php" method="get" style="display: inline;">
                <button type="submit" class="btn btn-secondary">Retour à la liste</button>
            </form>
        </div>
    </section>
<?php else : ?>
    <p>Le membre n'existe pas ou l'ID du membre n'a pas été spécifié.</p>
    <a href="\TFG\index.php">Retour à la liste</a>
<?php endif; ?>