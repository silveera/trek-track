import {escapeHtml} from "./util.js";

const contFeed = document.querySelector(".container-feed");

const tempFeed = document.getElementById("template-post");

async function logFeedData() {
    const response = await fetch("php/fetch-feed.php");
    const jsonFeedData = await response.json();
    console.log(jsonFeedData); /* For debugging purposes */
    return jsonFeedData;
};

let feedContent = await logFeedData();

if ('content' in document.createElement('template')) {

    feedContent.forEach(function (feedItem) {
        const clone = tempFeed.content.cloneNode(true);

        clone.querySelector(".post-avatar").src = feedItem["user_avatar_ref"];
        clone.querySelector(".post-username").innerText = feedItem["user_name"];

        clone.querySelector(".post-timestamp").innerText = feedItem["created_at"];

        if (feedItem["caption"] != "") {
            clone.querySelector(".post-caption").innerText = feedItem["caption"];
        } else {
            clone.querySelector(".post-caption").remove();
        }

        if (feedItem["image_ref"] != "") {
            clone.querySelector(".post-image").src = feedItem["image_ref"];
        } else {
            clone.querySelector(".post-image").remove();
        }
        
        clone.querySelector(".like-count").innerText = feedItem["likes"];

        clone.querySelector(".like-count").id = feedItem["post_id"] + "likecount";
        clone.querySelector(".like-button").id = feedItem["post_id"] + "likebtn";
        
/*         $("#"+feedItem["post_id"]+"likebtn").on("click", function() {
            $.ajax({
                url: "php/like-post.php",
                type: "POST",
                data: {
                    post_id: feedItem["post_id"]
                }, */
/*                 success: function(likeCount) {
                    $("#"+feedItem["post_id"]+"likecount").text(likeCount);
                }, 
                error: function() {
                    alert("Error updating the like count");
                } */
            /* }); */
        /* }); */
        
        /* clone.querySelector(".post-user-image").href = "profile.php?user_id=" + feedItem["user_id"]; */
        contFeed.appendChild(clone);
    });

    $(".container-feed").on("click", ".like-button", function() {
        const postId = $(this).attr("id").replace("likebtn", "");
        console.log(postId);
    
        $.ajax({
            url: "php/like-post.php",
            type: "POST",
            data: {
                post_id: postId
            },
            success: function(likeCount) {
                $("#"+postId+"likecount").text(parseInt($("#"+postId+"likecount").html()) + 1);
            },
            error: function() {
                alert("Error updating the like count");
            }
        });
    });

}

