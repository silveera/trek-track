document.addEventListener("DOMContentLoaded", function() {
    const tripToggle = document.getElementById("trip-toggle");
    const tripFormContainer = document.getElementById("trip-form-container");
    const tripForm = document.getElementById("trip-form");

    tripToggle.addEventListener("click", function() {
        tripFormContainer.style.display = tripFormContainer.style.display === "none" ? "block" : "none";
    });

    tripForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const start = document.getElementById("start").value;
        const stops = document.getElementById("stops").value.split(",");
        const end = document.getElementById("end").value;

        updateTripInfo(start, stops, end);
        tripFormContainer.style.display = "none";
    });

    function updateTripInfo(start, stops, end) {
        document.getElementById("start-text").textContent = start;
        document.getElementById("stops-text").textContent = stops.join(", ");
        document.getElementById("end-text").textContent = end;
    }
});
