<div class="container">
        <h1 class="mt-5">Liste des Membres</h1>
        <table class="table table-bordered border border-2 border-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
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
                        <td>
                            <a href="/TFG/admin/admin_view_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-primary">Détail</a>
                            <a href="/TFG/admin/admin_update_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-warning">Modifier</a>
                            <a href="\TFG\controllers\delete_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>