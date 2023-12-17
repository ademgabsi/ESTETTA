<?php
include "../../config.php";

include SITE_ROOT . '/Controller/UserC.php';
include SITE_ROOT . '/Controller/EvenementC.php';
include SITE_ROOT . '/Controller/ReservationC.php';

$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();

if ($user_id == '') {
    header('location:../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);
if (!$connectedUser) {
    header('location:../UserAuth/login.php');

}

$reservationC = new ReservationC();
$eventC = new EvenementC();
$allReservations = $reservationC->listReservation();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <style>
        /* Import Font Dancing Script */
        @import url(https://fonts.googleapis.com/css?family=Dancing+Script);

        * {
            margin: 0;
        }

        body {
            background-color: #e8f5ff;
            font-family: Arial;
            overflow: hidden;
        }

        /* NavbarTop */
        .navbar-top {
            background-color: #fff;
            color: #333;
            box-shadow: 0px 4px 8px 0px grey;
            height: 70px;
        }

        .title {
            font-family: 'Dancing Script', cursive;
            padding-top: 15px;
            position: absolute;
            left: 45%;
        }

        .navbar-top ul {
            float: right;
            list-style-type: none;
            margin: 0;
            overflow: hidden;
            padding: 18px 50px 0 40px;
        }

        .navbar-top ul li {
            float: left;
        }

        .navbar-top ul li a {
            color: #333;
            padding: 14px 16px;
            text-align: center;
            text-decoration: none;
        }

        .icon-count {
            background-color: #ff0000;
            color: #fff;
            float: right;
            font-size: 11px;
            left: -25px;
            padding: 2px;
            position: relative;
        }

        /* End */

        /* Sidenav */
        .sidenav {
            background-color: #fff;
            color: #333;
            border-bottom-right-radius: 25px;
            height: 86%;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
            position: absolute;
            top: 70px;
            width: 250px;
        }

        .profile {
            margin-bottom: 20px;
            margin-top: -12px;
            text-align: center;
        }

        .profile img {
            border-radius: 50%;
            box-shadow: 0px 0px 5px 1px grey;
        }

        .name {
            font-size: 20px;
            font-weight: bold;
            padding-top: 20px;
        }

        .job {
            font-size: 16px;
            font-weight: bold;
            padding-top: 10px;
        }

        .url,
        hr {
            text-align: center;
        }

        .url hr {
            margin-left: 20%;
            width: 60%;
        }

        .url a {
            color: #818181;
            display: block;
            font-size: 20px;
            margin: 10px 0;
            padding: 6px 8px;
            text-decoration: none;
        }

        .url a:hover,
        .url .active {
            background-color: #e8f5ff;
            border-radius: 28px;
            color: #000;
            margin-left: 14%;
            width: 65%;
        }

        /* End */

        /* Main */
        .main {
            margin-top: 1%;
            margin-left: 260px;
            font-size: 28px;
            padding: 0 30px 0 10px;
        }

        .main h2 {
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .main .card {
            background-color: #fff;
            border-radius: 18px;
            box-shadow: 1px 1px 8px 0 grey;
            height: auto;
            margin-bottom: 20px;
            padding: 20px 0 20px 50px;
        }

        .main .card table {
            border: none;
            font-size: 16px;
            height: 160px;
            width: 80%;
        }

        .edit {
            position: absolute;
            color: #e7e7e8;
            right: 14%;
        }

        .social-media {
            text-align: center;
            width: 90%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: row;
            gap: 20px;
            overflow-x: scroll;
        }

        .social-media span {
            margin: 0 10px;
        }

        .fa-facebook:hover {
            color: #4267b3 !important;
        }

        .fa-twitter:hover {
            color: #1da1f2 !important;
        }

        .fa-instagram:hover {
            color: #ce2b94 !important;
        }

        .fa-invision:hover {
            color: #f83263 !important;
        }

        .fa-github:hover {
            color: #161414 !important;
        }

        .fa-whatsapp:hover {
            color: #25d366 !important;
        }

        .fa-snapchat:hover {
            color: #fffb01 !important;
        }

        .event-res-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;


        }

        .event-res-container img {
            width: 100px;
            align-self: center;
            border-radius: 20px;
        }

        .event-res-container span {
            width: 100%;
            text-align: center;

        }

        /* End */
    </style>
</head>

<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Profile</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="Acceuil.php">
                    <i class="fa fa-home fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#notification">
                    <span class="icon-count">59</span>
                    <i class="fa fa-bell fa-2x"></i>
                </a>
            </li>
            <li>
                <!-- lahna Logout -->
                <a href="../UserAuth/admin_logout.php">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <img src=<?= $connectedUser["image"] ?> alt="" width="100" height="100">

            <div class="name">
                <?= $connectedUser["name"] ?>
            </div>
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Profile</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Settings</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Main -->
    <div class="main">
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <table>
                    <tbody>
                        <tr>
                            <!-- Nom de letudiant -->
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <?= $connectedUser["name"] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <?= $connectedUser["email"] ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <h2>Joined Events</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <div class="social-media">
                    <?php
                    foreach ($allReservations as $res) {

                        if ($res['user_id'] == $user_id) {

                            $eventSelected = $eventC->showevent($res["event_id"]);


                            ?>
                            <div class="event-res-container">
                                <img src=<?= $eventSelected["event_image"] ?> />

                                <span>
                                    <?= $eventSelected["titre"] ?>
                                </span>

                            </div>

                        <?php }

                    } ?>




                </div>
            </div>
        </div>
    </div>
    <!-- End -->
</body>

</html>