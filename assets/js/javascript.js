document.addEventListener('DOMContentLoaded', function () {

    // STORY -----------------------------------------------------------------------------------------------------------------------
    document.getElementById('showMoreStory').addEventListener('click', function (e) {
        console.log('click story', e);
        document.getElementById('hiddenStoryContent').style.display = 'block';
        document.querySelector('.downStoryContent').style.display = 'none';
        document.getElementById('showMoreStory').style.display = 'none';
    });

    document.getElementById('showLessStory').addEventListener('click', function () {
        document.getElementById('hiddenStoryContent').style.display = 'none';
        document.querySelector('.downStoryContent').style.display = 'block';
        document.getElementById('showMoreStory').style.display = 'inline';
    });

    // MEMBRE ET STAFF -----------------------------------------------------------------------------------------------------------------------
    document.getElementById('showMoreStaff').addEventListener('click', function () {
        document.getElementById('hiddenStaff').style.display = 'block';
        document.querySelector('.downStaff').style.display = 'none';
        document.getElementById('showMoreStaff').style.display = 'none';
    });

    document.getElementById('showLessStaff').addEventListener('click', function () {
        document.getElementById('hiddenStaff').style.display = 'none';
        document.querySelector('.downStaff').style.display = 'block';
        document.getElementById('showMoreStaff').style.display = 'inline';
    });

    // GAMING -----------------------------------------------------------------------------------------------------------------------
    document.getElementById('showMoreGaming').addEventListener('click', function () {
        document.getElementById('hiddenGamingContent').style.display = 'block';
        document.querySelector('.downGamingContent').style.display = 'none';
        document.getElementById('showMoreGaming').style.display = 'none';
    });

    document.getElementById('showLessGaming').addEventListener('click', function () {
        document.getElementById('hiddenGamingContent').style.display = 'none';
        document.querySelector('.downGamingContent').style.display = 'block';
        document.getElementById('showMoreGaming').style.display = 'inline';
    });
});

//--------------------------------------------------------------------------------------------------------------------------------------
// BOUTON CONTACT

document.getElementById('contactButton').addEventListener('click', function (event) {
    event.preventDefault();
    var contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
    contactModal.show();
});

//--------------------------------------------------------------------------------------------------------------------------------------
// BOUTON REMONTE ECRAN

let backToTopBtn = document.getElementById("backToTopBtn");

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
}

backToTopBtn.addEventListener('click', function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

//--------------------------------------------------------------------------------------------------------------------------------------
// Script pour gérer les pop-ups des conditions

// Aucun gestionnaire d'événements spécifique pour les boutons AssocButton et TournamentButton est nécessaire
document.addEventListener('DOMContentLoaded', function () {
    // Vous n'avez pas besoin de gestionnaires spécifiques pour les boutons AssocButton et TournamentButton
    document.querySelectorAll('.close-btn').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.classList.add('d-none');
        });
    });
});

//------------------------------------------------------------------------------------------------------------------------------------------

    // JavaScript pour validation de formulaire Bootstrap
    (function () {
        'use strict';

        // Récupération des formulaires à valider
        var forms = document.querySelectorAll('.needs-validation');

        // Boucle sur les formulaires et prévention de la soumission
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