<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ReservationC.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $reservationC = new ReservationC();
    $reservationC->deleteReservation($id);

    header('Location: listAdmin.php');


    exit();
} else {
    echo "Invalid request";
}
?>