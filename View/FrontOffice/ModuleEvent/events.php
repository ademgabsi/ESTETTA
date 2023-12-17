<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/EvenementC.php';
include SITE_ROOT . '/Controller/ReservationC.php';
include SITE_ROOT . '/Controller/UserC.php';
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
$allevents = $eventC->listevent();
$allReservations = $reservationC->listReservation();

if (
    isset($_POST["search"])
) {
    if (
        !empty($_POST['search'])
    ) {


        $allevents = $eventC->getEventByName($_POST['search']);
    } else {
        $allevents = $eventC->listevent();
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="events.css">
    <title>Events Ticket Card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Kay+Pho+Du:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
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
        background-color: #000;
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
        border: 1px solid #6897a1;
        background: #6897a1;
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
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .item-container {
        position: relative;
        margin: 24px;
        width: 320px;
        height: 570px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 0 30px 5px rgba(0, 0, 0, 0.15);
        cursor: pointer;
    }

    .img-container,
    .body-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .img-container img {
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
        height: 200px;
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
        /* margin-top: 12px;*/
        padding: 10px 28px 0px;
    }

    .additional-info .info {
        font-size: 0.9em;
        margin-bottom: 10px;
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


    .container-search {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        width: 60%;
    }

    .container-search form {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 5px;
        flex: 1;
    }
</style>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v18.0"
        nonce="YRU4XEhP"></script>
    <!--code of header -->
    <?php include "../Component/header_user.php" ?>

    <center>
        <div class="container-search">
            <a href="calendrier.php" class="button-next"><i class="fa fa-calendar"
                    style="font-size:26px;color:purple"></i></a>
            <a href="addEventFrontOffice.php" class="button-next"><i class="fa fa-plus"
                    style="font-size:26px;color:purple"></i></a>


            <form action="" method="POST">
                <label for="site-search">Search  Event:</label>
                <input id="search" name="search" />
                <input type="submit" value="Search" />

            </form>
        </div>
    </center>

    <div class="container">

        <?php
        foreach ($allevents as $event) {
            $nbrReservation = 0;
            foreach ($allReservations as $reservation) {
                if ($reservation['event_id'] == $event['event_id']) {
                    $nbrReservation++;
                }
            }
            ?>

            <div class="item-container">
                <div class="img-container">
                    <img src=<?= $event['event_image']; ?> alt="Event image">
                </div>

                <div class="body-container">
                    <div class="overlay"></div>

                    <div class="event-info">
                        <p class="title">
                            <?= $event['titre']; ?>
                        </p>
                        <div class="separator"></div>
                        <p class="info" style="{ text-transform: capitalize;}">
                            <td>
                                <?= $event['host_name']; ?>
                            </td>
                        </p>
                        <p class="price">

                            <?php
                            if ($event['price'] <= 0) {
                                echo 'Free';
                            } else {
                                echo $event['price'] . ' <i class="fa-solid fa-dollar-sign"></i>';

                            }

                            ?>
                        </p>
                        <div class="additional-info">

                            <p class="info">
                                <i class="fa fa-calendar"></i>
                                <?= $event['event_date']; ?>
                            </p>
                            <p class="info">
                                <i class="fa fa-person"></i>
                                <?= $nbrReservation; ?> /
                                <?= $event['participants']; ?>
                                Participants
                            </p>

                            <p class="info description" style="max-height:80px;overflow:hidden;">
                                <?= $event['discription']; ?>
                                <span><a href="more.php?event_id=<?php echo $event['event_id']; ?>">More...</a></span>

                            </p>
                            <div class="fb-share-button"
                                data-href="http://localhost:8080/phpCRUD1/views/more.php?event_id=<?php echo $event['event_id']; ?>"
                                data-layout="" data-size=""><a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=http://localhost:8080/phpCRUD1/views/more.php?event_id=<?php echo $event['event_id']; ?>"
                                    class="fb-xfbml-parse-ignore">Partager1</a></div>


                        </div>
                    </div>
                    <?php
                    if ($nbrReservation < $event['participants']) {
                        ?>
                        <a class="action" href="addReservationFrontOffice.php?event_id=<?php echo $event['event_id']; ?>">
                            <center>Join</center>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a class="action">
                            <center>This is Full</center>
                        </a>
                        <?php
                    }

                    ?>
                </div>
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