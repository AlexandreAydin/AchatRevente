"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.scss */ "./assets/styles/app.scss");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! bootstrap */ "../../../../node_modules/bootstrap/dist/js/bootstrap.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(bootstrap__WEBPACK_IMPORTED_MODULE_1__);

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

var myDropzone = new Dropzone('.dropzone-container', {
  url: '/upload-images',
  maxFilesize: 2,
  acceptedFiles: 'image/*',
  addRemoveLinks: true,
  dictDefaultMessage: "Déposez les fichiers ici ou cliquez pour naviguer"
});
console.log(myDropzone);
console.log('salit');

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
/******/ __webpack_require__.O(0, ["vendors-node_modules_bootstrap_dist_js_bootstrap_js"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7QUFBMkI7QUFDM0I7QUFDQTs7QUFFQUEsUUFBUSxDQUFDQyxZQUFZLEdBQUcsS0FBSztBQUd1Qjs7QUFFcEQ7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUEsSUFBTUksVUFBVSxHQUFHLElBQUlMLFFBQVEsQ0FBQyxxQkFBcUIsRUFBRTtFQUNuRE0sR0FBRyxFQUFFLGdCQUFnQjtFQUNyQkMsV0FBVyxFQUFFLENBQUM7RUFDZEMsYUFBYSxFQUFFLFNBQVM7RUFDeEJDLGNBQWMsRUFBRSxJQUFJO0VBQ3BCQyxrQkFBa0IsRUFBRTtBQUN4QixDQUFDLENBQUM7QUFHRkMsT0FBTyxDQUFDQyxHQUFHLENBQUNQLFVBQVUsQ0FBQztBQUd2Qk0sT0FBTyxDQUFDQyxHQUFHLENBQUMsT0FBTyxDQUFDOzs7Ozs7Ozs7OztBQzdCcEIiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLnNjc3MiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0ICcuL3N0eWxlcy9hcHAuc2Nzcyc7XHJcbi8vIGltcG9ydCAnZHJvcHpvbmUvZGlzdC9kcm9wem9uZS5jc3MnO1xyXG4vLyBpbXBvcnQgRHJvcHpvbmUgZnJvbSAnZHJvcHpvbmUvZGlzdC9kcm9wem9uZS5qcyc7XHJcblxyXG5Ecm9wem9uZS5hdXRvRGlzY292ZXIgPSBmYWxzZTtcclxuXHJcblxyXG5pbXBvcnQgeyBUb29sdGlwLCBUb2FzdCwgUG9wb3ZlciB9IGZyb20gJ2Jvb3RzdHJhcCc7XHJcblxyXG4vLyBjb25zdCBteURyb3B6b25lID0gbmV3IERyb3B6b25lKCcuZHJvcHpvbmUtY29udGFpbmVyJywge1xyXG4vLyAgICAgdXJsOiAnL2Fqb3V0ZXItdW5lLW5vdXZlbGxlLWFubm9uY2UnLFxyXG4vLyAgICAgbWF4RmlsZXNpemU6IDIsXHJcbi8vICAgICBhY2NlcHRlZEZpbGVzOiAnaW1hZ2UvKicsXHJcbi8vICAgICBhZGRSZW1vdmVMaW5rczogdHJ1ZSxcclxuLy8gICAgIGRpY3REZWZhdWx0TWVzc2FnZTogXCJEw6lwb3NleiBsZXMgZmljaGllcnMgaWNpIG91IGNsaXF1ZXogcG91ciBuYXZpZ3VlclwiXHJcbi8vIH0pO1xyXG5cclxuY29uc3QgbXlEcm9wem9uZSA9IG5ldyBEcm9wem9uZSgnLmRyb3B6b25lLWNvbnRhaW5lcicsIHtcclxuICAgIHVybDogJy91cGxvYWQtaW1hZ2VzJyxcclxuICAgIG1heEZpbGVzaXplOiAyLFxyXG4gICAgYWNjZXB0ZWRGaWxlczogJ2ltYWdlLyonLFxyXG4gICAgYWRkUmVtb3ZlTGlua3M6IHRydWUsXHJcbiAgICBkaWN0RGVmYXVsdE1lc3NhZ2U6IFwiRMOpcG9zZXogbGVzIGZpY2hpZXJzIGljaSBvdSBjbGlxdWV6IHBvdXIgbmF2aWd1ZXJcIlxyXG59KTtcclxuXHJcblxyXG5jb25zb2xlLmxvZyhteURyb3B6b25lKVxyXG5cclxuXHJcbmNvbnNvbGUubG9nKCdzYWxpdCcpIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbIkRyb3B6b25lIiwiYXV0b0Rpc2NvdmVyIiwiVG9vbHRpcCIsIlRvYXN0IiwiUG9wb3ZlciIsIm15RHJvcHpvbmUiLCJ1cmwiLCJtYXhGaWxlc2l6ZSIsImFjY2VwdGVkRmlsZXMiLCJhZGRSZW1vdmVMaW5rcyIsImRpY3REZWZhdWx0TWVzc2FnZSIsImNvbnNvbGUiLCJsb2ciXSwic291cmNlUm9vdCI6IiJ9