<?php
// Vérifier si $member_id est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
} else {
    // Gérer le cas où $member_id n'est pas défini
    // Vous pouvez rediriger l'utilisateur vers une page de connexion ou afficher un message d'erreur
    header('Location: /TFG/404.php');
}
?>

<div class="container text-center">
    <!-- Conteneur principal centré verticalement -->
    <div class="row align-items-center p-5">
        <!-- Ligne avec alignement vertical des éléments et marge interne de 5 -->
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 border border-4 border-danger">
            <!-- Colonne avec marges, bordures et padding définis -->

            <!-- Titre du formulaire -->
            <h1 id="formTitle">Modifier le Membre</h1>

            <!-- Formulaire POST vers l'action de mise à jour du membre -->
            <form id="memberForm" action="\TFG\controllers\admin_update_member.php?id=<?= htmlspecialchars($_GET['id']) ?>" method="post">
                <!-- Champ caché pour l'ID du membre -->
                <input type="hidden" name="member_id" value="<?= htmlspecialchars($member['member_id'] ?? '') ?>">

                <!-- Champ pour le nom d'utilisateur -->
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur :</label><br>
                    <input type="text" name="username" class="form-control border border-2 border-dark" id="username" value="<?= htmlspecialchars($member['username'] ?? '') ?>" required><br>
                </div>

                <!-- Champ pour l'email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label><br>
                    <input type="email" name="email" class="form-control border border-2 border-dark" id="email" value="<?= htmlspecialchars($member['email'] ?? '') ?>" required><br>
                </div>

                <!-- Section pour les compétences et l'image -->
                <div class="mb-3">
                    <hr class="border border-white"><br>
                    <div class="d-flex align-items-center justify-content-evenly">
                        <!-- Colonne gauche pour les métiers -->
                        <div class="row col-6 text-start">
                            <label for="job" class="form-label fs-3">Vous êtes :</label>
                            <!-- Boucle pour afficher les métiers -->
                            <?php foreach ($jobs as $job) : ?>
                                <div class="form-check">
                                    <input class="form-check-input border boder-2 border-black" type="checkbox" name="jobs[]" id="job<?= $job['job_id'] ?>" value="<?= $job['job_id'] ?>" <?php if (isset($jobs_selected) && is_array($jobs_selected) && in_array($job['job_id'], $jobs_selected)) echo "checked"; ?>>
                                    <label class="form-check-label" for="job<?= $job['job_id'] ?>">
                                        <?= htmlspecialchars($job['title']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Colonne droite pour l'image -->
                        <div class="row col-6" width="150px;" height="auto">
                            <img src="\tfg\assets\images\logo_competence.png" alt="Image compétence">
                        </div>
                    </div>
                </div>

                <!-- Champ pour la description -->
                <div class="mb-3">
                    <label for="content" class="form-label">Description :</label><br>
                    <textarea name="content" class="form-control border border-2 border-dark" id="content" rows="6" required><?= htmlspecialchars($member['content'] ?? 'Description par défaut') ?></textarea><br>
                </div>

                <!-- Champ pour l'URL de l'avatar -->
                <div class="mb-3">
                    <label for="cover" class="form-label">URL de votre avatar :</label><br>
                    <input type="text" name="cover" class="form-control border border-2 border-dark" id="cover" value="<?= htmlspecialchars($member['cover'] ?? 'URL par défaut') ?>" required><br>
                </div>

                <!-- Section pour les jeux -->
                <div class="mb-3">
                    <label for="games" class="form-label">Jeux :</label>
                    <hr class="border border-black"><br> 
                    <div class="row col-6">
                        <!-- Boucle pour afficher les jeux -->
                        <?php foreach ($games as $game) : ?>
                            <div class="form-check text-start">
                                <label class="form-check-label" for="game<?= $game['game_id'] ?>">
                                    <?= $game['title'] ?>
                                </label>
                                <?php $isChecked = in_array($game['game_id'], array_column($selected_games, 'game_id')); ?>
                                <input class="form-check-input border boder-2 border-black" type="checkbox" name="games[]" id="game<?= $game['game_id'] ?>" value="<?= $game['game_id'] ?>" <?= $isChecked ? 'checked' : '' ?>>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Champ pour le département -->
                <div class="mb-3">
                    <label for="departement_id" class="form-label">Département :</label><br>
                    <select id="departement_id" class="form-control border border-1 border-dark text-center" name="departement_id" required>
                        <option value="" disabled>Choisir un département</option>
                        <!-- Boucle pour afficher les options de département -->
                        <?php foreach ($departements as $departement) : ?>
                            <option value="<?= htmlspecialchars($departement['departement_id']) ?>" <?= (isset($member['departement_id']) && $member['departement_id'] == $departement['departement_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($departement['departement_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                </div>

                <!-- Boutons de soumission et d'annulation -->
                <input type="submit" value="Modifier le Membre" class="btn btn-primary p-3 border border-1 border-dark">
                <a href="\TFG\admin\dashboard.php" class="btn btn-primary p-3 border border-1 border-dark">Annuler</a>
            </form>
        </div>
    </div>
</div>