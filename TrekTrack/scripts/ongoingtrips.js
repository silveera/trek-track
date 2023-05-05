import { timeStamper, userData } from "./util.js";

const tripToggle = document.getElementById("trip-toggle");
const tripFormContainer = document.querySelector(".trip-container");
const tripForm = document.getElementById("form-new-trip");
const tempTrip = document.getElementById("template-trip");
const contTrips = document.querySelector(".feed-trips");

const noTrips = document.querySelector(".container-p-no-trips");

const btnSubmitTripForm = document.getElementById("btn-new-trip-submit");

const ongoingTrip = document.querySelector(".current-trip");
const invisTrip = document.querySelector(".trip-cont-invis");
const noOngoingTrip = document.querySelector(".no-ongoing-trips");

/* function updateTripInfo(start, stops, end) {
    document.getElementById("start-text").innerText = start;
    document.getElementById("stops-text").innerText = stops;
    document.getElementById("end-text").innerText = end;
}

btnSubmitTripForm.addEventListener("click", function (event) {

    const start = document.getElementById("start").value;
    const stops = document.getElementById("stops").value;
    const end = document.getElementById("end").value;

    updateTripInfo(start, stops, end);

}); */

const params = new URLSearchParams(window.location.search);
let profileID = params.get("id");

if (!profileID) {
    profileID = userData["user_id"];
}

async function logTripsData() {
    
    const response = await fetch("php/submit-trip.php?" + "id=" + profileID);
    const jsonTripData = await response.json();
    console.log(jsonTripData); /* For debugging purposes */
    return jsonTripData;
};

let tripContent = await logTripsData();

tripContent.forEach(function (trip) {
    if ('content' in document.createElement('template') && (window.location.href.includes("profile.php"))) {
        if (trip["user_id"] == profileID) {
            contTrips.style.display = "grid";
            noTrips.remove();

            const tripClone = tempTrip.content.cloneNode(true);

            tripClone.querySelector(".container-ongoing-trip").setAttribute("id", "id" + trip["trip_id"]);

            if (trip["trip_title"]) {
                tripClone.querySelector(".trip-title").innerText = trip["trip_title"];
            } else if (!trip["trip_title"]) {
                tripClone.querySelector(".trip-title").innerText = "From " + trip["trip_start"] + " to " + trip["trip_end"];
            }

            console.log(tripClone.querySelector(".trip-title").innerText);

            tripClone.querySelector(".trip-start").innerText = trip["trip_start"];

            if (trip["trip_stop"] === "") {
                tripClone.querySelectorAll(".cont-line")[1].remove();
                tripClone.querySelector(".trip-stop").remove();
            } else {
                tripClone.querySelector(".trip-stops").innerText = trip["trip_stop"];
            }

            tripClone.querySelector(".trip-end").innerText = trip["trip_end"];
            tripClone.querySelector(".trip-timestamp").innerText = timeStamper(trip["created_at"]);

            if (trip["status"] == "1" && trip["user_id"] == userData["user_id"]) {
                tripClone.querySelector(".button-ongoing-trip").style.color = "var(--accent-tint-1)";
                tripClone.querySelector(".container-ongoing-trip").style.backgroundColor = "var(--secondary-tint-1)";
                tripClone.querySelector(".container-ongoing-trip").classList.add("trip-selected");

                invisTrip.style.display = "block";
                noOngoingTrip.style.display = "none";

                ongoingTrip.querySelector(".trip-title").innerText = tripClone.querySelector(".trip-title").innerText;
                ongoingTrip.querySelector(".trip-start").innerText = trip["trip_start"];

                if (trip["trip_stop"] === "") {
                    ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "none";
                    ongoingTrip.querySelector(".trip-stop").style.display = "none";
                } else {
                    ongoingTrip.querySelector(".trip-stops").innerText = trip["trip_stop"];
                    ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "flex";
                    ongoingTrip.querySelector(".trip-stop").style.display = "flex";
                }

                ongoingTrip.querySelector(".trip-end").innerText = trip["trip_end"];
                ongoingTrip.querySelector(".trip-timestamp").innerText = timeStamper(trip["created_at"]);
            } 

            contTrips.appendChild(tripClone);
        } else if (trip["status"] == "1") {
            invisTrip.style.display = "block";
            noOngoingTrip.style.display = "none";

            if (trip["trip_title"]) {
                ongoingTrip.querySelector(".trip-title").innerText = trip["trip_title"];
            } else if (!trip["trip_title"]) {
                ongoingTrip.querySelector(".trip-title").innerText = "From " + trip["trip_start"] + " to " + trip["trip_end"];
            }
            
            ongoingTrip.querySelector(".trip-start").innerText = trip["trip_start"];

            if (trip["trip_stop"] === "") {
                ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "none";
                ongoingTrip.querySelector(".trip-stop").style.display = "none";
            } else {
                ongoingTrip.querySelector(".trip-stops").innerText = trip["trip_stop"];
                ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "flex";
                ongoingTrip.querySelector(".trip-stop").style.display = "flex";
            }

            ongoingTrip.querySelector(".trip-end").innerText = trip["trip_end"];
            ongoingTrip.querySelector(".trip-timestamp").innerText = timeStamper(trip["created_at"]);
        }

    } else if (trip["status"] == "1") {
        invisTrip.style.display = "block";
        noOngoingTrip.style.display = "none";

        if (trip["trip_title"]) {
            ongoingTrip.querySelector(".trip-title").innerText = trip["trip_title"];
        } else if (!trip["trip_title"]) {
            ongoingTrip.querySelector(".trip-title").innerText = "From " + trip["trip_start"] + " to " + trip["trip_end"];
        }
        
        ongoingTrip.querySelector(".trip-start").innerText = trip["trip_start"];

        if (trip["trip_stop"] === "") {
            ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "none";
            ongoingTrip.querySelector(".trip-stop").style.display = "none";
        } else {
            ongoingTrip.querySelector(".trip-stops").innerText = trip["trip_stop"];
            ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "flex";
            ongoingTrip.querySelector(".trip-stop").style.display = "flex";
        }

        ongoingTrip.querySelector(".trip-end").innerText = trip["trip_end"];
        ongoingTrip.querySelector(".trip-timestamp").innerText = timeStamper(trip["created_at"]);
    }
});

