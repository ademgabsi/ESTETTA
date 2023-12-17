<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ForumC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $forumC = new ForumC();
    $forumC->deleteForum($id);

    header('Location: listAdmin.php');


    exit();
} else {
    echo "Invalid request";
}
?>