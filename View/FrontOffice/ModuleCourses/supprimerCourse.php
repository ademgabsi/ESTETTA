<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/CourseC.php';
$CourseC = new CourseC();


if (isset($_GET['course_id'])) {
	$course_id = $_GET['course_id'];

	$CourseC = new CourseC();

	$CourseC->supprimerCourse($course_id);
	header('Location: ../Acceuil.php');
	exit(0);
} else {
	echo "Invalid request";
	exit(1);

}
?>