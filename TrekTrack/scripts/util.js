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

/* async function logJSONData() {
    const response = await fetch("php/user-info.php");
    const jsonData = await response.json();
    console.log(jsonData); For debugging purposes
    return jsonData;
};

export let userData = await logJSONData();
 */
    
/* export let userData;

logJSONData().then (promiseUserData => {

    console.log(promiseUserData["user_name"]);
    userData = promiseUserData;
}); */

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