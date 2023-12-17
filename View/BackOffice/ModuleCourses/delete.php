<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/CourseC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $CourseC = new CourseC();
    $CourseC->supprimerCourse($id);

    header('Location: listAdmin.php');


    exit();
} else {
    echo "Invalid request";
}
?>