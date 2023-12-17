<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ReplyForumC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id_forum = $_GET['id_forum'];

    $replyForum = new ReplyForumC();
    $replyForum->deleteReplyForum($id);

    header('Location: detailForum.php?id_forum=' . $id_forum);


    exit();
} else {
    echo "Invalid request";
}
?>