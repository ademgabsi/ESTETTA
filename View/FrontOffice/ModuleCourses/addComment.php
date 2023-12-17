<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/CommentC.php';
include_once SITE_ROOT . '/Model/Comment.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:../../UserAuth/login.php');
}
echo 'lesson_id' . $_GET['lesson_id'];
echo 'course_id' . $_GET['course_id'];
echo 'comment_txt' . $_POST['comment_txt'];
echo 'submit' . $_POST['submit_comment_txt'];

if (isset($_POST["comment_txt"]) && isset($_POST['submit_comment_txt'])) {
    $comment_txt = $_POST['comment_txt'];
    $lesson_id = $_GET['lesson_id'];

    $newComment = new Comment(
        null,
        $user_id,
        $lesson_id,
        $comment_txt,
        date("Y-m-d")
    );
    $commentC = new CommentC();
    $commentC->addComment($newComment);

    echo '$newComment' . print_r($newComment);
    if (isset($_GET['course_id'])) {
        header('Location:lessons.php?course_id=' . $_GET['course_id']);

    } else {
        header('Location: lessons.php');

    }
    exit();
} else {
    echo "Invalid request";
}
?>