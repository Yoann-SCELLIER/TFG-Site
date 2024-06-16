<div class="text-center">
    <h1 class="p-5 mb-0">Détails du Membre</h1>
</div>
<?php if (isset($member) && !empty($member)) : ?>
    <section class="p-5">
        <div class="card border border-3">
            <div class="row g-0">
                <div class="col-md-3 text-center">
                    <img src="<?= htmlspecialchars($member['cover'] ?? ''); ?>" class="img-fluid rounded-start" alt="Image de <?= htmlspecialchars($member['username'] ?? ''); ?>">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($member['username'] ?? ''); ?></h5>
                        <p class="card-text">Description : <?= htmlspecialchars($member['content'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="col-md-2 text-white text-center">
                    <div class="card-body bg-grey">
                        <p>Membre :<br> <span class="role <?= strtolower(str_replace(' ', '-', $member['role_member'] ?? '')); ?>">
                                <?= htmlspecialchars($member['role_member'] ?? ''); ?>
                            </span></p>
                        <p><strong>Spécialités :</strong><br>
                            <?php if (!empty($member['jobs'])) : ?>
                                <ul>
                                    <li><?= htmlspecialchars($member['jobs']); ?></li>
                                </ul>
                            <?php else : ?>
                                Aucune spécialité.
                            <?php endif; ?>
                        </p>
                        <h6 class="card-title text-white">Retrouver le sur :</h6>
                        <?php if ($hasConsoles) : ?>
                            <?php foreach ($consoles as $console) : ?>
                                <p class="text-white"><?= htmlspecialchars($console['title']); ?></p>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-white">Ce membre n'a aucune console pour le moment.</p>
                        <?php endif; ?>
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
                                <img src="assets/images/mail.png" style="width: 5rem;" alt="Mail de <?= htmlspecialchars($member['username'] ?? ''); ?>">
                            </a>
                        </small>
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <p>Si vous le souhaitez, vous pouvez contacter le membre directement par e-mail. Il vous répondra dès que possible.</p>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <p>Le membre n'existe pas ou l'ID du membre n'a pas été spécifié.</p>
    <a href="\TFG\index.php">Retour à la liste</a>
<?php endif; ?>