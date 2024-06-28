<!-- member_detail.html.php -->

<div class="text-center">
    <h1 class="p-5 mb-0">Détails du Membre</h1> 
</div>

<?php if (isset($member) && !empty($member)) : ?>
    <section class="p-5 pb-0 pt-0">
        <div class="card border border-3">
            <div class="row g-0">
                <div class="col-md-3 text-center">
                    <!-- Image du membre -->
                    <img src="<?= isset($member['cover']) ? htmlspecialchars($member['cover']) : ''; ?>" class="img-fluid rounded-start" alt="Image de <?= isset($member['username']) ? htmlspecialchars($member['username']) : ''; ?>">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <!-- Nom d'utilisateur du membre -->
                        <h5 class="card-title m-0"><?= isset($member['username']) ? htmlspecialchars($member['username']) : ''; ?></h5>
                        <!-- Description du membre -->
                        <p class="card-text m-0">Description :<br> <?= isset($member['content']) ? nl2br(htmlspecialchars($member['content'])) : ''; ?></p>
                    </div>
                </div>
                <div class="col-md-2 text-white text-center">
                    <div class="card-body bg-grey h-100">
                        <!-- Rôle du membre -->
                        <p>Rôle :<br>
                            <span class="<?= isset($member['role_member_class']) ? htmlspecialchars($member['role_member_class']) : ''; ?>">
                                <?= isset($member['role_member_name']) ? htmlspecialchars($member['role_member_name']) : ''; ?>
                            </span>
                        </p>
                        <!-- Spécialités du membre -->
                        <p class="m-0"><strong>Spécialités :</strong><br>
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
                        <!-- Jeux associés au membre -->
                        <p class="m-0"><strong>Les jeux :</strong><br>
                            <?php if (!empty($selected_games) && is_array($selected_games)) : ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($selected_games as $game) : ?>
                                        <li class="fs-7"><?= htmlspecialchars($game['title'] ?? ''); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <p>Ce membre n'a aucun jeu pour le moment.</p>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 text-center align-items-center">
                    <!-- Informations temporelles -->
                    <p class="card-text m-0"><small class="text-body-secondary">Créé le : <?= isset($member['created_at']) ? htmlspecialchars($member['created_at']) : ''; ?></small></p>
                    <p class="card-text m-0"><small class="text-body-secondary">Mis à jour le : <?= isset($member['modif_at']) ? htmlspecialchars($member['modif_at']) : ''; ?></small></p>
                </div>
                <div class="col-md-3 d-flex align-items-center justify-content-center">
                    <!-- Bouton pour envoyer un e-mail au membre -->
                    <p class="card-text">
                        <small class="text-body-secondary d-flex align-items-center text-center">
                            <a href="mailto:<?= isset($member['email']) ? htmlspecialchars($member['email']) : ''; ?>">
                                <img src="assets/images/mail.webp" style="width: 5rem;" alt="Mail de <?= isset($member['username']) ? htmlspecialchars($member['username']) : ''; ?>">
                            </a>
                        </small>
                    </p>
                </div>
                <div class="col-md-6 text-center d-flex align-items-center">
                    <!-- Message de contact -->
                    <p class="m-0">Si vous le souhaitez, vous pouvez contacter le membre directement par e-mail. Il vous répondra dès que possible.</p>
                </div>
            </div>
        </div>
    </section> 
<?php else : 
    header('Location: /TFG/404.php');
endif; ?>
