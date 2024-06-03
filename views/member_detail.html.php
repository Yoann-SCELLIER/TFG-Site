<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

?>

<div class="text-center">
    <h1 class="p-5 mb-0">Détails du Membre</h1>
</div>
<?php if (isset($member) && !empty($member)) : ?>
    <section class="p-5">
        <div class="card border border-3">
            <div class="row g-0">
                <div class="col-md-3 m-2 text-center">
                    <img src="<?php echo $member['cover']; ?>" class="img-fluid rounded-start" alt="Image de <?php echo $member['username']; ?>">
                    <p class="card-text"><small class="text-body-secondary">Créé le : <?php echo $member['created_at']; ?></small></p>
                    <p class="card-text"><small class="text-body-secondary">Mis à jour le : <?php echo $member['modif_at']; ?></small></p>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Username : <?php echo $member['username']; ?></h5>
                        <p><strong>Spécialités :</strong> 
                            <?php if (!empty($member['jobs'])) : ?>
                                    <?php echo htmlspecialchars($member['jobs']); ?>
                            <?php else : ?>
                                Aucune spécialité.
                            <?php endif; ?>
                        </p>
                        <p class="card-text">Description : <?php echo $member['content']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-evenly p-3">
            <!-- Bouton pour modifier le membre -->
            <form action="member_form.php" method="get" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $member['member_id']; ?>">
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
            <!-- Bouton pour supprimer le membre -->
            <form action="supprimer_membre.php" method="post" style="display: inline;">
                <input type="hidden" name="member_id" value="<?php echo $member['member_id']; ?>">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            <!-- Formulaire pour le bouton Retour à la liste -->
            <form action="index.php#staffSection" method="get" style="display: inline;">
                <button type="submit" class="btn btn-secondary">Retour à la liste</button>
            </form>
        </div>
    </section>
<?php else : ?>
    <p>Le membre n'existe pas ou l'ID du membre n'a pas été spécifié.</p>
    <a href="\TFG\index.php">Retour à la liste</a>
<?php endif; ?>