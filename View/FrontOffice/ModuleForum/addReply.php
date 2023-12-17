<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ReplyForumC.php';
include_once SITE_ROOT . '/Model/ReplyForum.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:../../UserAuth/login.php');
}

echo 'id_forum' . $_GET['id_forum'];
echo 'content' . $_POST["content"];
echo 'submit_comment_forum' . $_POST["submit_comment_forum"];

if (isset($_POST["content"]) && isset($_POST['submit_comment_forum'])) {
    $id_forum = $_GET['id_forum'];

    $newReplyForum = new ReplyForum(
        null,
        $user_id,
        $id_forum,
        $_POST["content"]
    );
    $replyForumC = new ReplyForumC();
    $replyForumC->addReplyForum($newReplyForum);

    echo '$newReplyForum' . print_r($newReplyForum);

    header('Location: detailForum.php?id_forum=' . $id_forum);


    exit();
} else {
    echo "Invalid request";
}
?>