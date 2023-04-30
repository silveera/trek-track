import { autoResize, removeWhiteSpace, preventEnterKey } from './util.js';

console.log("modal.js loaded successfully.");
const modalNewTrip = document.getElementById("modal-new-trip");

const txtNewTripTitle = document.getElementById("new-trip-title");

const btnNewTripSubmit = document.getElementById("button-new-trip-submit");

const btnNewTripCancel = document.querySelectorAll(".modal-close");

const btnNewTripModal = document.getElementById("button-p-new-trip");

const btnFirstTripModal = document.getElementById("button-first-trip");


btnNewTripModal.onclick = function () {
    modalNewTrip.style.display = "flex";
    autoResize.call(txtNewTripTitle);
};

btnFirstTripModal.onclick = function () {
    modalNewTrip.style.display = "flex";
    autoResize.call(txtNewTripTitle);
};

btnNewTripCancel.forEach(element => {
    element.addEventListener('click', function () {
    modalNewTrip.style.display = "none";
    })
});