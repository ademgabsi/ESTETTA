<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/LessonC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $lessonC = new LessonC();
    $lessonC->supprimerLesson($id);

    header('Location: listAdmin.php');


    exit();
} else {
    echo "Invalid request";
}
?>