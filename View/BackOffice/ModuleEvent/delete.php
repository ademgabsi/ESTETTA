<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/EvenementC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $EvenementC = new EvenementC();
    $EvenementC->deleteevent($id);

    header('Location: listAdmin.php');


    exit();
} else {
    echo "Invalid request";
}
?>