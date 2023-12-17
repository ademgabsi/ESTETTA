<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ForumC.php';
if (isset($_GET['forum_id'])) {
    $forum_id = $_GET['forum_id'];

    $forumC = new ForumC();
    $forumC->deleteForum($forum_id);

    header('Location: forumList.php');


    exit();
} else {
    echo "Invalid request";
}
?>