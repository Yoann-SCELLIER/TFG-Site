document.addEventListener('DOMContentLoaded', function () {

    // STORY
    document.getElementById('showMoreStory').addEventListener('click', function (e) {
        // Affiche le contenu caché de l'histoire et masque les éléments associés
        document.getElementById('hiddenStoryContent').style.display = 'block';
        document.querySelector('.downStoryContent').style.display = 'none';
        document.getElementById('showMoreStory').style.display = 'none';
    });

    document.getElementById('showLessStory').addEventListener('click', function () {
        // Masque le contenu de l'histoire caché et réaffiche l'élément de déclenchement
        document.getElementById('hiddenStoryContent').style.display = 'none';
        document.querySelector('.downStoryContent').style.display = 'block';
        document.getElementById('showMoreStory').style.display = 'inline';
    });

    // MEMBRE ET STAFF
    document.getElementById('showMoreStaff').addEventListener('click', function () {
        // Affiche le contenu caché du staff et masque les éléments associés
        document.getElementById('hiddenStaff').style.display = 'block';
        document.querySelector('.downStaff').style.display = 'none';
        document.getElementById('showMoreStaff').style.display = 'none';
    });

    document.getElementById('showLessStaff').addEventListener('click', function () {
        // Masque le contenu du staff caché et réaffiche l'élément de déclenchement
        document.getElementById('hiddenStaff').style.display = 'none';
        document.querySelector('.downStaff').style.display = 'block';
        document.getElementById('showMoreStaff').style.display = 'inline';
    });

    // GAMING
    document.getElementById('showMoreGaming').addEventListener('click', function () {
        // Affiche le contenu caché du gaming et masque les éléments associés
        document.getElementById('hiddenGamingContent').style.display = 'block';
        document.querySelector('.downGamingContent').style.display = 'none';
        document.getElementById('showMoreGaming').style.display = 'none';
    });

    document.getElementById('showLessGaming').addEventListener('click', function () {
        // Masque le contenu du gaming caché et réaffiche l'élément de déclenchement
        document.getElementById('hiddenGamingContent').style.display = 'none';
        document.querySelector('.downGamingContent').style.display = 'block';
        document.getElementById('showMoreGaming').style.display = 'inline';
    });

});

//--------------------------------------------------------------------------------------------------------------------------------------
// BOUTON CONTACT

document.getElementById('contactButton').addEventListener('click', function (event) {
    // Empêche le comportement par défaut du lien et affiche le modal de contact
    event.preventDefault();
    var contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
    contactModal.show();
});

//--------------------------------------------------------------------------------------------------------------------------------------
// BOUTON REMONTE ECRAN

let backToTopBtn = document.getElementById("backToTopBtn");

window.onscroll = function () {
    // Affiche ou masque le bouton "Revenir en haut" en fonction du défilement de la page
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
}

backToTopBtn.addEventListener('click', function () {
    // Fonction pour remonter en haut de la page en douceur
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

//--------------------------------------------------------------------------------------------------------------------------------------
// Gestion des pop-ups des conditions

document.addEventListener('DOMContentLoaded', function () {
    // Ferme les pop-ups en cliquant sur les boutons de fermeture
    document.querySelectorAll('.close-btn').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.classList.add('d-none');
        });
    });
});

//--------------------------------------------------------------------------------------------------------------------------------------
// Validation de formulaire Bootstrap

(function () {
    'use strict';

    // Récupère tous les formulaires nécessitant une validation
    var forms = document.querySelectorAll('.needs-validation');

    // Boucle sur les formulaires pour empêcher la soumission si les champs sont invalides
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
})();

//--------------------------------------------------------------------------------------------------------------------------------------