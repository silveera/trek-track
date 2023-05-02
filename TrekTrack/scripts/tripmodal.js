import { autoResize, removeWhiteSpace, preventEnterKey, autoResizeTextInput } from './util.js';

console.log("modal.js loaded successfully.");
const modalNewTrip = document.getElementById("modal-new-trip");

const txtNewTripTitle = document.getElementById("new-trip-title");

const btnNewTripSubmit = document.getElementById("btn-new-trip-submit");

const btnNewTripCancel = document.querySelectorAll(".modal-close");

const btnNewTripModal = document.getElementById("button-p-new-trip");

const btnFirstTripModal = document.getElementById("button-first-trip");

const txtNewTripInputs = document.querySelectorAll(".new-trip-input");

const containerPTrips = document.querySelector(".container-p-trips");
const containerPPosts = document.querySelector(".container-p-posts");


txtNewTripTitle.addEventListener('input', autoResize);
txtNewTripTitle.addEventListener('focus', autoResize);
txtNewTripTitle.addEventListener('blur', autoResize);

txtNewTripTitle.addEventListener('blur', removeWhiteSpace);
txtNewTripTitle.addEventListener('focus', removeWhiteSpace);
txtNewTripTitle.addEventListener('keydown', preventEnterKey);

if (window.location.hash === "#ongoing-trips") {
    containerPPosts.style.display = "none";
    containerPTrips.style.display = "flex";
}

const tripLinks = document.querySelectorAll("a[href='profile.php#ongoing-trips']");

tripLinks.forEach(element => {
    element.addEventListener('click', function () {
        window.location.reload();
    });
});

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

txtNewTripTitle.addEventListener('input', function () {
    btnNewTripSubmit.setAttribute("type", "submit");
});

txtNewTripInputs.forEach(element => {
    autoResizeTextInput.call(element);
    element.addEventListener('input', function () {
        autoResizeTextInput.call(element);
        btnNewTripSubmit.setAttribute("type", "submit");
    });
    element.addEventListener('focus', autoResizeTextInput);
    element.addEventListener('blur', autoResizeTextInput);

    element.addEventListener('blur', removeWhiteSpace);
    element.addEventListener('focus', removeWhiteSpace);
});

