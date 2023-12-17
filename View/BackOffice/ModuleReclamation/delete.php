<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ReclamationC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $reclamationC = new ReclamationC();
    $reclamationC->supprimerRec($id);

    header('Location: listAdmin.php');


    exit();
} else {
    echo "Invalid request";
}
?>