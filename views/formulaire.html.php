<!-- FORMULAIRE DE CONTACT -->
    <!------------------------------------------------------------------------------------------------------------------------------------>

    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contactez-nous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenu de la page CONTACT -->
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom et prénom :</label>
                            <input type="text" class="form-control" id="name" placeholder="(ou pseudo)" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" placeholder="True.Fighters.Gaming.Contact@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Sujet de votre demande :</label>
                            <select class="form-select" id="subject" aria-label="Default select example">
                                <option value="1">Adhésion</option>
                                <option value="2">Demande de partenariat</option>
                                <option value="3">Tournois organisés par la TF</option>
                                <option value="4">Autres...</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message :</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Votre message ici..." required></textarea>
                        </div>
                        <div class="justify-content-center text-center">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>