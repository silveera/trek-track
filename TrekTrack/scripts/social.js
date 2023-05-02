import { userData, timeStamper } from "./util.js";

const socialContainer = document.querySelector('.social-container');

const searchInput = document.getElementById('friends-search');

const friendTemplate = document.getElementById('friend-template');

const noFriendsContainer = document.querySelector('.no-friends-container');

let profileID = undefined;
let profileFriendContainer = undefined;

if (location.href.includes("profile.php?username")) {
    profileID = location.href.split("=")[2];
    profileFriendContainer = document.querySelector('.friend-container.profile-page');
}

function displaySearchResults(response) {

    if (response.length > 0) {
        noFriendsContainer.style.display = "none";
    } else if (response.length == 0 && socialContainer.querySelector('.friend-container') == null) {
        noFriendsContainer.style.display = "flex";
        return;
    }

    if ('content' in document.createElement('template')) {
        /* let parsedResponse = JSON.parse(response); */
        console.log(response);
        response.forEach(result => {
            if (profileID != undefined && result['user_id'] == profileID) {
                let profileStatus = result['relation_status'];

                switch (profileStatus) {
                    case 'none':
                        break;
                    case 'pending':
                        if (userData["user_id"] == result['receiver_id']) {
                            profileStatus = 'received';
                            profileFriendContainer.querySelector(".status-none").style.display = "none";
                            profileFriendContainer.querySelectorAll(".status-received").forEach(element => {
                                element.style.display = "flex";
                            });
                        } else if (userData["user_id"] == result['sender_id']) {
                            profileStatus = 'sent';
                            profileFriendContainer.querySelector(".status-none").style.display = "none";
                            profileFriendContainer.querySelector(".button-reject-friend").style.display = "flex";
                        }
                        break;
                    case 'accepted':
                        profileFriendContainer.querySelector(".button-accept-friend").style.display = "none";
                        profileFriendContainer.querySelector(".status-none").style.display = "none";
                        profileFriendContainer.querySelector(".button-remove-friend").style.display = "flex";
                        /* friendClone.querySelector(".friend-container").style.backgroundColor = "var(--primary-tint-2)"; */
                        break;
                    default:
                        profileStatus = 'none';
                        break;
                }
            }

            if (document.getElementById(result['user_id'] + 'friendcontainer') != null) {
                socialContainer.prepend(document.getElementById(result['user_id'] + 'friendcontainer'));
                return;
            }

            const friendClone = friendTemplate.content.cloneNode(true);

            let status = result['relation_status'];
            let statusText = friendClone.querySelector('.status-text');

            console.log(status);

            switch (status) {
                case 'none':
                    statusText.textContent = 'Add friend:';
                    break;
                case 'pending':
                    if (userData["user_id"] == result['receiver_id']) {
                        status = 'received';
                        statusText.textContent = 'New request!';
                        friendClone.querySelector(".status-none").style.display = "none";
                        friendClone.querySelectorAll(".status-received").forEach(element => {
                            element.style.display = "flex";
                        });
                    } else if (userData["user_id"] == result['sender_id']) {
                        status = 'sent';
                        statusText.textContent = 'Request pending...';
                        friendClone.querySelector(".status-none").style.display = "none";
                        friendClone.querySelector(".button-reject-friend").style.display = "flex";
                    }
                    break;
                case 'accepted':
                    statusText.innerHTML = 'Friends for ' + timeStamper(result['updated_at']).replace(' ago', '').replace(/minutes|minute/g, 'm ').replace(/hours|hour/g, 'h ').replace(/days|day/g, 'd ').replace(/weeks|week/g, 'w ').replace(/months|month/g, 'mo ').replace(/years|year/g, 'y ').replace(/seconds|second/g, "s ").replace(" ", '');
                    friendClone.querySelector(".button-accept-friend").style.display = "none";
                    friendClone.querySelector(".status-none").style.display = "none";
                    friendClone.querySelector(".button-remove-friend").style.display = "flex";
                    /* friendClone.querySelector(".friend-container").style.backgroundColor = "var(--primary-tint-2)"; */
                    break;
                default:
                    status = 'none';
                    statusText.textContent = 'Add friend:';
                    break;
            }

            friendClone.querySelector('.friend-container').setAttribute('id', result['user_id'] + 'friendcontainer');
            friendClone.querySelector('.friend-avatar').setAttribute('src', result["user_avatar_ref"]);
            friendClone.querySelector('.friend-username').textContent = result['user_name'];
            friendClone.querySelectorAll('.profile-link').forEach(element => {
                element.href = "profile.php?username=" + result['user_name'] + "&id=" + result['user_id'];
            });

            socialContainer.prepend(friendClone);
        });
    }
}

