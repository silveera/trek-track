import { userData } from "./util.js";


function deleteItem (targetID, type, clickedElement) {
    $.ajax({
        url: "php/delete-item.php",
        type: "POST",
        data: {
            target_id: targetID,
            deletion_type: type,
        },
        success: function (data) {
            switch (type) {
                case "users":
                    alert("Your account has been deleted.");
                    window.location.href = "login.php";
                    break;
                case "posts":
                    alert("Your post has been deleted.");
                    clickedElement.closest(".post-container").remove();
                    break;
                case "trips":
                    alert("Your trip has been deleted.");

                    if (clickedElement.closest(".container-ongoing-trip").hasClass("trip-selected")) {
                        $(".trip-cont-invis").css("display", "none");
                        $(".no-ongoing-trips").css("display", "block");
                    }

                    clickedElement.closest(".container-ongoing-trip").remove();
                    break;
            }
        }
    });
}

$(document).on("click", ".button-delete", function () {
    let type;
    let targetID;
    let clickedElement = $(this);

    if ($(this).hasClass("delete-user")) {
        let confirmation = confirm("Are you sure you want to delete your account?");
        if (!confirmation) {
            return;
        }

        type = "users";
        targetID = userData["user_id"];

        deleteItem(targetID, type, clickedElement);

    } else if ($(this).hasClass("delete-post")) {
        const postContainer = $(this).closest(".post-container");
        postContainer.css("background-color", "salmon");

        setTimeout(() => {
            let confirmation = confirm("Are you sure you want to delete this post?");
      
            if (confirmation) {
              type = "posts";
              targetID = postContainer.attr("id").replace("id", "");
              console.log("Target:" + targetID);
      
              deleteItem(targetID, type, clickedElement);
            } else {
              postContainer.css("background-color", "var(--invert-neutral-color)");
              return;
            }
          }, 0);
    } else if ($(this).hasClass("delete-trip")) {
        const tripContainer = $(this).closest(".container-ongoing-trip");
        tripContainer.css("background-color", "salmon");

        setTimeout(() => {
            let confirmation = confirm("Are you sure you want to delete this trip?");
      
            if (confirmation) {
              type = "trips";
              targetID = tripContainer.attr("id").replace("id", "");
              console.log("Target:" + targetID);
      
              deleteItem(targetID, type, clickedElement);
            } else {
                if (tripContainer.hasClass("trip-selected")) {
                    tripContainer.css("background-color", "var(--secondary-tint-1)");
                } else {
                    tripContainer.css("background-color", "var(--invert-neutral-color-shade-1)");
                }
              return;
            }
          }, 0);
    }
});