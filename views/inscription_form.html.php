<h2>Inscription</h2>
<form action="/tfg/controllers/ajout_member.php" method="post">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="first_name">Prénom :</label><br>
    <input type="text" id="first_name" name="first_name" required><br>

    <label for="last_name">Nom :</label><br>
    <input type="text" id="last_name" name="last_name" required><br>

    <label for="email">Adresse e-mail :</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Confirmer le mot de passe :</label><br>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <label for="departement_id">Département :</label><br>
    <select id="departement_id" name="departement_id" required>
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

    <input type="submit" value="S'inscrire">
</form>