function handleClick(tripID, toggleTo, tripContainerParam) {
    $.ajax({
        url: "php/submit-trip.php",
        type: "POST",
        data: {
            trip_id: tripID,
            action: "toggleOngoing",
            toggleTo: toggleTo
        },
        success: function (response) {
            if (toggleTo == 1) {
                invisTrip.style.display = "block";
                noOngoingTrip.style.display = "none";

                ongoingTrip.querySelector(".trip-title").innerText = tripContainerParam.find(".trip-title").text();
                ongoingTrip.querySelector(".trip-start").innerText = tripContainerParam.find(".trip-start").text();

                if (tripContainerParam.find(".trip-stops").text() === "") {
                    ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "none";
                    ongoingTrip.querySelector(".trip-stop").style.display = "none";
                } else {
                    ongoingTrip.querySelector(".trip-stops").innerText = tripContainerParam.find(".trip-stops").text();
                    ongoingTrip.querySelectorAll(".cont-line")[1].style.display = "flex";
                    ongoingTrip.querySelector(".trip-stop").style.display = "flex";
                }

                ongoingTrip.querySelector(".trip-end").innerText = tripContainerParam.find(".trip-end").text();
                ongoingTrip.querySelector(".trip-timestamp").innerText = tripContainerParam.find(".trip-timestamp").text();
            } else if (toggleTo == 0 && $(".trip-selected").length == 0) {
                invisTrip.style.display = "none";
                noOngoingTrip.style.display = "block";
            }
        }
    });
}

$(document).on("click", ".button-ongoing-trip", function () {
    let tripContainer = $(this).closest(".container-ongoing-trip");
    let tripID = tripContainer.attr("id").replace("id", "");
    let toggleTo = 1;

    if (tripContainer.hasClass("trip-selected")) {
        tripContainer.css("background-color", "var(--invert-neutral-color-shade-1)");
        $(this).css("color", "var(--neutral-color)");
        tripContainer.removeClass("trip-selected");
        toggleTo = 0;
    } else if ($(".trip-selected").length > 0 && !tripContainer.hasClass("trip-selected")) {
        $(".trip-selected").css("background-color", "var(--invert-neutral-color-shade-1)");
        $(".trip-selected").find(".button-ongoing-trip").css("color", "var(--neutral-color)");

        handleClick($(".trip-selected").attr("id").replace("id", ""), 0);

        $(".trip-selected").removeClass("trip-selected");

        $(this).css("color", "var(--accent-tint-1)");
        tripContainer.css("background-color", "var(--secondary-tint-1");
        tripContainer.addClass("trip-selected");
    } else {
        $(this).css("color", "var(--accent-tint-1)");
        tripContainer.css("background-color", "var(--secondary-tint-1");
        tripContainer.addClass("trip-selected");
    }

    console.log("INFO: " + tripContainer.find(".trip-title").text(), tripContainer.find(".trip-start").text(), tripContainer.find(".trip-stops").text(), tripContainer.find(".trip-end").text(), tripContainer.find(".trip-timestamp").text());
    handleClick(tripID, toggleTo, tripContainer);
});




