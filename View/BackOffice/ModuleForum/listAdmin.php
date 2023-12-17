<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ForumC.php';
include SITE_ROOT . '/Controller/UserC.php';

$forumC = new ForumC();
$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();

if ($user_id == '') {
    header('location:../../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);

if (!$connectedUser) {
    header('location:../../UserAuth/login.php');

}

$allCourses = $forumC->getAll();
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
    <link rel="stylesheet" href="dashboard.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Kay+Pho+Du:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="header" href="/View/FrontOffice/header.html">

    <style>
        /**table */
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td form {
            display: flex;
            align-items: center;
        }

        .btn-edit {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 8px 15px;
            /* Adjusted padding for a more consistent size */
            cursor: pointer;
            margin-right: 5px;
            /* Added margin for spacing */
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        td a {
            display: inline-block;
            background-color: #f44336;
            color: #fff;
            padding: 7px 15px;
            /* Adjusted padding for a more consistent size */
            text-decoration: none;
            text-align: center;
            border-radius: 3px;
        }

        td a:hover {
            background-color: #d32f2f;
        }


        /***************************** */
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
            width: 100%;
            margin: auto;
            padding-top: 30px;
            text-align: center;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly;
            gap: 10px;
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


        /* VARIABLES */
        :root {
            /* COLORS */
            --primary-1: teal;
            --primary-2: navy;
            --primary-3: purple;
            --neutral-dk: #222;
            --neutral-md: #999;
            --neutral-mdlt: #f1f1f1;
            --neutral-lt: #fff;

            /* FONT */
            --font-sans: "Poppins", sans-serif;
        }

        .color-primary-1 {
            border-left: 6px solid var(--primary-1);
        }

        .color-primary-2 {
            border-left: 6px solid var(--primary-2);
        }

        .color-primary-3 {
            border-left: 6px solid var(--primary-3);
        }

        .color-primary-dk {
            border-left: 6px solid var(--primary-dk);
        }

        r .color-primary-md {
            border-left: 6px solid var(--primary-md);
        }

        /* CARDS */
        .cards-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            width: 100%;
            flex-wrap: wrap;
            row-gap: 20px;
            column-gap: 40px;
            margin-top: 20px;
        }

        .cards-container h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 20;
        }

        h1,
        h2 {
            font-weight: 700;
        }

        .card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border-radius: 5px;
            min-width: 150px;
            max-width: 500px;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card i {
            font-size: 28px;
        }
    </style>
</head>

<body>

    <!--code of header -->
    <section class="header">
        <?php include "../../FrontOffice/Component/header_user.php" ?>

    </section>



    <!--code of commentaire -->
    <section class="commentaire">
        <article class="card color-primary-1">
            <a href="../dashboard.php" class="details">
                <h2>Dashboard<h2>
            </a>
        </article>
        <h1>Forum</h1>
        <h1></h1>

    </section>





    <table border="1" align="center" width="70%">
        <tr>
            <th>id</th>
            <th>id_user</th>
            <th>title</th>
            <th>content</th>
            <th>Butoon Delete</th>
        </tr>

        <?php
        foreach ($allCourses as $forumC) {
            ?>
            <tr>
                <td>
                    <?= $forumC['id']; ?>
                </td>
                <td>
                    <?= $forumC['id_user']; ?>
                </td>
                <td>
                    <?= $forumC['title']; ?>
                </td>
                <td>
                    <?= $forumC['content']; ?>
                </td>
                

                <td>
                    <a href="delete.php?id=<?php echo $forumC['id']; ?>">Delete</a>
                </td>

            </tr>
            <?php
        }
        ?>
    </table>



    <!--code of footer -->


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