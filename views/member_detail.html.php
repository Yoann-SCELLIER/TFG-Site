<div class="text-center">
    <h1 class="p-5 mb-0">Détails du Membre</h1>
</div>
<?php if (isset($member) && !empty($member)) : ?>
    <section class="p-5">
        <div class="card border border-3">
            <div class="row g-0">
                <div class="col-md-3 text-center">
                    <img src="<?= htmlspecialchars($member['cover'] ?? ''); ?>" class="img-fluid rounded-start" alt="Image de <?= htmlspecialchars($member['username'] ?? ''); ?>">
                    <p class="card-text"><small class="text-body-secondary">Créé le : <?= htmlspecialchars($member['created_at'] ?? ''); ?></small></p>
                    <p class="card-text"><small class="text-body-secondary">Mis à jour le : <?= htmlspecialchars($member['modif_at'] ?? ''); ?></small></p>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Username : <?= htmlspecialchars($member['username'] ?? ''); ?>
                    <span class="role <?= strtolower(str_replace(' ', '-', $member['role_member'] ?? '')); ?>">
                        <?= htmlspecialchars($member['role_member'] ?? ''); ?>
                    </span>
                    </h5>
                        <p><strong>Spécialités :</strong>
                            <?= htmlspecialchars($member['jobs'] ?? 'Aucune spécialité.'); ?>
                        </p>
                        <p class="card-text">Description : <?= htmlspecialchars($member['content'] ?? ''); ?></p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="card-body bg-grey">
                        <h6 class="card-title text-white">Retrouver le sur :</h6>
                        <?php if (!empty($consoles)) : ?>
                            <?php foreach ($consoles as $console) : ?>
                                <p class="text-white"><?= htmlspecialchars($console['title'] ?? ''); ?></p>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-white">Ce membre n'a aucune console pour le moment.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <p>Le membre n'existe pas ou l'ID du membre n'a pas été spécifié.</p>
    <a href="\TFG\index.php">Retour à la liste</a>
<?php endif; ?>