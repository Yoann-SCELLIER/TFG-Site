<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 border border-4 border-danger">
            <h1 id="formTitle">Modifier le Membre</h1>
            <form id="memberForm" action="\TFG\controllers\admin_update_member.php?id=<?= htmlspecialchars($_GET['id']) ?>" method="post">
                <input type="hidden" name="member_id" value="<?= htmlspecialchars($member['member_id'] ?? '') ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur :</label><br>
                    <input type="text" name="username" class="form-control border border-2 border-dark" id="username" value="<?= htmlspecialchars($member['username'] ?? '') ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label><br>
                    <input type="email" name="email" class="form-control border border-2 border-dark" id="email" value="<?= htmlspecialchars($member['email'] ?? '') ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="job" class="form-label">Vos compétences :</label>
                    <hr class="border border-white"><br>
                    <div class="d-flex align-items-center justify-content-evenly">
                        <div class="row col-6">
                            <?php foreach ($jobs as $job) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jobs[]" id="job<?= $job['job_id'] ?>" value="<?= $job['job_id'] ?>" <?php if (isset($jobs_selected) && is_array($jobs_selected) && in_array($job['job_id'], $jobs_selected)) echo "checked"; ?>>
                                    <label class="form-check-label" for="job<?= $job['job_id'] ?>">
                                        <?= htmlspecialchars($job['title']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row col-6" width="150px;" height="auto">
                            <img src="\tfg\assets\images\logo_competence.png" alt="Image compétence">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Description :</label><br>
                    <textarea name="content" class="form-control border border-2 border-dark" id="content" rows="6" required><?= htmlspecialchars($member['content'] ?? 'Description par défaut') ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">URL de votre avatar :</label><br>
                    <input type="text" name="cover" class="form-control border border-2 border-dark" id="cover" value="<?= htmlspecialchars($member['cover'] ?? 'URL par défaut') ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="games" class="form-label">Jeux :</label>
                    <hr class="border border-white"><br>
                    <div class="row col-6">
                        <?php foreach ($games as $game) : ?>
                            <div class="form-check text-start">
                                <label class="form-check-label" for="game<?= $game['game_id'] ?>">
                                    <?= $game['title'] ?>
                                </label>
                                <input class="form-check-input" type="checkbox" name="games[]" id="game<?= $game['game_id'] ?>" value="<?= $game['game_id'] ?>" <?php if (in_array($game['game_id'], array_column($selected_games, 'game_id'))) echo "checked"; ?>>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="departement_id" class="form-label">Département :</label><br>
                    <select id="departement_id" class="form-control border border-1 border-dark text-center" name="departement_id" required>
                        <option value="" disabled>Choisir un département</option>
                        <?php foreach ($departements as $departement) : ?>
                            <option value="<?= htmlspecialchars($departement['departement_id']) ?>" <?= (isset($member['departement_id']) && $member['departement_id'] == $departement['departement_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($departement['departement_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                </div>
                <input type="submit" value="Modifier le Membre" class="btn btn-primary p-3 border border-1 border-dark">
                <a href="\TFG\admin\dashboard.php" class="btn btn-primary p-3 border border-1 border-dark">Annuler</a>
            </form>
        </div>
    </div>
</div>