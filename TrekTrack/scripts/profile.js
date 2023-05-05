import { /* userData */ autoResize, removeWhiteSpace, preventEnterKey, preventReloadSubmit, timeStamper} from './util.js';

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

const contContent = document.querySelector('.container-p-content');

const noPosts = document.querySelector(".container-p-no-posts");

const noTrips = document.querySelector(".container-p-no-trips");

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
        txtBio.style.backgroundColor = "var(--invert-neutral-color)";
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

if (window.location.hash === "#trips") {
  contPosts.style.display = "none";
  contTrips.style.display = "block";
} else if (window.location.hash === "#posts") {
  contTrips.style.display = "none";
  contPosts.style.display = "block";
}

btnPosts.addEventListener('click', function () {
    contTrips.style.display = "none";
    contPosts.style.display = "block";
    location.hash = "#posts";
});

btnTrips.addEventListener('click', function () {
    contPosts.style.display = "none";
    contTrips.style.display = "block";
    location.hash = "#trips";
});

$(".switch-trip-button").on("click", function () {
    contPosts.style.display = "none";
    contTrips.style.display = "block";
    location.hash = "#trips";
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

/* postTimestamps.forEach(element => {
    let date = new Date("2023-04-24 00:31:19");
    var current = new Date();

 });  */

/* new Intl.DateTimeFormat().format(date) */
/* 
function convertToUserLocalTime(estonianTimestamp) {
    // Parse the timestamp into year, month, day, hour, minute, and second
    const [year, month, day, hour, minute, second] = estonianTimestamp.split(/[- :]/).map(Number);

    // Create a Date object with the timestamp in Estonian time (UTC+03:00)
    const estonianDate = new Date(Date.UTC(year, month - 1, day, hour - 3, minute, second));

    // Log the local time to the console
    console.log(estonianDate.toLocaleString());
}
   */
/* function timeAgo(date) {
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
  
    const units = [
      { name: "year", seconds: 31536000 },
      { name: "month", seconds: 2592000 },
      { name: "week", seconds: 604800 },
      { name: "day", seconds: 86400 },
      { name: "hour", seconds: 3600 },
      { name: "minute", seconds: 60 },
      { name: "second", seconds: 1 },
    ];
  
    for (const unit of units) {
      const value = Math.floor(diffInSeconds / unit.seconds);
      if (value >= 1) {
        return `${value} ${unit.name}${value > 1 ? "s" : ""} ago`;
      }
    }
  
    return "just now";
  }
  
  function convertEstonianTimeToLocalAndTimeAgo(estonianTimestamp) {
    const [year, month, day, hour, minute, second] = estonianTimestamp.split(/[- :]/).map(Number);
    const estonianDate = new Date(Date.UTC(year, month - 1, day, hour, minute, second));
    
    const estonianOffset = 2 * 60 * 60 * 1000; // 2 hours, 2*60*60*1000 milliseconds
    const localOffset = new Date().getTimezoneOffset() * 60 * 1000;
    const localDate = new Date(estonianDate.getTime() - estonianOffset + localOffset);
  
    console.log("Local time:", localDate);
    console.log("Time ago:", timeAgo(localDate));
  }
   */