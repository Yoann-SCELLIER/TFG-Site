<body>
    <h1>Détails du Membre</h1>
    <p><strong>Username :</strong> <?php echo $member['username']; ?></p>
    <p><strong>Email :</strong> <?php echo $member['email']; ?></p>
    <p><strong>Role :</strong> <?php echo $member['role']; ?></p>
    <p><strong>Description :</strong> <?php echo $member['content']; ?></p>
    <p><strong>Créé le :</strong> <?php echo $member['created_at']; ?></p>
    <p><strong>Mis à jour le :</strong> <?php echo $member['updated_at']; ?></p>
    <a href="index.php">Retour à la liste</a>
</body>