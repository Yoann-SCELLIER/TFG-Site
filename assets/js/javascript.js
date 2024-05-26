document.addEventListener('DOMContentLoaded', function () {

    // STORY -----------------------------------------------------------------------------------------------------------------------
    document.getElementById('showMoreStory').addEventListener('click', function () {
        // Afficher le contenu complet de l'histoire
        document.getElementById('hiddenStoryContent').style.display = 'block';
        // Cacher la vue précédente
        document.querySelector('.downStoryContent').style.display = 'none';
        // Cacher le bouton "Voir plus"
        document.getElementById('showMoreStory').style.display = 'none'; 
    });

    document.getElementById('showLessStory').addEventListener('click', function () {
        // Cacher le contenu complet de l'histoire
        document.getElementById('hiddenStoryContent').style.display = 'none';
        // Afficher la vue précédente
        document.querySelector('.downStoryContent').style.display = 'block';
        // Afficher le bouton "Voir plus"
        document.getElementById('showMoreStory').style.display = 'inline';
    });

    // MEMBRE ET STAFF -----------------------------------------------------------------------------------------------------------------------
    document.getElementById('showMoreStaff').addEventListener('click', function () {
        // Afficher le contenu complet de l'histoire
        document.getElementById('hiddenStaff').style.display = 'block';
        // Cacher la vue précédente
        document.querySelector('.downStaff').style.display = 'none';
        // Cacher le bouton "Voir plus"
        document.getElementById('showMoreStaff').style.display = 'none'; 
    });

    document.getElementById('showLessStaff').addEventListener('click', function () {
        // Cacher le contenu complet de l'histoire
        document.getElementById('hiddenStaff').style.display = 'none';
        // Afficher la vue précédente
        document.querySelector('.downStaff').style.display = 'block';
        // Afficher le bouton "Voir plus"
        document.getElementById('showMoreStaff').style.display = 'inline';
    });

    // GAMING -----------------------------------------------------------------------------------------------------------------------
    document.getElementById('showMoreGaming').addEventListener('click', function () {
        // Afficher le contenu complet de gaming
        document.getElementById('hiddenGamingContent').style.display = 'block';
        // Cacher la vue précédente
        document.querySelector('.downGamingContent').style.display = 'none';
        // Cacher le bouton "Voir plus"
        document.getElementById('showMoreGaming').style.display = 'none';
    });

    document.getElementById('showLessGaming').addEventListener('click', function () {
        // Cacher le contenu complet de gaming
        document.getElementById('hiddenGamingContent').style.display = 'none';
        // Afficher la vue précédente
        document.querySelector('.downGamingContent').style.display = 'block';
        // Afficher le bouton "Voir plus"
        document.getElementById('showMoreGaming').style.display = 'inline';
    });
});

document.getElementById('contactButton').addEventListener('click', function (event) {
    event.preventDefault();  // Empêche le comportement par défaut du lien
    var contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
    contactModal.show();
});