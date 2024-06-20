<!-- FORMULAIRE INSCRIPTION -->
<div class="row row-cols-1 row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 m-5 g-4 d-flex row justify-content-around text-center">
    <div class="card m-2 bg-grey border border-4 border-danger">
        <h2 class="text-white mt-2">Inscription</h2>
        <form action="/TFG/controllers/ajout_member.php" method="post" enctype="multipart/form-data" class="m-3">
            <label for="username" class="form-label text-white">Nom d'utilisateur :</label><br>
            <input type="text" class="form-control" id="username" name="username" placeholder="Votre pseudo" required><br>
            <label for="first_name" class="text-white">Prénom :</label><br>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Votre prénom" required><br>
            <label for="last_name" class="form-label text-white">Nom :</label><br>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Votre nom" required><br>
            <label for="email" class="form-label text-white">Adresse e-mail :</label><br>
            <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse mail" required><br>
            <label for="password" class="form-label text-white">Mot de passe :</label><br>
            <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required><br>
            <label for="confirm_password" class="form-label text-white">Confirmer le mot de passe :</label><br>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmer votre mot de passe" required><br>
            <label for="departement_id" class="form-label text-white">Département :</label><br>
            <select id="departement_id" class="form-control" name="departement_id" required>
                <option value="" disabled selected>Choisir un département</option>
                <?php foreach ($departements as $departement) : ?>
                    <option value="<?= $departement['departement_id'] ?>"><?= $departement['departement_name'] ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="cover" class="form-label text-white">Image de profil :</label><br>
            <input type="text" class="form-control " id="cover" name="cover" placeholder="Lien de votre image"><br>
            <button type="submit" class="mt-3 p-2 btn btn-primary">S'inscrire</button><br>
        </form>
    </div>

    <!-- FORMULAIRE CONNEXION -->
    <div class="m-0 p-0 b-0 g-0">
        <div class="card bg-grey border border-4 border-danger">
            <h2 class="text-white mt-2">Connexion</h2>
            <form action="/tfg/controllers/connexion_member.php" method="post" class="m-3">
                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Mot de passe :</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                </div>
                <button type="submit" class="mt-3 btn btn-success">Se connecter</button>
            </form>
        </div>

        <!-- SECTION D'INSCRIPTION -->
        <section class="m-2"><br>
            <h5>Inscription à True Fighters Gaming</h5>
            <p>Rejoignez True Fighters Gaming, la communauté ultime pour les passionnés de jeux vidéo!<br>
                Notre association est dédiée à rassembler les joueurs de tous horizons pour partager des expériences,<br>
                participer à des tournois et développer des compétences de jeu dans un environnement convivial et compétitif.<br>
                <br>
                Comment s'inscrire?<br>
                L'inscription à True Fighters Gaming est simple et rapide. Suivez ces étapes pour rejoindre notre communauté <span class="text-danger">*</span>
            </p>
        </section>

        <!-- MESSAGE COMPLÉMENTAIRE -->
        <div>
            <p class="fst-italic text-danger">"* Pour plus de détails dans votre profil, pensez à aller le modifier !"</p>
        </div>
    </div>


</div>