<div class="container">
    <h1 class="text-center p-5">Liste des Membres</h1>
    <table class="table table-bordered border border-2 border-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($member['member_id']); ?></td>
                    <td><?php echo htmlspecialchars($member['username']); ?></td>
                    <td><?php echo htmlspecialchars($member['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($member['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($member['email']); ?></td>
                    <td class="text-center">
                        <a href="/TFG/admin/admin_view_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                        <a href="/TFG/admin/admin_update_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-warning fw-bold">Modifier</a>
                        <a href="\TFG\controllers\admin_delete_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-danger fw-bold">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
