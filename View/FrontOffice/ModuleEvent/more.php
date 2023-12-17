<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/EvenementC.php';
include SITE_ROOT . '/Controller/ReservationC.php';
$reservationC = new ReservationC();
$eventC = new EvenementC();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <title>Events Ticket Card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Kay+Pho+Du:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Header*/
        * {
            margin: 0;
            padding: 0;
            font-family: 'Kay Pho Du', serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Rubik', sans-serif;
        }

        .header {
            min-height: 10vh;
            width: 100%;
            background-color: #000;
            background-size: contain;
            position: relative;
            transition: 0.5s;
        }

        nav {
            display: flex;
            padding: 0% 5%;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown {
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #000;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            left: 0;
            margin-top: 5px;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            position: relative;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: #000;
        }

        .dropdown-content a:hover::after {
            content: '';
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #f44336;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        nav img {
            width: 75px;
        }

        .nav-links {
            flex: 1;
            text-align: right;
        }

        .nav-links ul li {
            list-style: none;
            display: inline-block;
            padding: 15px 25px;
            position: relative;
        }

        .nav-links ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
        }

        .nav-links ul li::after {
            content: '';
            width: 0%;
            height: 2px;
            background: #f44336;
            display: block;
            margin: auto;
        }

        .nav-links ul li:hover::after {
            width: 100%;
        }

        .button-next {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            border: 1px solid #fff;
            padding: 12px 34px;
            font-size: 18px;
            background: transparent;
            position: relative;
            cursor: pointer;
        }

        .button-next:hover {
            border: 1px solid #f44336;
            background: #f44336;
            transition: 1s;
        }

        nav .fa {
            display: none;
        }


        /* footer*/

        .footer {
            width: 100%;
            text-align: center;
            padding: 30px 0;
        }

        .footer h3 {
            margin-bottom: 25px;
            margin-top: 20px;
            font-weight: 600;
        }


        .icons .fa {
            color: #f44336;
            margin: 0 13px;
            cursor: pointer;
            pad: 18px 0;
        }



        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .item-container {
            margin: 24px;
            width: 320px;
            height: 570px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 0 30px 5px rgba(0, 0, 0, 0.15);
            cursor: pointer;
        }


        .body-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .img-container {
            width: 100%;
        }

        .body-container {
            position: relative;
        }

        .overlay {
            position: relative;
            width: 100%;
            height: 400px;
            background-color: rgba(24, 83, 122, 0.6);
            opacity: 0;
            transition: height linear 0.4s, opacity linear 0.2s;
        }

        .item-container:hover .overlay {
            opacity: 1;
            height: 150px;
        }

        .event-info {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
        }

        .title,
        .price {
            color: #18537a;
            font-size: 1.5em;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 12px;
        }

        .info {
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .separator {
            width: 20%;
            height: 6px;
            background-color: #17537a;
            margin-bottom: 16px;
        }

        .additional-info {
            border-top: 1px solid #bbb;
            margin-top: 12px;
            padding: 28px;
            padding-bottom: 0;
        }

        .additional-info .info {
            font-size: 0.9em;
            margin-bottom: 20px;
            text-align: center;
        }

        .info i {
            color: #18537a;
            font-size: 1.1em;
            margin-right: 4px;
        }

        .info span {
            color: #18537a;
            font-weight: bolder;
        }

        .action {
            color: #fff;
            border: 3px solid #fff;
            background-color: transparent;
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            outline: none;
            cursor: pointer;
            padding: 12px;
            text-transform: uppercase;
            font-size: 1.3em;
            font-weight: bold;
            letter-spacing: 2px;
            transition: background-color 0.4s, top 0.4s;
        }

        .item-container:hover .action {
            top: 50px;
        }

        .action:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Fira Sans', sans-serif;
            box-sizing: border-box;
        }

        button:focus,
        input:focus,
        textarea:focus {
            outline: 0;
        }

        body {
            background: #F5F8FF;
        }

        .form_wrapper {
            padding: 80px 15px;
        }

        .form_wrap {
            padding: 55px;
            background: #1d2027;
            border-radius: 10px;
            box-shadow: 3px 4px 20px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            margin: 0 auto;
        }

        .form_wrap h2 {
            font-size: 36px;
            font-weight: 700;
            color: #ffffff;
        }

        .mt_25 {
            margin-top: 25px;
        }

        .w_48 {
            width: 48%;
        }

        .custom_flex {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .input_info {
            width: 100%;
            height: 50px;
            border-radius: 8px;
            border: 1px solid #ffffff;
            padding-left: 20px;
            font-size: 14px;
            color: #ffffff;
            background: transparent;
        }

        .input_info::placeholder {
            color: #ffffff;
        }

        .input_info:focus {
            border: 1px solid #0077B5;
        }

        .textarea_info {
            padding-top: 12px;
            height: 200px;
        }

        .make_btn {
            width: 100%;
            height: 50px;
            border-radius: 8px;
            background: #ffffff;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 500;
            cursor: pointer;
        }



        /*Small devices (landscape phones, 575px and down)*/
        @media (max-width: 575px) {

            .form_wrap h2 {
                font-size: 24px;
            }

            .w_48 {
                width: 100%;
            }

            .custom_flex {
                flex-direction: column;
            }

            .textarea_info {
                height: 100px;
            }

        }
    </style>
</head>

<body>

    <!--code of header -->
    <section class="header">
        <?php include SITE_ROOT . "/View/FrontOffice/Component/header_user.php" ?>

    </section>


    <div class="container">
        <?php
        if (isset($_GET['event_id'])) {
            $oldEvent = $eventC->showevent($_GET['event_id']);
            $allReservations = $reservationC->listReservation();
            $nbrReservation = 0;
            foreach ($allReservations as $reservation) {
                if ($reservation['event_id'] == $oldEvent['event_id']) {
                    $nbrReservation++;
                }
            }
            ?>



            <img src=<?= $oldEvent['event_image']; ?> alt="Event image">

            <div class="body-container">

                <div class="event-info">
                    <p class="title">
                        <?= $oldEvent['titre']; ?>
                    </p>
                    <div class="separator"></div>
                    <p class="info" style="{ text-transform: capitalize;}">
                        <td>
                            <?= $oldEvent['host_name']; ?>
                        </td>
                    </p>
                    <p class="price">

                        <?php
                        if ($oldEvent['price'] <= 0) {
                            echo 'Free';
                        } else {
                            echo $oldEvent['price'] . ' <i class="fa-solid fa-dollar-sign"></i>';

                        }

                        ?>
                    </p>
                    <div class="additional-info">

                        <p class="info">
                            <i class="fa fa-calendar"></i>
                            <?= $oldEvent['event_date']; ?>
                        </p>
                        <p class="info">
                            <i class="fa fa-person"></i>
                            <?= $nbrReservation; ?> Participants/
                            <?= $oldEvent['participants']; ?>
                        </p>

                        <p class="info description">
                            <td>
                                <?= $oldEvent['discription']; ?>
                            </td>
                        </p>
                    </div>
                </div>
                <a class="action" href="addReservationFrontOffice.php?event_id=<?php echo $oldEvent['event_id']; ?>">
                    <center>Join</center>
                </a>

            </div>

            <?php
        }
        ?>

    </div>

    <?php include "../Component/footer.php" ?>


    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }

        function hideMenu() {
            navLinks.style.right = "-210px";
        }   
    </script>


</body>

</html>