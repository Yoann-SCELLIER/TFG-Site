<!-- member_form.html.php -->
<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 bg-grey border border-4 border-danger">
            <h1 id="formTitle" class="text-white">Modifier le Membre</h1>
            <form id="memberForm" action="controllers/update_member.php<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>" method="post">
                <!-- Champ caché pour l'ID du membre -->
                <input type="hidden" name="member_id" value="<?= $member['member_id'] ?? '' ?>">
                
                <!-- Champ pour le nom d'utilisateur -->
                <div class="mb-3">
                    <label for="username" class="form-label text-white">Nom d'utilisateur :</label><br>
                    <input type="text" name="username" class="form-control" id="username" value="<?= htmlspecialchars($member['username'] ?? '') ?>" required><br>
                </div>
                
                <!-- Champ pour l'e-mail -->
                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email :</label><br>
                    <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($member['email'] ?? '') ?>" required><br>
                </div>
                
                <!-- Sélection des compétences -->
                <div class="mb-3">
                    <label for="job" class="form-label text-white">Vos compétences :</label>
                    <hr class="border border-white"><br>
                    <div class="d-flex align-items-center justify-content-evenly">
                        <div class="row col-6">
                            <?php foreach ($jobs as $job) : ?>
                                <div class="form-check text-white">
                                    <input class="form-check-input" type="checkbox" name="jobs[]" id="job<?= $job['job_id'] ?>" value="<?= $job['job_id'] ?>" <?php if (isset($jobs_selected) && is_array($jobs_selected) && in_array($job['job_id'], $jobs_selected)) echo "checked"; ?>>
                                    <label class="form-check-label" for="job<?= $job['job_id'] ?>">
                                        <?= htmlspecialchars($job['title']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row col-6">
                            <!-- Placeholder pour l'image ou tout autre contenu pour les compétences -->
                            <img src="\tfg\assets\images\logo_competence.png" alt="Image compétence">
                        </div>
                    </div>
                </div>
                
                <!-- Champ pour la description -->
                <div class="mb-3">
                    <label for="content" class="form-label text-white">Description :</label><br>
                    <textarea name="content" class="form-control" id="content" rows="6" required><?= htmlspecialchars($member['content'] ?? 'Description par défaut') ?></textarea><br>
                </div>
                
                <!-- Champ pour l'URL de l'avatar -->
                <div class="mb-3">
                    <label for="cover" class="form-label text-white">URL de votre avatar :</label><br>
                    <input type="text" name="cover" class="form-control" id="cover" value="<?= htmlspecialchars($member['cover'] ?? 'URL par défaut') ?>" required><br>
                </div>
                
                <!-- Sélection des jeux -->
                <div class="mb-3">
                    <label for="games" class="form-label text-white">Jeux :</label>
                    <hr class="border border-white"><br>
                    <div class="row col-6">
                        <?php foreach ($games as $game) : ?>
                            <div class="form-check text-start">
                                <label class="form-check-label text-white" for="game<?= $game['game_id'] ?>">
                                    <?= $game['title'] ?>
                                </label>
                                <input class="form-check-input" type="checkbox" name="games[]" id="game<?= $game['game_id'] ?>" value="<?= $game['game_id'] ?>" <?php if (in_array($game['game_id'], array_column($selected_games, 'game_id'))) echo "checked"; ?>>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Sélection du département -->
                <div class="mb-3">
                    <label for="departement_id" class="form-label text-white">Département :</label><br>
                    <select id="departement_id" class="form-control" name="departement_id" required>
                        <option value="" disabled selected>Choisir un département</option>
                        <?php foreach ($departements as $departement) : ?>
                            <option value="<?= $departement['departement_id'] ?>" <?= ($departement['departement_id'] == $member['departement_id']) ? 'selected' : '' ?>>
                                <?= $departement['departement_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                </div>
                
                <!-- Boutons de soumission et d'annulation -->
                <input type="submit" value="Modifier le Membre" class="btn btn-secondary p-3">
                <a href="index.php" class="btn btn-secondary p-3">Annuler</a>
            </form>
        </div>
    </div>
</div>
