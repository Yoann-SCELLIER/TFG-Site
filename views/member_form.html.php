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
                <div class="mb-3">
    <label for="job" class="form-label text-white">Vos compétences :</label><br>
    <?php foreach ($all_jobs as $job) : ?>
        <div><?= $job['title'] ?></div>
    <?php endforeach; ?>
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
                <?php if (isset($member)) : ?>
                    <form action="supprimer_membre.php" method="post" class="d-inline">
                        <input type="hidden" name="member_id" value="<?= htmlspecialchars($member['member_id']) ?>">
                        <button type="submit" class="btn btn-danger p-3">Supprimer</button>
                    </form>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
