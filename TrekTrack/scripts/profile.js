import { /* userData */ autoResize, removeWhiteSpace, preventEnterKey, preventReloadSubmit} from './util.js';

const avatarP = document.getElementById("p-avatar");

const buttonEditP = document.getElementById("button-p-edit");

const txtBio = document.getElementById("text-p-bio");

const contBioTxtP = document.getElementById("container-p-bio-text");

const labelInputPAvatar = $("#label-input-p-avatar");

const contAvatarP = $('#container-p-avatar');

const fileInputAvatarP = document.getElementById("input-p-avatar");

const avatars = document.querySelectorAll(".avatar");

const formEditProfile = document.getElementById("form-edit-profile");

const postTimestamps = document.querySelectorAll('.post-timestamp');

const btnPosts = document.getElementById('button-p-posts');

const btnTrips = document.getElementById('button-p-trips');

const contPosts = document.querySelector('.container-p-posts');

const contTrips = document.querySelector('.container-p-trips');

/* function limitRows() {
    // Count line breaks in the textarea
    // If the number of line breaks is less than or equal to the maximum allowed rows, update the 'rows' attribute
    if (parseInt(this.style.height, 10) >= 96) {
      // If the number of line breaks exceeds the maximum allowed rows, remove the last line break
        this.addEventListener('keydown', preventEnterKey);
        this.style.height = "95";

        } else {
            // If the textarea height is less than 448, remove the event listener
            this.removeEventListener('keydown', preventEnterKey);
          }
    }; */

fileInputAvatarP.addEventListener("change", function (event) {
    let file = event.target.files[0];
    let reader = new FileReader();

    reader.onload = function (e) {
        avatars.forEach(element => {
            element.setAttribute("src", e.target.result);
        });
    }

    reader.readAsDataURL(file);
});
    
let formSubmitted = true;

buttonEditP.addEventListener("click", function () {
    if (buttonEditP.innerHTML == "Edit Profile") {
        buttonEditP.innerHTML = "Save Profile";
        buttonEditP.setAttribute("type", "button");

        formSubmitted = false;
        
        contAvatarP.toggleClass('transparent-overlay')
        labelInputPAvatar.css("display", "block");

        removeWhiteSpace.call(txtBio);
        autoResize.call(txtBio);

        txtBio.removeAttribute("readonly");
        txtBio.style.backgroundColor = "white";
        txtBio.style.cursor = "text"

    } else if (buttonEditP.innerHTML == "Save Profile") {
        buttonEditP.innerHTML = "Edit Profile";

        formSubmitted = true;
        
        contAvatarP.toggleClass('transparent-overlay')
        labelInputPAvatar.css("display", "none");

        removeWhiteSpace.call(txtBio);
        autoResize.call(txtBio);

        if (txtBio.value.trim() == "") {
            txtBio.value = "This user does not have a bio yet.";
            txtBio.style.height = "";
        }

        txtBio.setAttribute("readonly", true);
        txtBio.style.backgroundColor = "inherit";
        
    }
});

btnPosts.addEventListener('click', function () {
    contPosts.style.display = "flex";
    contTrips.style.display = "none";
});

btnTrips.addEventListener('click', function () {
    contPosts.style.display = "none";
    contTrips.style.display = "flex";
});

txtBio.addEventListener('input', autoResize);
txtBio.addEventListener('input', function () {
    buttonEditP.setAttribute("type", "submit");
});

fileInputAvatarP.addEventListener("change", function () {
    buttonEditP.setAttribute("type", "submit");
});

/* txtBio.addEventListener('input', limitRows); */
txtBio.addEventListener('focus', autoResize);

window.addEventListener('resize', function () {
    autoResize.call(txtBio);
});


/* txtBio.addEventListener('focus', limitRows); */
txtBio.addEventListener('keydown', preventEnterKey);

txtBio.addEventListener('blur', removeWhiteSpace);

autoResize.call(txtBio);

preventReloadSubmit("#form-edit-profile", "php/edit-profile.php");

/* limitRows.call(txtBio); */
/* console.log(userData["user_avatar_ref"]);

console.log(avatars);
   */
  
  // Add event listener for the beforeunload event
  window.addEventListener("beforeunload", function(event) {
    if (!formSubmitted) {
      // Cancel the event and show a confirmation dialog
      event.preventDefault();
      event.returnValue = "You have unsaved changes! Are you sure you want to leave?";
      return event.returnValue;
    }
  });

postTimestamps.forEach(element => {
    let date = new Date("2023-04-24 00:31:19 +0300");

                
    element.innerHTML = new Intl.DateTimeFormat(navigator.language, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        timeZoneName: 'short'
    }).format(date);
    console.log(date);
});

/* new Intl.DateTimeFormat().format(date) */