
    const tripToggle = document.getElementById("trip-toggle");
    const tripFormContainer = document.querySelector(".trip-container");
    const tripForm = document.getElementById("form-new-trip");

    const btnSubmitTripForm = document.getElementById("btn-new-trip-submit");

    function updateTripInfo(start, stops, end) {
        document.getElementById("start-text").textContent = start;
        document.getElementById("stops-text").textContent = stops;
        document.getElementById("end-text").textContent = end;
    }

    btnSubmitTripForm.addEventListener("click", function(event) {

        const start = document.getElementById("start").value;
        const stops = document.getElementById("stops").value;
        const end = document.getElementById("end").value;

        updateTripInfo(start, stops, end);

    });



    


 
