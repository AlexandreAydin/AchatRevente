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

const myDropzone = new Dropzone('.dropzone-container', {
    url: '/upload-images',
    maxFilesize: 2,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    dictDefaultMessage: "Déposez les fichiers ici ou cliquez pour naviguer"
});


console.log(myDropzone)


console.log('salit')