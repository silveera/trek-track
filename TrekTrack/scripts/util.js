export function preventEnterKey(event) {
    if (event.key === "Enter") {
      event.preventDefault();
    }
};

export function autoResize() {
    this.style.height = 'auto';
    if (this.scrollHeight > 0) {
    this.style.height = (this.scrollHeight) + "px";
    };
};

export function removeWhiteSpace() {
    this.value  = this.value.replace(/\s+/g, ' ').trim();
};

export function textAreaEvents () {
    this.addEventListener('input', autoResize);
    this.addEventListener('focus', autoResize);
    this.addEventListener('blur', autoResize);
    this.addEventListener('blur', removeWhiteSpace);
    this.addEventListener('keydown', preventEnterKey);
    autoResize.call(this);
};

export function submitForm(formID, scriptURL) {
    // Collect the form data
    const formData = new FormData($(formID)[0]);
    // Submit the form data using AJAX
    $.ajax({
        url: scriptURL, // Replace with the URL to your server-side script
        type: "POST",
        data: formData,
        processData: false, // Required when sending FormData object
        contentType: false,
        success: function () {
            console.log("Form submitted successfully.");
            // Handle a successful submission (e.g., display a message, clear the form, etc.)
        },
        error: function () {
            console.log("Error submitting the form.");
        }
    });
};

export function preventReloadSubmit(formID, scriptURL) {
    $(formID).on("submit", function (event) {
        event.preventDefault(); // Prevent the form from reloading the page
        submitForm(formID, scriptURL);
    });
};

async function logJSONData() {
    const response = await fetch("php/user-info-json.php");
    const jsonData = await response.json();
    console.log(jsonData); /* For debugging purposes */
    return jsonData;
};

export let userData = await logJSONData();

const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
};

export function escapeHtml(text) {
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
};

export function timeStamper(date) {
    const timestamp = new Date(date);

    const secondsAgo = Math.floor((new Date() - timestamp) / 1000);

    let displayTime;
    if (secondsAgo < 60) {
      displayTime = `${secondsAgo} ${secondsAgo === 1 ? 'second' : 'seconds'} ago`;
    } else if (secondsAgo < 60 * 60) {
      const minutesAgo = Math.floor(secondsAgo / 60);
      displayTime = `${minutesAgo} ${minutesAgo === 1 ? 'minute' : 'minutes'} ago`;
    } else if (secondsAgo < 60 * 60 * 24) {
      const hoursAgo = Math.floor(secondsAgo / (60 * 60));
      displayTime = `${hoursAgo} ${hoursAgo === 1 ? 'hour' : 'hours'} ago`;
    } else if (secondsAgo < 60 * 60 * 24 * 7) {
      const daysAgo = Math.floor(secondsAgo / (60 * 60 * 24));
      displayTime = `${daysAgo} ${daysAgo === 1 ? 'day' : 'days'} ago`;
    } else if (secondsAgo < 60 * 60 * 24 * 30) {
      const weeksAgo = Math.floor(secondsAgo / (60 * 60 * 24 * 7));
      displayTime = `${weeksAgo} ${weeksAgo === 1 ? 'week' : 'weeks'} ago`;
    } else {
      const monthsAgo = Math.floor(secondsAgo / (60 * 60 * 24 * 30));
      displayTime = `${monthsAgo} ${monthsAgo === 1 ? 'month' : 'months'} ago`;
    }

    return displayTime;
}

export function autoResizeTextInput() {
  this.style.width = this.getAttribute("placeholder").length + "ch";

  if (this.value.length >= this.getAttribute("placeholder").length) {
    this.style.width = this.value.length + "ch";
  } 
}