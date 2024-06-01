<div class="row row-cols-1 row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 m-5 g-4 d-flex row justify-content-around text-center">
    <div class="card m-2">
        <h2>Inscription</h2>
        <form action="/tfg/controllers/ajout_member.php" method="post" enctype="multipart/form-data">

            <label for="username" class="form-label">Nom d'utilisateur :</label><br>
            <input type="text" class="form-control" id="username" name="username" required><br>

            <label for="first_name">Prénom :</label><br>
            <input type="text" class="form-control" id="first_name" name="first_name" required><br>

            <label for="last_name" class="form-label">Nom :</label><br>
            <input type="text" class="form-control" id="last_name" name="last_name" required><br>

            <label for="email" class="form-label">Adresse e-mail :</label><br>
            <input type="email" class="form-control" id="email" name="email" required><br>

            <label for="password" class="form-label">Mot de passe :</label><br>
            <input type="password" class="form-control" id="password" name="password" required><br>

            <label for="confirm_password" class="form-label">Confirmer le mot de passe :</label><br>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required><br>

            <label for="departement_id" class="form-label">Département :</label><br>
            <select id="departement_id" class="form-control" name="departement_id" required>
                <option value="" disabled selected>Choisir un département</option>
                <?php
                // Inclusion du fichier de configuration de la base de données
                require_once dirname(__DIR__) . '\controller\db.fn.php';

                // Récupération des départements depuis la base de données
                $sql = "SELECT departement_id, departement_name FROM departement";
                $stmt = $bdd->prepare($sql);
                $stmt->execute();

                // Affichage des options
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['departement_id'] . '">' . $row['departement_name'] . '</option>';
                }
                ?>
            </select><br>

            <label for="cover" class="form-label">Image de profil :</label><br>
            <input type="file" id="cover" name="cover"><br>

            <input type="submit" value="S'inscrire">
        </form>
    </div>

    <div>
        <div class="card">
            <h2>Connexion</h2>
            <form action="/tfg/controllers/connexion_member.php" method="post">
                <label for="email">Email :</label><br>
                <input type="email" id="email" name="email" required><br><br>
                <label for="password">Mot de passe :</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit">Se connecter</button>
            </form>
        </div>
        <div>
            
        </div>
    </div>
</div>