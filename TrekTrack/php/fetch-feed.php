<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

function fetch_comments($conn, $post_id) {
  $query = "SELECT
              u.user_name,
              u.user_avatar_ref,
              c.*,
              COALESCE(l.like_amount, 0) AS like_amount,
              l.liked_by,
              COALESCE(r.reply_amount, 0) AS reply_amount,
              r.replied_by
            FROM
              users u
            INNER JOIN
              comments c ON c.user_id = u.user_id AND c.post_id = ?
            LEFT JOIN
              (
                SELECT
                  comment_id,
                  COUNT(comment_like_id) AS like_amount,
                  GROUP_CONCAT(user_id) AS liked_by
                FROM
                  comment_likes
                WHERE
                  user_id IS NOT NULL 
                GROUP BY
                  comment_id
              ) AS l ON l.comment_id = c.comment_id
            LEFT JOIN
              (
                SELECT
                  comment_id,
                  COUNT(reply_id) AS reply_amount,
                  GROUP_CONCAT(user_id) AS replied_by
                FROM
                  comment_replies
                WHERE
                  user_id IS NOT NULL
                GROUP BY
                  comment_id
              ) AS r ON r.comment_id = c.comment_id
            ORDER BY
              c.created_at DESC;";

  $stmt = mysqli_prepare($conn, $query);

  if (!$stmt) {
      
      echo "stmtfailed";
      exit();
  }

  mysqli_stmt_bind_param($stmt, 'i', $post_id);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  $comments = [];
  while ($comment = mysqli_fetch_assoc($resultData)) {
    if ($comment['comment_id'] !== null) {
      $comments[] = $comment;
    }
  }

  return $comments;
}

function fetch_replies($conn, $comment_id) {
  $query = "SELECT
              u.user_name,
              u.user_avatar_ref,
              c.*,
              COUNT(l.reply_id) AS like_amount,
              GROUP_CONCAT(l.user_id) AS liked_by
            FROM
              users u
            INNER JOIN
              comment_replies c ON c.user_id = u.user_id
            LEFT JOIN
              comment_reply_likes l ON l.reply_id = c.reply_id AND l.user_id IS NOT NULL
            WHERE
              c.comment_id = ?
            GROUP BY
              c.reply_id
            ORDER BY
              c.created_at ASC;";

  $stmt = mysqli_prepare($conn, $query);

  if (!$stmt) {
      
      echo "stmtfailed";
      exit();
  }

  mysqli_stmt_bind_param($stmt, 'i', $comment_id);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  $replies = [];
  while ($reply = mysqli_fetch_assoc($resultData)) {
    if ($reply['reply_id'] !== null) {
      $replies[] = $reply;
    }
  }

  return $replies;
}


function fetch_feed_items($limit, $conn) {

    $query = "SELECT
                u.user_name,
                u.user_avatar_ref,
                p.*,
                COALESCE(l.like_amount, 0) AS like_amount,
                l.liked_by,
                COALESCE(c.comment_amount, 0) AS comment_amount,
                c.commented_by
              FROM
                users u
              INNER JOIN
                posts p ON p.user_id = u.user_id
              LEFT JOIN
                (
                  SELECT
                    post_id,
                    COUNT(like_id) AS like_amount,
                    GROUP_CONCAT(user_id) AS liked_by
                  FROM
                    likes
                  WHERE
                    user_id IS NOT NULL
                  GROUP BY
                    post_id
                ) AS l ON l.post_id = p.post_id
              LEFT JOIN
                (
                  SELECT
                    post_id,
                    COUNT(comment_id) AS comment_amount,
                    GROUP_CONCAT(user_id) AS commented_by
                  FROM
                    comments
                  WHERE
                    user_id IS NOT NULL
                  GROUP BY
                    post_id
                ) AS c ON c.post_id = p.post_id
              ORDER BY
                p.created_at DESC
              LIMIT ?;";
    
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        
        echo "stmtfailed";
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'i', $limit);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $feed_items = [];
    while ($post = mysqli_fetch_assoc($resultData)) {
        $feed_items[] = $post;
        $comments = fetch_comments($conn, $post['post_id']);
        if (count($comments) > 0){
            $feed_items[array_key_last($feed_items)]['comments'] = $comments;
        }
        for ($i = 0; $i < count($comments); $i++) {
            $comment = $comments[$i];
            $replies = fetch_replies($conn, $comment['comment_id']);
            if (count($replies) > 0) {
                $feed_items[array_key_last($feed_items)]['comments'][$i]['replies'] = $replies;
            }
        }
    }

    return $feed_items;
}

/* function likes($feed_items) {
    $values = '';
    foreach($feed_items as $key => $post){
        if ($key === array_key_last($feed_items)) {
            $values .= $post['post_id'];
        }
        else 
            $values .= $post['post_id'] . ',';
    }
    return $values;
};

function fetch_likes($values, $conn) {
    $query = "SELECT post_id, user_id FROM likes WHERE post_id IN ($values);";
    
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo "stmtfailed";
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $likes = [];
    while ($post = mysqli_fetch_assoc($resultData)) {
        $likes[] = $post;
    }

    mysqli_close($conn);

    return $likes;
} */

$feed_items = fetch_feed_items(100, $conn);

/* $values = likes($feed_items);
$likes = fetch_likes($values, $conn);

$result = ['feed_items' => $feed_items, 'likes' => $likes]; */

header('Content-Type: application/json');
echo json_encode($feed_items);