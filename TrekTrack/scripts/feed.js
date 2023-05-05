import {escapeHtml, textAreaEvents, timeStamper, userData} from "./util.js";

let contFeed = document.querySelector(".container-feed");

const tempFeed = document.getElementById("template-post");

/* const contComment = document.querySelector(".post-comments"); */

const tempComment = document.getElementById("template-comment");

let currentURL = new URLSearchParams(window.location.search);

let active = false;
let currentCommentID = 0;
let currentReplyID = 0;

async function logFeedData() {
    const response = await fetch("php/fetch-feed.php");
    const jsonFeedData = await response.json();
    console.log(jsonFeedData); /* For debugging purposes */
    return jsonFeedData;
};

let feedContent = await logFeedData();

if ('content' in document.createElement('template')) {

    feedContent.forEach(function (feedItem) {
        if (location.href.includes("profile.php")) {
            contFeed = document.querySelector(".container-p-posts");
            let profileName = currentURL.get("username");
            if (profileName !== null) {
                if (feedItem["user_name"] != profileName) {
                    return;
                } else {
                    let noPosts = document.querySelector(".container-p-no-posts");
                    if (noPosts != null) {
                        noPosts.remove();
                    }
                }
            } else if (profileName === null) {
                if (feedItem["user_id"] != userData["user_id"]) {
                    return;
                } else {
                    let noPosts = document.querySelector(".container-p-no-posts");
                    if (noPosts != null) {
                        noPosts.remove();
                    }
                }
            }
        }
        const postClone = tempFeed.content.cloneNode(true);

        postClone.querySelector(".post-avatar").src = feedItem["user_avatar_ref"];
        postClone.querySelector(".post-username").innerText = feedItem["user_name"];

        postClone.querySelectorAll(".profile-link").forEach(function (link) {
            if (feedItem["user_name"] == userData["user_name"]) {
                link.href = "profile.php";
            } else {
                link.href = "profile.php?username=" + feedItem["user_name"] + "&id=" + feedItem["user_id"];
            }
        });

        postClone.querySelector(".post-timestamp").innerText = timeStamper(feedItem["created_at"]);

        if (feedItem["caption"] != "") {
            postClone.querySelector(".post-caption").innerText = feedItem["caption"];
        } else {
            postClone.querySelector(".post-caption").remove();
        }

        if (feedItem["image_ref"] != "") {
            postClone.querySelector(".post-image").src = feedItem["image_ref"];
        } else {
            postClone.querySelector(".post-image").remove();
        }

        postClone.querySelector(".like-count").innerText = feedItem["like_amount"];

        postClone.querySelectorAll(".comment-count").forEach(element => {
            element.innerText = feedItem["comment_amount"];
        })
            
        postClone.querySelector(".like-count").id = feedItem["post_id"] + "likecount";
        postClone.querySelector(".like-button").id = feedItem["post_id"] + "likebtn";

        postClone.querySelector(".comment-count").id = feedItem["post_id"] + "commentcount";
        postClone.querySelector(".comment-button").id = feedItem["post_id"] + "commentbtn";

        postClone.querySelector(".post-comments").id = feedItem["post_id"] + "comments";

        if (feedItem["like_amount"] == 0) {
            postClone.querySelector(".like-count").style.display = "none";
        } else {
            let liked_by = feedItem["liked_by"].split(",");
            if (liked_by.includes(String(userData["user_id"]))) {
                postClone.querySelector(".like-button").classList.remove("fa-regular");
                postClone.querySelector(".like-button").classList.add("fa-solid");
                postClone.querySelector(".like-button").style.color = "var(--accent-tint-1)";
            }
        }

        if (feedItem["comment_amount"] == 0) {
            postClone.querySelector(".comment-count").style.display = "none";
        } else {
            let commented_by = feedItem["commented_by"].split(",");
            if (commented_by.includes(String(userData["user_id"]))) {
                postClone.querySelector(".comment-button").classList.remove("fa-regular");
                postClone.querySelector(".comment-button").classList.add("fa-solid");
                postClone.querySelector(".comment-button").style.color = "var(--accent-tint-1)";
            }
        }

        if (feedItem["comment_amount"] > 1) {
            postClone.querySelector(".show-comments").style.display = "flex";
        } else {
            postClone.querySelector(".show-comments").style.display = "none";
        }

        if ("comments" in feedItem) {
            feedItem["comments"].forEach(comment => {
                const commentClone = tempComment.content.cloneNode(true);

                if (comment["comment_id"] > currentCommentID) {
                    currentCommentID = comment["comment_id"];
                }

                commentClone.querySelector(".container-comment").id = comment["comment_id"] + "commentcontainer";
                commentClone.querySelector(".container-comment").classList.add("comment-container");

                commentClone.querySelector(".comment-avatar").src = comment["user_avatar_ref"];
                commentClone.querySelector(".comment-username").innerText = comment["user_name"];
                commentClone.querySelector(".comment-timestamp").innerText = timeStamper(comment["created_at"]);
                commentClone.querySelector(".comment").innerText = comment["comment_content"];
                
                commentClone.querySelector(".comment-like-button").id = comment["comment_id"] + "commentlikebtn";
                commentClone.querySelector(".comment-like-count").id = comment["comment_id"] + "commentlikecount";

                commentClone.querySelector(".comment-reply-button").id = comment["comment_id"] + "commentreplybtn";


                commentClone.querySelector(".comment-reply-count.counter").id = comment["comment_id"] + "commentreplycount";
                commentClone.querySelector(".comment-replies").id = comment["comment_id"] + "commentreplycontainer";

                commentClone.querySelector(".comment-like-count").innerText = comment["like_amount"];

                commentClone.querySelectorAll(".comment-reply-count").forEach(element => {
                    element.innerText = comment["reply_amount"];
                })

                if (comment["reply_amount"] > 1) {
                    commentClone.querySelector(".non-reply-content").style.display = "flex";
                } else {
                    commentClone.querySelector(".comment-replies").style.display = "flex";
                }

                if (comment["like_amount"] == 0) {
                    commentClone.querySelector(".comment-like-count").style.display = "none";
                } else {
                    let liked_by = comment["liked_by"].split(",");
                    if (liked_by.includes(String(userData["user_id"]))) {
                        commentClone.querySelector(".comment-like-button").classList.remove("fa-regular");
                        commentClone.querySelector(".comment-like-button").classList.add("fa-solid");
                        commentClone.querySelector(".comment-like-button").style.color = "var(--accent-tint-1)";
                    }
                }

                if (comment["reply_amount"] == 0) {
                    commentClone.querySelector(".comment-reply-count").style.display = "none";
                } else {
                    let replied_by = comment["replied_by"].split(",");
                    if (replied_by.includes(String(userData["user_id"]))) {
                        commentClone.querySelector(".comment-reply-button").classList.remove("fa-regular");
                        commentClone.querySelector(".comment-reply-button").classList.add("fa-solid");
                        commentClone.querySelector(".comment-reply-button").style.color = "var(--accent-tint-1)";
                    }
                }

                commentClone.querySelectorAll(".profile-link").forEach(function (link) {
                    if (comment["user_name"] == userData["user_name"]) {
                        link.href = "profile.php";
                    } else {
                        link.href = "profile.php?username=" + comment["user_name"] + "&id=" + comment["user_id"];
                    }
                })

                if ("replies" in comment) {
                    comment["replies"].forEach(reply => {
                        const replyClone = tempComment.content.cloneNode(true);

                        if (reply["reply_id"] > currentReplyID) {
                            currentReplyID = reply["reply_id"];
                        }

                        replyClone.querySelector(".container-comment").id = reply["reply_id"] + "replycontainer";
                        replyClone.querySelector(".container-comment").classList.add("reply-comment");

                        if (reply["user_name"] == userData["user_name"]) {
                            replyClone.querySelector(".comment-username").innerText = "You";
                            replyClone.querySelector(".comment-username").style.color = "var(--accent-tint-1)";
                        } else {
                            replyClone.querySelector(".comment-username").innerText = reply["user_name"];
                        }

                        console.log(reply["reply_to_name"]);
                        console.log(reply["user_name"]);
                        console.log(userData["user_name"]);
                        console.log(reply["reply_content"]);

                        if (reply["reply_to_name"] == userData["user_name"] && reply["user_name"] != userData["user_name"]) {
                            replyClone.querySelector(".replied-to").innerText = "you";
                            replyClone.querySelector(".replied-to").href = "profile.php";
                            replyClone.querySelector(".replied-to").style.color = "var(--accent-tint-1)";
                        } else if (reply["reply_to_name"] == reply["user_name"] && reply["reply_to_name"] != userData["user_name"]) {
                            replyClone.querySelector(".replied-to").innerText = "themselves";
                            replyClone.querySelector(".replied-to").href = "profile.php?username=" + reply["user_name"];
                        } else if (reply["reply_to_name"] == reply["user_name"] && reply["reply_to_name"] == userData["user_name"]) {
                            replyClone.querySelector(".replied-to").innerText = "yourself";
                            replyClone.querySelector(".replied-to").href = "profile.php";
                            replyClone.querySelector(".replied-to").style.color = "var(--accent-tint-1)";
                        } else {
                            replyClone.querySelector(".replied-to").innerText = reply["reply_to_name"];
                            replyClone.querySelector(".replied-to").href = "profile.php?username=" + reply["reply_to_name"];
                        }

                        replyClone.querySelector(".comment-avatar").src = reply["user_avatar_ref"];

                        replyClone.querySelector(".comment-timestamp").innerText = timeStamper(reply["created_at"]);
                        replyClone.querySelector(".comment").innerText = reply["reply_content"];
                        
                        replyClone.querySelector(".comment-like-button").id = reply["reply_id"] + "replylikebtn";
                        replyClone.querySelector(".comment-like-count").id = reply["reply_id"] + "replylikecount";
        
                        replyClone.querySelector(".comment-reply-button").id = reply["reply_id"] + "replyreplybtn";
                        replyClone.querySelector(".comment-reply-count").remove();
                        replyClone.querySelector(".comment-replies").remove();

                        replyClone.querySelector(".comment-like-count").innerText = reply["like_amount"];

                        replyClone.querySelectorAll(".reply-content").forEach(function (replyContent) {
                            replyContent.style.display = "block";
                        })
        
                        if (reply["like_amount"] == 0) {
                            replyClone.querySelector(".comment-like-count").style.display = "none";
                        } else {
                            let liked_by = reply["liked_by"].split(",");
                            if (liked_by.includes(String(userData["user_id"]))) {
                                replyClone.querySelector(".comment-like-button").classList.remove("fa-regular");
                                replyClone.querySelector(".comment-like-button").classList.add("fa-solid");
                                replyClone.querySelector(".comment-like-button").style.color = "var(--accent-tint-1)";
                            }
                        }
        
                        replyClone.querySelectorAll(".profile-link").forEach(function (link) {
                            if (reply["user_name"] == userData["user_name"]) {
                                link.href = "profile.php";
                            } else {
                                link.href = "profile.php?username=" + reply["user_name"] + "&id=" + reply["user_id"];
                            }
                        })

                        commentClone.querySelector(".comment-replies").appendChild(replyClone);
                    });
                }
                        
                postClone.querySelector(".post-comments").appendChild(commentClone);
            });
        };

        contFeed.appendChild(postClone);
    });

    currentCommentID++;
    currentReplyID++;

    $(contFeed).on("click", ".like-button", function() {
        let postId = $(this).attr("id").replace("likebtn", "");
        let likeCount = $("#"+postId+"likecount");
        let likeBtn = $("#"+postId+"likebtn");
    
        $.ajax({
            url: "php/like-post.php",
            type: "POST",
            data: {
                post_id: postId
            },
            success: function(likeAmount) {
                if ($(likeBtn).hasClass("fa-regular")) {
                    $(likeBtn).removeClass("fa-regular");
                    $(likeBtn).addClass("fa-solid");
                    likeBtn.css("color", "var(--accent-tint-1)");
                    $(likeCount).text(parseInt($(likeCount).html()) + 1);
                    likeCount.show();
                } else if ($(likeBtn).hasClass("fa-solid")) {
                    $(likeBtn).removeClass("fa-solid");
                    $(likeBtn).addClass("fa-regular");
                    likeBtn.css("color", "var(--neutral-color)");
                    if ((parseInt($(likeCount).html()) - 1) == 0){
                        $(likeCount).text(parseInt($(likeCount).html()) - 1);
                        likeCount.hide();
                    } else {
                        $(likeCount).text(parseInt($(likeCount).html()) - 1);
                    };
                }   
            },
            error: function() {
                alert("Error updating the like count");
            }
        });
    });

    $(contFeed).on("click", ".comment-button", function() {
        if ($(".active-comment").length > 0) {
            $(".active-comment").remove();
        }

        active = true;
        let postId = $(this).attr("id").replace("commentbtn", "");
        let commentCount = $(this).closest(".post-container").find(".comment-count");
        let commentBtn = $("#"+postId+"commentbtn");
        let commentContainer = $("#"+postId+"comments");
        let showComments = $(this).closest(".post-container").find(".show-comments");
        
        if (commentContainer.css("display") == "none") {
            showComments.find(".show-status").text("Hide");
            showComments.find(".fa-chevron-down").addClass("fa-chevron-up").removeClass("fa-chevron-down");
            commentContainer.show();
        }

        const commentClone = tempComment.content.cloneNode(true);

        commentClone.querySelector(".container-comment").classList.add("active-comment");
        commentClone.querySelector(".container-comment").classList.add("comment-container");
        commentClone.querySelector(".container-comment").id = currentCommentID + "commentcontainer";

        commentClone.querySelector(".comment-avatar").src = userData["user_avatar_ref"];
        commentClone.querySelector(".comment-username").innerText = userData["user_name"];
        commentClone.querySelector(".comment-timestamp").innerText = "Just now";

        commentClone.querySelector(".comment-like-button").id = currentCommentID + "commentlikebtn";
        commentClone.querySelector(".comment-like-count").id = currentCommentID + "commentlikecount";

        commentClone.querySelector(".comment-reply-button").id = currentCommentID + "commentreplybtn";
        commentClone.querySelector(".comment-reply-count").id = currentCommentID + "commentreplycount";
        commentClone.querySelector(".comment-replies").id = currentCommentID + "commentreplycontainer";

        commentClone.querySelector(".comment-like-count").innerText = "0";
        commentClone.querySelector(".comment-reply-count").innerText = "0";

        commentClone.querySelector(".comment-like-count").style.display = "none";
        commentClone.querySelector(".comment-reply-count").style.display = "none";

        commentClone.querySelectorAll(".profile-link").forEach(function (link) {
                link.href = "profile.php";
        })

        const commentTextArea = commentClone.querySelector(".comment");

        commentTextArea.removeAttribute("readonly");

        textAreaEvents.call(commentTextArea);

        function handleEnterKey(event) {
            if (event.key === "Enter") {
                let comment = $(this).val().trim();
                if (!comment) {
                    $(this).closest(".container-comment").remove();
                    active = false;
                    alert("Comment cannot be empty.");
                    return;
                }
                let commentElement = $(this)
                $.ajax({
                    url: "php/submit-comment.php",
                    type: "POST",
                    data: {
                        postID: postId,
                        commentContent: comment
                    },
                    success: function(commentId) {
                        commentTextArea.setAttribute("readonly", true);
                        commentTextArea.style.backgroundColor = "inherit";
                        commentElement.closest(".active-comment").removeClass("active-comment")
                        commentElement.closest(".container-comment").find(".comment-like-count").first().text("0");
                        commentElement.closest(".container-comment").find(".comment-reply-count").first().text("0");
                
                        commentElement.closest(".container-comment").find(".comment-like-count").first().css("display", "none");
                        commentElement.closest(".container-comment").find(".comment-reply-count").first().css("display", "none");

                        commentElement.closest(".container-comment").find(".comment-like-button").first().removeClass("fa-solid");
                        commentElement.closest(".container-comment").find(".comment-like-button").first().addClass("fa-regular");
                        commentElement.closest(".container-comment").find(".comment-like-button").first().css("color", "var(--invert-neutral-color-shade-4)");

                        event.target.removeEventListener('keydown', handleEnterKey);
                        commentBtn.removeClass("fa-regular");
                        commentBtn.addClass("fa-solid");
                        commentBtn.css("color", "var(--accent-tint-1)");

                        $(commentCount).text(parseInt($(commentCount).html()) + 1);
                        commentCount.show();

                        if (parseInt(commentCount.first().text()) > 1) {
                            showComments.css("display", "flex");
                        }
                        currentCommentID++;
                        active = false;
                    },
                    error: function() {
                        alert("Error updating comments");
                    }
                });
            }
        }
        commentClone.querySelector(".comment").addEventListener('keydown', handleEnterKey);

        commentContainer.prepend(commentClone);
        commentTextArea.focus();

    });

    $(contFeed).on("click", ".post-user-image", function() {
        let userId = $(this).attr("id").replace("user", "");
        window.location.href = "profile.php?user_id=" + userId;
    });

    $(contFeed).on("click", ".comment-like-button", function() {
        let commentId = $(this).attr("id").replace("commentlikebtn", "");
        let likeCount = $("#"+commentId+"commentlikecount");
        let likeBtn = $("#"+commentId+"commentlikebtn");
    
        $.ajax({
            url: "php/like-comment.php",
            type: "POST",
            data: {
                comment_id: commentId
            },
            success: function(likeAmount) {
                if ($(likeBtn).hasClass("fa-regular")) {
                    $(likeBtn).removeClass("fa-regular");
                    $(likeBtn).addClass("fa-solid");
                    likeBtn.css("color", "var(--accent-tint-1)");
                    $(likeCount).text(parseInt($(likeCount).html()) + 1);
                    likeCount.show();
                } else if ($(likeBtn).hasClass("fa-solid")) {
                    $(likeBtn).removeClass("fa-solid");
                    $(likeBtn).addClass("fa-regular");
                    likeBtn.css("color", "var(--invert-neutral-color-shade-4)");
                    if ((parseInt($(likeCount).html()) - 1) == 0){
                        $(likeCount).text(parseInt($(likeCount).html()) - 1);
                        likeCount.hide();
                    } else {
                        $(likeCount).text(parseInt($(likeCount).html()) - 1);
                    };
                }   
            },
            error: function() {
                alert("Error updating the like count");
            }
        });
    });

    $(contFeed).on("click", ".comment-reply-button", function() {
        if ($(".active-comment").length > 0) {
            $(".active-comment").remove();
        }

        active = true;
        let commentId = $(this).closest(".comment-container").find(".comment-reply-button").attr("id").replace("commentreplybtn", "");
        let replyUsername = $(this).closest(".container-comment").find(".comment-username").first().text();
        let mainReplyBtn = $("#"+commentId+"commentreplybtn");
        let replyBtn = $(this).closest(".container-comment").find(".comment-reply-button").first();
        let replyCount = $(this).closest(".comment-container").find(".comment-reply-count");
        let replyContainer = $(this).closest(".comment-container").find(".comment-replies")/* $("#"+commentId+"commentreplycontainer") */;
        let showReply = $(this).closest(".comment-container").find(".show-replies");

        if (replyContainer.css("display") == "none") {
            showReply.find(".show-status").text("Hide");
            showReply.find(".fa-chevron-down").addClass("fa-chevron-up").removeClass("fa-chevron-down");
            replyContainer.show();
        }

        const commentClone = tempComment.content.cloneNode(true);

        commentClone.querySelector(".container-comment").id = currentReplyID + "replycontainer";
        commentClone.querySelector(".container-comment").classList.add("active-comment");
        commentClone.querySelector(".container-comment").classList.add("reply-comment");
        
        commentClone.querySelector(".comment-avatar").src = userData["user_avatar_ref"];

        commentClone.querySelector(".comment-username").innerText = "You";
        commentClone.querySelector(".comment-username").style.color = "var(--accent-tint-1)";
        commentClone.querySelector(".comment-timestamp").innerText = "Just now";

        commentClone.querySelector(".comment-like-button").id = currentReplyID + "replylikebtn";
        commentClone.querySelector(".comment-like-count").id = currentReplyID + "replylikecount";

        commentClone.querySelector(".comment-like-button").classList.add("reply-like-button");
        commentClone.querySelector(".comment-like-count").classList.add("reply-like-count");

        commentClone.querySelector(".comment-like-button").classList.remove("comment-like-button");

        commentClone.querySelector(".comment-reply-button").id = currentReplyID + "replyreplybtn";
        

        commentClone.querySelector(".comment-like-count").innerText = "0";

        commentClone.querySelector(".comment-like-count").style.display = "none";

        commentClone.querySelector(".comment-replies").remove();
        commentClone.querySelector(".comment-reply-count").remove();
        commentClone.querySelector(".show-replies").remove();

        if (replyUsername == userData["user_name"]) {
            commentClone.querySelector(".replied-to").innerText = "yourself";
            commentClone.querySelector(".replied-to").href = "profile.php";
            commentClone.querySelector(".replied-to").style.color = "var(--accent-tint-1)";
        } else if (replyUsername == "You") {
            replyUsername = userData["user_name"];
            commentClone.querySelector(".replied-to").innerText = "yourself";
            commentClone.querySelector(".replied-to").href = "profile.php";
            commentClone.querySelector(".replied-to").style.color = "var(--accent-tint-1)";
        } else {
            commentClone.querySelector(".replied-to").innerText = replyUsername;
            commentClone.querySelector(".replied-to").href = "profile.php?username=" + replyUsername;
        }

        commentClone.querySelectorAll(".profile-link").forEach(function (link) {
                link.href = "profile.php";
        })

        commentClone.querySelectorAll(".reply-content").forEach(function (replyContent) {
            replyContent.style.display = "block";
        })

        const commentTextArea = commentClone.querySelector(".comment");

        commentTextArea.removeAttribute("readonly");

        textAreaEvents.call(commentTextArea);

        function handleEnterKey(event) {
            if (event.key === "Enter") {
                let reply = $(this).val().trim();
                if (!reply) {
                    $(this).closest(".container-comment").remove();
                    active = false;
                    alert("Reply cannot be empty.");
                    return;
                }
                let replyElement = $(this)
                $.ajax({
                    url: "php/submit-reply.php",
                    type: "POST",
                    data: {
                        commentID: commentId,
                        replyContent: reply,
                        replyTo: replyUsername
                    },
                    success: function(commentId) {
                        commentTextArea.setAttribute("readonly", true);
                        commentTextArea.style.backgroundColor = "inherit";
                        replyElement.closest(".active-comment").removeClass("active-comment")
                        event.target.removeEventListener('keydown', handleEnterKey);
                        mainReplyBtn.removeClass("fa-regular");
                        mainReplyBtn.addClass("fa-solid");
                        mainReplyBtn.css("color", "var(--accent-tint-1)");
                        $(replyCount).text(parseInt($(replyCount).html()) + 1);
                        replyCount.show();

                        console.log(parseInt(replyCount.first().text()));
                        if (parseInt(replyCount.first().text()) > 1) {
                            showReply.css("display", "flex");
                        }

                        active = false;
                        currentReplyID++;
                    },
                    error: function() {
                        alert("Error updating comments");
                    }
                });
            }
        }

        commentClone.querySelector(".comment").addEventListener('keydown', handleEnterKey);

        replyContainer.append(commentClone);
        commentTextArea.focus();
    });

    $(contFeed).on("click", ".comment-like-button", function() {
        let replyId = $(this).attr("id").replace("replylikebtn", "");
        let likeCount = $("#"+replyId+"replylikecount");
        let likeBtn = $("#"+replyId+"replylikebtn");
    
        $.ajax({
            url: "php/like-reply.php",
            type: "POST",
            data: {
                reply_id: replyId
            },
            success: function(likeAmount) {
                if ($(likeBtn).hasClass("fa-regular")) {
                    $(likeBtn).removeClass("fa-regular");
                    $(likeBtn).addClass("fa-solid");
                    likeBtn.css("color", "var(--accent-tint-1)");
                    $(likeCount).text(parseInt($(likeCount).html()) + 1);
                    likeCount.show();
                } else if ($(likeBtn).hasClass("fa-solid")) {
                    $(likeBtn).removeClass("fa-solid");
                    $(likeBtn).addClass("fa-regular");
                    likeBtn.css("color", "var(--invert-neutral-color-shade-4)");
                    if ((parseInt($(likeCount).html()) - 1) == 0){
                        $(likeCount).text(parseInt($(likeCount).html()) - 1);
                        likeCount.hide();
                    } else {
                        $(likeCount).text(parseInt($(likeCount).html()) - 1);
                    };
                }   
            },
            error: function() {
                alert("Error updating the like count");
            }
        });
    });

    $(contFeed).on("click", ".show-replies", function() {
        let replyContainer = $(this).closest(".comment-container").find(".comment-replies");

        if ($(this).find(".show-status").text() == "Show") {
            $(this).find(".show-status").text("Hide");
            $(this).find(".fa-chevron-down").addClass("fa-chevron-up").removeClass("fa-chevron-down");
            replyContainer.show();
        } else {
            $(this).find(".show-status").text("Show");
            $(this).find(".fa-chevron-up").addClass("fa-chevron-down").removeClass("fa-chevron-up");
            replyContainer.hide();
        };
    });

    $(contFeed).on("click", ".show-comments", function() {
        let commentContainer = $(this).closest(".post-container").find(".post-comments");

        if ($(this).find(".show-status").text() == "Show") {
            $(this).find(".show-status").text("Hide");
            $(this).find(".fa-chevron-down").addClass("fa-chevron-up").removeClass("fa-chevron-down");
            commentContainer.show();
        } else {
            $(this).find(".show-status").text("Show");
            $(this).find(".fa-chevron-up").addClass("fa-chevron-down").removeClass("fa-chevron-up");
            commentContainer.hide();
        };
    });
}

    