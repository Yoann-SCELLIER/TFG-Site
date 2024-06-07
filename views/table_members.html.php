<section class="container-fluid px-5">
    <h1 class="text-center p-5">Liste des Membres</h1>
    <div class="table-responsive text-center">
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
                <tr>
                    <th class="m-0 b-0 p-0 g-0">ID</th>
                    <th class="m-0 b-0 p-0 g-0">Département</th>
                    <th class="m-0 b-0 p-0 g-0">Cover</th>
                    <th class="m-0 b-0 p-0 g-0">Pseudo</th>
                    <th class="m-0 b-0 p-0 g-0">Prénom</th>
                    <th class="m-0 b-0 p-0 g-0">Nom</th>
                    <th class="m-0 b-0 p-0 g-0">Email</th>
                    <th class="m-0 b-0 p-0 g-0">Lien</th>
                    <th class="m-0 b-0 p-0 g-0">Création</th>
                    <th class="m-0 b-0 p-0 g-0">Modification</th>
                    <th class="m-0 b-0 p-0 g-0">Rôle ID</th>
                    <th class="text-center m-0 b-0 p-0 g-0">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member) : ?>
                    <tr>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['member_id']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['departement_id']); ?></td>
                        <td class="m-0 b-0 p-0 g-0">
                            <img src="<?php echo htmlspecialchars($member['cover']); ?>" alt="Cover" class="img-thumbnail" style="width: 70px; height: 70px;">
                        </td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['username']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['first_name']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['last_name']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['email']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['link']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['created_at']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['modif_at']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo $member['role_id'] !== null ? htmlspecialchars($member['role_id']) : 'nul'; ?></td>
                        <td class="m-0 b-0 p-0 g-0">
                            <a href="/TFG/admin/admin_view_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                            <a href="/TFG/admin/admin_update_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-warning fw-bold">Modifier</a>
                            <a href="/TFG/controllers/admin_delete_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-danger fw-bold">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>