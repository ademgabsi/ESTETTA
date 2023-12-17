<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/LessonC.php';


if (isset($_GET['lesson_id'])) {
	$lesson_id = $_GET['lesson_id'];

	$LessonC = new LessonC();

	$LessonC->supprimerLesson($lesson_id);
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