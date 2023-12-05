"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./styles/app.scss */ "./assets/styles/app.scss");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! bootstrap */ "../../../../node_modules/bootstrap/dist/js/bootstrap.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(bootstrap__WEBPACK_IMPORTED_MODULE_2__);


// import 'dropzone/dist/dropzone.css';
// import Dropzone from 'dropzone/dist/dropzone.js';

Dropzone.autoDiscover = false;


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
  success: function success(file, response) {
    file.serverFileName = response.fileName; // Assurez-vous que votre réponse d'upload contient le nom de fichier
  },
  // Gestionnaire pour la suppression des fichiers
  removedfile: function removedfile(file) {
    var name = file.serverFileName || file.name; // Utilisez le nom de fichier modifié s'il est disponible

    // Appel AJAX pour la suppression de l'image
    $.ajax({
      type: 'POST',
      url: '/delete-image',
      data: {
        name: name
      },
      success: function success(data) {
        console.log('Réponse du serveur: ' + data.message);
      },
      error: function error(err) {
        console.error('Erreur de suppression: ', err);
      }
    });

    // Supprimer l'élément de l'interface utilisateur
    var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  }
});
$(document).ready(function () {
  $.ajax({
    type: 'POST',
    url: '/clear-temp-images',
    success: function success(data) {
      console.log(data.message);
    },
    error: function error(err) {
      console.error('Erreur lors du nettoyage des images temporaires: ', err);
    }
  });
});
console.log(myDropzone);
console.log('salut');

/***/ }),

