<section class="container-fluid px-5">
    <h1 class="text-center p-5">Liste des Membres</h1>
    <div class="table-responsive text-center">
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
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
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['member_id']); ?></td>
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['departement_id']); ?></td>
                        <td class="m-0 b-0 p-0 g-0">
                            <img src="<?php echo htmlspecialchars($member['cover']); ?>" alt="Cover" class="img-thumbnail" style="width: 70px; height: 70px;">
                        </td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['username']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['first_name']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['last_name']); ?></td>
                        <td class="m-0 b-0 p-0 g-0"><?php echo htmlspecialchars($member['email']); ?></td>
                        <td class="m-0 b-0 pe-2 px-2 g-0">
                            <form action="/TFG/controllers/update_member.php?id=<?php echo $member['member_id']; ?>" method="post" class="d-flex flex-column align-items-center">
                                <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['member_id']); ?>">
                                <select name="role_id" class="form-control text-center border border-1 border-black mb-2 w-auto">
                                    <?php if (isset($roles) && !empty($roles)) : ?>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?php echo $role['id']; ?>" <?php if ($member['role_id'] === $role['id']) echo 'selected'; ?>><?php echo $role['role_member']; ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Aucun rôle disponible</option>
                                    <?php endif; ?>
                                </select>
                                <button type="submit" class="btn btn-success btn-sm">Modifier le rôle</button>
                            </form>
                        </td>
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['created_at']); ?></td>
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($member['modif_at']); ?></td>
                        <td class="m-0 b-0 p-0 g-0 d-flex justify-content-center">
                            <a href="/TFG/admin/admin_view_member.php?id=<?php echo $member['member_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>