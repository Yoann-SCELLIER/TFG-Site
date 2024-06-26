<section class="container-fluid px-5">
    <!-- Titre principal -->
    <h1 class="text-center p-2 m-0">Liste des Membres</h1>
    <div class="table-responsive text-center">
        <!-- Tableau Bootstrap avec bordures -->
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
                <!-- En-têtes de colonnes -->
                <tr>
                    <th class="m-0 b-0 p-0 g-0">ID</th>
                    <th class="m-0 b-0 p-0 g-0">Dept</th>
                    <th class="m-0 b-0 p-0 g-0">Cover</th>
                    <th class="m-0 b-0 p-0 g-0">Pseudo</th>
                    <th class="m-0 b-0 p-0 g-0">Prénom</th>
                    <th class="m-0 b-0 p-0 g-0">Nom</th>
                    <th class="m-0 b-0 p-0 g-0">Email</th>
                    <th class="m-0 b-0 p-0 g-0">Rôle</th> <!-- Nouvelle colonne "Rôle" -->
                    <th class="m-0 b-0 p-0 g-0">Création</th>
                    <th class="m-0 b-0 p-0 g-0">Modification</th>
                    <th class="text-center m-0 b-0 p-0 g-0">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member) : ?>
                    <tr>
                        <!-- ID du membre -->
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['member_id']); ?></td>
                        <!-- ID du département -->
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['departement_id']); ?></td>
                        <!-- Image de couverture (Cover) -->
                        <td class="m-0 b-0 p-0 g-0">
                            <img src="<?php echo htmlspecialchars($member['cover']); ?>" alt="Cover" class="img-thumbnail" style="width: 70px; height: 70px;">
                        </td>
                        <!-- Pseudo du membre -->
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['username']); ?></td>
                        <!-- Prénom du membre -->
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['first_name']); ?></td>
                        <!-- Nom du membre -->
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['last_name']); ?></td>
                        <!-- Email du membre -->
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['email']); ?></td>
                        <!-- Formulaire pour modifier le rôle du membre -->
                        <td class="m-0 b-0 pe-2 px-2 g-0">
                            <form action="/TFG/controllers/admin_update_member.php?id=<?php echo $member['member_id']; ?>" method="post" class="d-flex flex-column align-items-center">
                                <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['member_id']); ?>">
                                <!-- Sélection du rôle avec liste déroulante -->
                                <select name="role_id" class="form-control text-center border border-1 border-black mb-2 w-auto">
                                    <?php if (isset($roles) && !empty($roles)) : ?>
                                        <?php foreach ($roles as $role) : ?>
                                            <!-- Option pour chaque rôle -->
                                            <option value="<?php echo $role['id']; ?>" <?php if ($member['role_id'] === $role['id']) echo 'selected'; ?>><?php echo $role['role_member']; ?></option>
                                        <?php endforeach; ?> 
                                    <?php else : ?>
                                        <!-- Aucun rôle disponible (option par défaut) -->
                                        <option value="">Aucun rôle disponible</option>
                                    <?php endif; ?>
                                </select>
                                <!-- Bouton pour soumettre le formulaire de modification du rôle -->
                                <button type="submit" class="btn btn-success btn-sm">Modifier le rôle</button>
                            </form>
                        </td>
                        <!-- Date de création du membre -->
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['created_at']); ?></td>
                        <!-- Date de dernière modification du membre -->
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['modif_at']); ?></td>
                        <!-- Actions (lien pour voir les détails du membre) -->
                        <td class="m-0 b-0 p-0 g-0 d-flex justify-content-center">
                            <a href="/TFG/admin/admin_view_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
