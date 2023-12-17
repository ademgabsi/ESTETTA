<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ReclamationC.php';
include SITE_ROOT . '/Controller/UserC.php';

$reclamationC = new ReclamationC();
$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();

if ($user_id == '') {
    header('location:../../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);

if (!$connectedUser) {
    header('location:../../UserAuth/login.php');

}

$allRec = $reclamationC->afficherRec();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WELCOME TO !ESTETTA</title>
    <link rel="fonction" href="" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Kay+Pho+Du:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="header" href="/View/FrontOffice/header.html">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
        crossorigin="anonymous" />
    <style>
        /* Header*/
        * {
            margin: 0;
            padding: 0;
            font-family: "Kay Pho Du", serif;
            font-family: "Roboto", sans-serif;
            font-family: "Rubik", sans-serif;
        }

        .header {
            width: 100%;
            background-color: black;
            background-position: center;
            background-size: cover;
            position: relative;
            transition: 0.3s;
        }

        .text-box {
            width: 90%;
            color: #fff;
            position: absolute;
            top: -8%;
            left: 50%;
            transform: translate(-50%, 50%);
            text-align: center;
        }

        .cta {
            margin: 100px auto;
            width: 80%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url(http://localhost:8083/projetWeb2A-2A11-G6/Assets/FrontOffice/images/banner2.jpg);
            background-position: center;
            background-size: cover;
            border-radius: 10px;
            text-align: center;
            padding: 100px 0;
        }

        .logo-estetta {
            width: 100px;

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
            background-color: rgba(4, 9, 30, 0.7);
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
            content: "";
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
            flex-direction: row;
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
            content: "";
            width: 0%;
            height: 2px;
            background: #f44336;
            display: block;
            margin: auto;
        }

        .nav-links ul li:hover::after {
            width: 100%;
        }

        .text-box h1 {
            font-size: 80px;
        }

        .text-box p {
            margin: 20px 0 40px;
            font-size: 23px;
            color: #fff;
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

        @media (max-width: 700px) {
            .text-box h1 {
                font-size: 30px;
            }

            .text-box p {
                font-size: 15px;
            }

            .nav-links ul li {
                display: block;
            }

            .nav-links {
                position: absolute;
                background: #f44336;
                height: 100vh;
                width: 200px;
                top: 0;
                right: -210px;
                text-align: left;
                z-index: 2;
                transition: 1s;
            }

            nav .fa {
                display: block;
                color: #fff;
                margin: 10px;
                font-size: 22px;
                cursor: pointer;
            }

            .nav-links ul {
                padding: 25px;
            }
        }

        /* Course*/

        .course {
            width: 80%;
            margin: auto;
            text-align: center;
            padding-top: 100px;
        }

        h1 {
            font-size: 36px;
            font-weight: 600;
        }

        p {
            color: rgba(137, 137, 137, 0.994);
            font-size: 18px;
            font-weight: 300;
            line-height: 30px;
            padding: 21px;
        }

        .row {
            margin-top: 5%;
            display: flex;
            flex-direction: row;
            gap: 15px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .course-col {
            flex: basis 31%;
            background: #fff3f3;
            border-radius: 10px;
            margin-bottom: 5%;
            padding: 20px 12px;
            box-sizing: border-box;
            transition: 0.5s;
        }

        h3 {
            text-align: center;
            font-weight: 600;
            margin: 10px 0;
        }

        h4 {
            font-weight: 500;
            margin: 10px 0;
        }

        h5 {
            font-weight: 400;
            margin: 10px 10px;

        }

        .course-col:hover {
            box-shadow: 0 0 20px rgb(0, 0, 0, 0.2);
        }

        @media (max-width: 700px) {
            .row {
                flex-direction: column;
            }
        }

        /* Type of courses*/

        .type_of_courses {
            width: 80%;
            margin: auto;
            text-align: center;
            padding-top: 50px;
        }

        .type_of_courses .courses-col {
            flex-basis: 32%;
            border-radius: 10px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .type_of_courses .courses-col img {
            width: 100%;
            display: block;
        }

        .type_of_courses .layer {
            background: transparent;
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transition: 0.5s;
            -webkit-transition: 0.5s;
            -moz-transition: 0.5s;
        }

        .type_of_courses .layer:hover {
            background: rgba(212, 82, 82, 0.651);
        }

        .type_of_courses .layer h3 {
            width: 100%;
            font-weight: 500;
            color: #fff;
            font-size: 26px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            position: absolute;
            opacity: 0;
            transition: 0.5s;
            -webkit-transition: 0.5s;
            /* Safari and older versions of Chrome */
            -moz-transition: 0.5s;
            /* Firefox */
        }

        .type_of_courses .layer:hover h3 {
            bottom: 49%;
            opacity: 1;
        }

        /**/

        /* Commentaire*/

        .commentaire {
            width: 80%;
            margin: auto;
            padding-top: 100px;
            text-align: center;
        }

        .comment {
            flex-basis: 44%;
            border-radius: 10px;
            margin-bottom: 5%;
            text-align: left;
            background: #fff3f3;
            padding: 25px;
            cursor: pointer;
            display: flex;
            position: relative;
        }

        .comment-edit {
            top: 10px;
            right: 10px;
            position: absolute;
        }

        .comment img {
            height: 40px;
            margin-left: 5px;
            margin-right: 30px;
            border-right: 50%;
        }

        .comment p {
            padding: 0;
        }

        .comment h3 {
            margin-top: 15px;
            text-align: left;
        }

        .comment .fa {
            color: #f44336;
        }

        @media (max-width: 700px) {
            .comment img {
                margin-left: 0px;
                margin-right: 15px;
            }
        }

        /* Cta*/

        .cta h1 {
            color: #fff;
            margin-bottom: 40px;
            padding: 0;
        }

        @media (max-width: 700px) {
            .cta h1 {
                font-size: 24px;
            }
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
    </style>
</head>

<body>

    <!--code of header -->
    <section class="header">
        <?php include "../Component/header_user.php" ?>

    </section>






    <!--code of commentaire -->

    <section class="commentaire">
        <h1>Reclamations</h1>
        <div class="icons">
            <a href="addReclamation.php" class="button-next"><i class="fa fa-plus"></i></a>
        </div>
        <div class="row">
            <?php foreach ($allRec as $rec) {
                if ($rec['id_user'] == $user_id) {
                    ?>

                    <div class="comment">
                        <a href=<?= "editReclamation.php?rec_id=" . $rec["id"] ?> class="comment-edit"> <i
                                class="fa fa-pen fa-xs "></i>
                        </a>
                        <div>
                            <h3>
                                <?= $rec['nom'] ?>
                            </h3>

                            <p>
                                <?= $rec['message'] ?>
                            </p>
                            <h4>
                                <?= $rec['sujet'] ?>
                            </h4>
                            <h5>
                                <?= $rec['date'] ?>
                            </h5>

                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </section>




    <!--code of footer -->

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

    <!--script of redirecting to another page -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</body>

</html>