/***/ "./assets/styles/app.scss":
/*!********************************!*\
  !*** ./assets/styles/app.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_bootstrap_dist_js_bootstrap_js-node_modules_core-js_modules_es_function_-4be2db"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBMkI7QUFDM0I7QUFDQTs7QUFFQUEsUUFBUSxDQUFDQyxZQUFZLEdBQUcsS0FBSztBQUd1Qjs7QUFFcEQ7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQUQsUUFBUSxDQUFDQyxZQUFZLEdBQUcsS0FBSzs7QUFFN0I7QUFDQSxJQUFJSSxVQUFVLEdBQUcsSUFBSUwsUUFBUSxDQUFDLGNBQWMsRUFBRTtFQUMxQ00sR0FBRyxFQUFFLGdCQUFnQjtFQUNyQkMsV0FBVyxFQUFFLENBQUM7RUFDZEMsYUFBYSxFQUFFLFNBQVM7RUFDeEJDLGNBQWMsRUFBRSxJQUFJO0VBQ3BCQyxrQkFBa0IsRUFBRSxtREFBbUQ7RUFFdkU7RUFDQUMsT0FBTyxFQUFFLFNBQUFBLFFBQVNDLElBQUksRUFBRUMsUUFBUSxFQUFFO0lBQzlCRCxJQUFJLENBQUNFLGNBQWMsR0FBR0QsUUFBUSxDQUFDRSxRQUFRLENBQUMsQ0FBQztFQUM3QyxDQUFDO0VBRUQ7RUFDQUMsV0FBVyxFQUFFLFNBQUFBLFlBQVNKLElBQUksRUFBRTtJQUN4QixJQUFJSyxJQUFJLEdBQUdMLElBQUksQ0FBQ0UsY0FBYyxJQUFJRixJQUFJLENBQUNLLElBQUksQ0FBQyxDQUFDOztJQUU3QztJQUNBQyxDQUFDLENBQUNDLElBQUksQ0FBQztNQUNIQyxJQUFJLEVBQUUsTUFBTTtNQUNaZCxHQUFHLEVBQUUsZUFBZTtNQUNwQmUsSUFBSSxFQUFFO1FBQUVKLElBQUksRUFBRUE7TUFBSyxDQUFDO01BQ3BCTixPQUFPLEVBQUUsU0FBQUEsUUFBU1UsSUFBSSxFQUFFO1FBQ3BCQyxPQUFPLENBQUNDLEdBQUcsQ0FBQyxzQkFBc0IsR0FBR0YsSUFBSSxDQUFDRyxPQUFPLENBQUM7TUFDdEQsQ0FBQztNQUNEQyxLQUFLLEVBQUUsU0FBQUEsTUFBU0MsR0FBRyxFQUFFO1FBQ2pCSixPQUFPLENBQUNHLEtBQUssQ0FBQyx5QkFBeUIsRUFBRUMsR0FBRyxDQUFDO01BQ2pEO0lBQ0osQ0FBQyxDQUFDOztJQUVGO0lBQ0EsSUFBSUMsSUFBSTtJQUNSLE9BQU8sQ0FBQ0EsSUFBSSxHQUFHZixJQUFJLENBQUNnQixjQUFjLEtBQUssSUFBSSxHQUFHRCxJQUFJLENBQUNFLFVBQVUsQ0FBQ0MsV0FBVyxDQUFDbEIsSUFBSSxDQUFDZ0IsY0FBYyxDQUFDLEdBQUcsS0FBSyxDQUFDO0VBQzNHO0FBQ0osQ0FBQyxDQUFDO0FBRUZWLENBQUMsQ0FBQ2EsUUFBUSxDQUFDLENBQUNDLEtBQUssQ0FBQyxZQUFXO0VBQ3pCZCxDQUFDLENBQUNDLElBQUksQ0FBQztJQUNIQyxJQUFJLEVBQUUsTUFBTTtJQUNaZCxHQUFHLEVBQUUsb0JBQW9CO0lBQ3pCSyxPQUFPLEVBQUUsU0FBQUEsUUFBU1UsSUFBSSxFQUFFO01BQ3BCQyxPQUFPLENBQUNDLEdBQUcsQ0FBQ0YsSUFBSSxDQUFDRyxPQUFPLENBQUM7SUFDN0IsQ0FBQztJQUNEQyxLQUFLLEVBQUUsU0FBQUEsTUFBU0MsR0FBRyxFQUFFO01BQ2pCSixPQUFPLENBQUNHLEtBQUssQ0FBQyxtREFBbUQsRUFBRUMsR0FBRyxDQUFDO0lBQzNFO0VBQ0osQ0FBQyxDQUFDO0FBQ04sQ0FBQyxDQUFDO0FBR0ZKLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDbEIsVUFBVSxDQUFDO0FBR3ZCaUIsT0FBTyxDQUFDQyxHQUFHLENBQUMsT0FBTyxDQUFDOzs7Ozs7Ozs7OztBQ3pFcEIiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLnNjc3M/OGY1OSJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4vc3R5bGVzL2FwcC5zY3NzJztcclxuLy8gaW1wb3J0ICdkcm9wem9uZS9kaXN0L2Ryb3B6b25lLmNzcyc7XHJcbi8vIGltcG9ydCBEcm9wem9uZSBmcm9tICdkcm9wem9uZS9kaXN0L2Ryb3B6b25lLmpzJztcclxuXHJcbkRyb3B6b25lLmF1dG9EaXNjb3ZlciA9IGZhbHNlO1xyXG5cclxuXHJcbmltcG9ydCB7IFRvb2x0aXAsIFRvYXN0LCBQb3BvdmVyIH0gZnJvbSAnYm9vdHN0cmFwJztcclxuXHJcbi8vIGNvbnN0IG15RHJvcHpvbmUgPSBuZXcgRHJvcHpvbmUoJy5kcm9wem9uZS1jb250YWluZXInLCB7XHJcbi8vICAgICB1cmw6ICcvYWpvdXRlci11bmUtbm91dmVsbGUtYW5ub25jZScsXHJcbi8vICAgICBtYXhGaWxlc2l6ZTogMixcclxuLy8gICAgIGFjY2VwdGVkRmlsZXM6ICdpbWFnZS8qJyxcclxuLy8gICAgIGFkZFJlbW92ZUxpbmtzOiB0cnVlLFxyXG4vLyAgICAgZGljdERlZmF1bHRNZXNzYWdlOiBcIkTDqXBvc2V6IGxlcyBmaWNoaWVycyBpY2kgb3UgY2xpcXVleiBwb3VyIG5hdmlndWVyXCJcclxuLy8gfSk7XHJcblxyXG4vLyBBc3N1cmV6LXZvdXMgcXVlIERyb3B6b25lIG4nZXN0IHBhcyBhdXRvbWF0aXF1ZW1lbnQgZMOpY291dmVydFxyXG5Ecm9wem9uZS5hdXRvRGlzY292ZXIgPSBmYWxzZTtcclxuXHJcbi8vIEluaXRpYWxpc2V6IHZvdHJlIGluc3RhbmNlIERyb3B6b25lXHJcbnZhciBteURyb3B6b25lID0gbmV3IERyb3B6b25lKFwiI21vbkRyb3B6b25lXCIsIHtcclxuICAgIHVybDogXCIvdXBsb2FkLWltYWdlc1wiLFxyXG4gICAgbWF4RmlsZXNpemU6IDIsXHJcbiAgICBhY2NlcHRlZEZpbGVzOiBcImltYWdlLypcIixcclxuICAgIGFkZFJlbW92ZUxpbmtzOiB0cnVlLFxyXG4gICAgZGljdERlZmF1bHRNZXNzYWdlOiBcIkTDqXBvc2V6IGxlcyBmaWNoaWVycyBpY2kgb3UgY2xpcXVleiBwb3VyIG5hdmlndWVyXCIsXHJcblxyXG4gICAgLy8gQWpvdXRleiB1bmUgcHJvcHJpw6l0w6kgcGVyc29ubmFsaXPDqWUgcG91ciBzdG9ja2VyIGxlIG5vbSBkZSBmaWNoaWVyIG1vZGlmacOpIGxvcnMgZGUgbCd1cGxvYWQgcsOpdXNzaVxyXG4gICAgc3VjY2VzczogZnVuY3Rpb24oZmlsZSwgcmVzcG9uc2UpIHtcclxuICAgICAgICBmaWxlLnNlcnZlckZpbGVOYW1lID0gcmVzcG9uc2UuZmlsZU5hbWU7IC8vIEFzc3VyZXotdm91cyBxdWUgdm90cmUgcsOpcG9uc2UgZCd1cGxvYWQgY29udGllbnQgbGUgbm9tIGRlIGZpY2hpZXJcclxuICAgIH0sXHJcblxyXG4gICAgLy8gR2VzdGlvbm5haXJlIHBvdXIgbGEgc3VwcHJlc3Npb24gZGVzIGZpY2hpZXJzXHJcbiAgICByZW1vdmVkZmlsZTogZnVuY3Rpb24oZmlsZSkge1xyXG4gICAgICAgIHZhciBuYW1lID0gZmlsZS5zZXJ2ZXJGaWxlTmFtZSB8fCBmaWxlLm5hbWU7IC8vIFV0aWxpc2V6IGxlIG5vbSBkZSBmaWNoaWVyIG1vZGlmacOpIHMnaWwgZXN0IGRpc3BvbmlibGVcclxuXHJcbiAgICAgICAgLy8gQXBwZWwgQUpBWCBwb3VyIGxhIHN1cHByZXNzaW9uIGRlIGwnaW1hZ2VcclxuICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICB0eXBlOiAnUE9TVCcsXHJcbiAgICAgICAgICAgIHVybDogJy9kZWxldGUtaW1hZ2UnLFxyXG4gICAgICAgICAgICBkYXRhOiB7IG5hbWU6IG5hbWUgfSxcclxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSkge1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ1LDqXBvbnNlIGR1IHNlcnZldXI6ICcgKyBkYXRhLm1lc3NhZ2UpO1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24oZXJyKSB7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgZGUgc3VwcHJlc3Npb246ICcsIGVycik7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gU3VwcHJpbWVyIGwnw6lsw6ltZW50IGRlIGwnaW50ZXJmYWNlIHV0aWxpc2F0ZXVyXHJcbiAgICAgICAgdmFyIF9yZWY7XHJcbiAgICAgICAgcmV0dXJuIChfcmVmID0gZmlsZS5wcmV2aWV3RWxlbWVudCkgIT0gbnVsbCA/IF9yZWYucGFyZW50Tm9kZS5yZW1vdmVDaGlsZChmaWxlLnByZXZpZXdFbGVtZW50KSA6IHZvaWQgMDtcclxuICAgIH1cclxufSk7XHJcblxyXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgICQuYWpheCh7XHJcbiAgICAgICAgdHlwZTogJ1BPU1QnLFxyXG4gICAgICAgIHVybDogJy9jbGVhci10ZW1wLWltYWdlcycsXHJcbiAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSkge1xyXG4gICAgICAgICAgICBjb25zb2xlLmxvZyhkYXRhLm1lc3NhZ2UpO1xyXG4gICAgICAgIH0sXHJcbiAgICAgICAgZXJyb3I6IGZ1bmN0aW9uKGVycikge1xyXG4gICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgbG9ycyBkdSBuZXR0b3lhZ2UgZGVzIGltYWdlcyB0ZW1wb3JhaXJlczogJywgZXJyKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufSk7XHJcblxyXG5cclxuY29uc29sZS5sb2cobXlEcm9wem9uZSlcclxuXHJcblxyXG5jb25zb2xlLmxvZygnc2FsdXQnKSIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJEcm9wem9uZSIsImF1dG9EaXNjb3ZlciIsIlRvb2x0aXAiLCJUb2FzdCIsIlBvcG92ZXIiLCJteURyb3B6b25lIiwidXJsIiwibWF4RmlsZXNpemUiLCJhY2NlcHRlZEZpbGVzIiwiYWRkUmVtb3ZlTGlua3MiLCJkaWN0RGVmYXVsdE1lc3NhZ2UiLCJzdWNjZXNzIiwiZmlsZSIsInJlc3BvbnNlIiwic2VydmVyRmlsZU5hbWUiLCJmaWxlTmFtZSIsInJlbW92ZWRmaWxlIiwibmFtZSIsIiQiLCJhamF4IiwidHlwZSIsImRhdGEiLCJjb25zb2xlIiwibG9nIiwibWVzc2FnZSIsImVycm9yIiwiZXJyIiwiX3JlZiIsInByZXZpZXdFbGVtZW50IiwicGFyZW50Tm9kZSIsInJlbW92ZUNoaWxkIiwiZG9jdW1lbnQiLCJyZWFkeSJdLCJzb3VyY2VSb290IjoiIn0=