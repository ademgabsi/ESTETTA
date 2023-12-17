<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/CommentC.php';
if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];

    $CommentC = new CommentC();
    $CommentC->deleteComment($comment_id);
    if (isset($_GET['$course_id'])) {
        header('Location:lessons.php?course_id=' . $_GET['$course_id']);

    } else {
        header('Location: lessons.php');

    }
    exit();
} else {
    echo "Invalid request";
}
?>