function searchFriends(query) {
    $.ajax({
        url: 'php/friend-search.php',
        type: 'GET',
        data: {
            query: query,
            action: 'search-friends'
        },
        success: displaySearchResults,
    });

}

searchFriends("");

$('#friends-search').on('input', function () {
    if ($(this).val().length == 0) {
        socialContainer.innerHTML = "";
        searchFriends("");
    } else {
        searchFriends($(this).val());
    }
});


$(document).on("click", ".button-add-friend", function () {
    let friendContainer = $(this).closest(".friend-container");
    let friendUserId;

    if (profileID != undefined) {
        friendUserId = profileID;
    } else {
        friendUserId = friendContainer.attr("id").replace("friendcontainer", "");
    }

    $.ajax({
        url: "php/add-friend.php",
        type: "POST",
        data: {
            receiver_id: friendUserId,
            action: "add-friend"
        },
        success: function () {
            if (friendContainer.hasClass("profile-page")) {
                socialContainer.innerHTML = "";
                noFriendsContainer.style.display = "none";
                searchFriends("");
            }

            friendContainer.find(".status-text").text("Request sent!");
            friendContainer.find(".button-add-friend").css("display", "none");
            friendContainer.find(".button-reject-friend").css("display", "flex");

            if (profileID != undefined) {
                profileFriendContainer.querySelector(".button-add-friend").style.display = "none";
                profileFriendContainer.querySelector(".button-reject-friend").style.display = "flex";
            }
        },
        error: function () {
            alert("Error adding friend");
        }
    });
});

function friendRemove() {
    let friendContainer = $(this).closest(".friend-container");
    let friendUserId;

    if (profileID != undefined) {
        friendUserId = profileID;
    } else {
        friendUserId = friendContainer.attr("id").replace("friendcontainer", "");
    }
        
    $.ajax({
        url: "php/add-friend.php",
        type: "POST",
        data: {
            target_id: friendUserId,
            action: "remove-friend"
        },
        success: function () {
            if (friendContainer.hasClass("profile-page")) {
                socialContainer.innerHTML = "";
                noFriendsContainer.style.display = "none";
                searchFriends("");
            }

            let statusText = friendContainer.find(".status-text");

            if (statusText.text() == "Request sent!" || statusText.text() == "Request pending...") {
                statusText.text("Request cancelled.");
            } else if (statusText.text() == "New request!") {
                statusText.text("Request rejected.");
            } else if (statusText.text() == "Friends for:" || statusText.text() == "Request accepted!") {
                statusText.text("Friend removed.");
            }

            friendContainer.find("i").each(function () {
                $(this).css("display", "none");
            });

            friendContainer.find(".button-add-friend").css("display", "flex");

            if (profileID != undefined) {
                profileFriendContainer.querySelectorAll("i").forEach(function (element) {
                    element.style.display = "none";
                });
                profileFriendContainer.querySelector(".button-add-friend").style.display = "flex";
            }
        },
        error: function () {
            alert("Error removing friend");
        }
    });
}

$(document).on("click", ".button-remove-friend", friendRemove);
$(document).on("click", ".button-reject-friend", friendRemove);

$(document).on("click", ".button-accept-friend", function () {
    let friendContainer = $(this).closest(".friend-container");
    let friendUserId;

    if (profileID != undefined) {
        friendUserId = profileID;
    } else {
        friendUserId = friendContainer.attr("id").replace("friendcontainer", "");
    }

    $.ajax({
        url: "php/add-friend.php",
        type: "POST",
        data: {
            target_id: friendUserId,
            action: "accept-friend"
        },
        success: function () {
            if (friendContainer.hasClass("profile-page")) {
                socialContainer.innerHTML = "";
                noFriendsContainer.style.display = "none";
                searchFriends("");
            }
            friendContainer.find(".status-text").text("Request accepted!");
            friendContainer.find(".button-reject-friend").css("display", "none");
            friendContainer.find(".button-accept-friend").css("display", "none");
            friendContainer.find(".button-remove-friend").css("display", "flex");
            
            if (profileID != undefined) {
                profileFriendContainer.querySelector(".button-reject-friend").style.display = "none";
                profileFriendContainer.querySelector(".button-accept-friend").style.display = "none";
                profileFriendContainer.querySelector(".button-remove-friend").style.display = "flex";
            }
        },
        error: function () {
            alert("Error accepting friend");
        }
    });
});