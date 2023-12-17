<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/LessonC.php';
include SITE_ROOT . '/Controller/LikeUserLessonC.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:../../UserAuth/login.php');
}
if (isset($_GET['lesson_id'])) {

    $LessonC = new LessonC();
    $lesson = $LessonC->showLesson($_GET['lesson_id']);

    $likeUserLessonC = new LikeUserLessonC();
    $likeUserLesson = $likeUserLessonC->getlikeUserLessonByLessonByUser($user_id, $_GET['lesson_id']);

    if (isset($likeUserLesson['status'])) {
        if ($likeUserLesson['status'] == 0) {
            echo 'fama dislike yhab nahiha';

            $likeUserLessonC->deletelikeUserLesson($likeUserLesson['id']);
        } else if ($likeUserLesson['status'] == 1) {
            echo 'like bech twali dislike';

            $likeUserLessonC->updatelikeUserLesson(new LikeUserLesson($likeUserLesson['id'], $likeUserLesson['id_user'], $likeUserLesson['id_lesson'], 0));
        } else {
            echo 'fama chy addnew';

            $likeUserLessonC->addlikeUserLesson(new LikeUserLesson(null, $user_id, $_GET['lesson_id'], 0));
        }
    } else {
        $likeUserLessonC->addlikeUserLesson(new LikeUserLesson(null, $user_id, $_GET['lesson_id'], 0));
    }
    header('Location: lessons.php?course_id=' . $lesson['course_id']);
    exit();
} else {
    echo "Invalid request";
}
?>