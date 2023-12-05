import './styles/app.scss';
// import 'dropzone/dist/dropzone.css';
// import Dropzone from 'dropzone/dist/dropzone.js';

Dropzone.autoDiscover = false;


import { Tooltip, Toast, Popover } from 'bootstrap';

// const myDropzone = new Dropzone('.dropzone-container', {
//     url: '/ajouter-une-nouvelle-annonce',
//     maxFilesize: 2,
//     acceptedFiles: 'image/*',
//     addRemoveLinks: true,
//     dictDefaultMessage: "Déposez les fichiers ici ou cliquez pour naviguer"
// });

// Assurez-vous que Dropzone n'est pas automatiquement découvert
Dropzone.autoDiscover = false;

// Initialisez votre instance Dropzone
var myDropzone = new Dropzone("#monDropzone", {
    url: "/upload-images",
    maxFilesize: 2,
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    dictDefaultMessage: "Déposez les fichiers ici ou cliquez pour naviguer",

    // Ajoutez une propriété personnalisée pour stocker le nom de fichier modifié lors de l'upload réussi
    success: function(file, response) {
        file.serverFileName = response.fileName; // Assurez-vous que votre réponse d'upload contient le nom de fichier
    },

    // Gestionnaire pour la suppression des fichiers
    removedfile: function(file) {
        var name = file.serverFileName || file.name; // Utilisez le nom de fichier modifié s'il est disponible

        // Appel AJAX pour la suppression de l'image
        $.ajax({
            type: 'POST',
            url: '/delete-image',
            data: { name: name },
            success: function(data) {
                console.log('Réponse du serveur: ' + data.message);
            },
            error: function(err) {
                console.error('Erreur de suppression: ', err);
            }
        });

        // Supprimer l'élément de l'interface utilisateur
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
});

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '/clear-temp-images',
        success: function(data) {
            console.log(data.message);
        },
        error: function(err) {
            console.error('Erreur lors du nettoyage des images temporaires: ', err);
        }
    });
});


console.log(myDropzone)


console.log('salut')