<?php
$jobs = listJobs($bdd);
?>

<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 bg-grey border border-4 border-danger">
            <h1 id="formTitle" class="text-white">Modifier le Membre</h1>
            <form id="memberForm" action="controllers\update_member.php?id=<?= $_GET['id'] ?>" method="post">
                <input type="hidden" name="member_id" value="<?= $member['member_id'] ?? '' ?>">
                <div class="mb-3">
                    <label for="username" class="form-label text-white">Nom d'utilisateur :</label><br>
                    <input type="text" name="username" class="form-control" id="username" value="<?= htmlspecialchars($member['username'] ?? '') ?>" required><br>
                </div> 
                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email :</label><br>
                    <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($member['email'] ?? '') ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="job" class="form-label text-white">Vos compétences :</label>
                    <hr class="border border-white"><br>
                    <div class="d-flex align-items-center justify-content-evenly">
                        <div class=" row col-6">
                            <?php foreach ($jobs as $job) : ?>
                                <div class="form-check text-start">
                                    <label class="form-check-label text-white" for="job<?= $job['job_id'] ?>">
                                        <?= $job['title'] ?>
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="jobs[]" id="job<?= $job['job_id'] ?>" value="<?= $job['job_id'] ?>" <?php if (isset($member['selected_jobs']) && in_array($job['id'], $member['selected_jobs'])) echo "checked"; ?>>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row col-6" width="150px;" height="auto">
                            <img src="\tfg\assets\images\logo_competence.png" alt="Image compétence">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-white">Description :</label><br>
                    <textarea name="content" class="form-control" id="content" rows="6" required><?= htmlspecialchars($member['content'] ?? 'Description par défaut') ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label text-white">URL de votre avatar :</label><br>
                    <input type="text" name="cover" class="form-control" id="cover" value="<?= htmlspecialchars($member['cover'] ?? 'URL par défaut') ?>" required><br>
                </div>
                <input type="submit" value="Modifier le Membre" class="btn btn-secondary p-3">
                <a href="index.php" class="btn btn-secondary p-3">Annuler</a>
            </form>
        </div>
    </div>
</div>