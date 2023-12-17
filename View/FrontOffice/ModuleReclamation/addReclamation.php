<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/ReclamationC.php';
include SITE_ROOT . '/Controller/UserC.php';
include_once SITE_ROOT . '/Model/User.php';
include_once SITE_ROOT . '/Model/Reclamation.php';

$reclamationC = new ReclamationC();
$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();
$error = "";
if ($user_id == '') {
    header('location:../../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);
if (!$connectedUser) {
    header('location:../../UserAuth/login.php');
}

if (
    isset($_POST["nom"]) &&
    isset($_POST["sujet"]) &&
    isset($_POST["message"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["sujet"]) &&
        !empty($_POST["message"])
    ) {


        $newRec = new Reclamation(
            null,
            $_POST['nom'],
            $_POST['sujet'],
            $user_id,
            date("Y-m-d"),
            $_POST['message']
        );
        $reclamationC->ajouterreclamation($newRec);


        header('Location: reclamationList.php');
    } else {
        $error = "Missing information";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .register {
            text-align: center;
            margin-bottom: 20px;
        }

        .register h3 {
            margin-bottom: 20px;
            color: #007bff;
            font-size: 24px;
        }

        .col {
            margin-bottom: 20px;
            flex: 1;
        }

        .col p {
            text-align: left;
            padding: 5px 10px;
        }

        .box {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 30px;
            background-color: #f5f5f5;
            color: #495057;
            transition: border-color 0.3s;
        }

        .box:focus {
            border-color: #80bdff;
            outline: none;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .link {
            margin-top: 10px;
            text-align: center;
        }

        .message {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            position: relative;
        }

        .message span {
            margin-right: 10px;
        }

        .fa-times {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #721c24;
        }

        /* Dark mode styling */
        .dark {
            background-color: #343a40;
            color: #fff;
        }

        .flex {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        /* Add more styles as needed */
    </style>
</head>

<body>

    <section class="header">
        <?php include SITE_ROOT . "/View/FrontOffice/Component/header_user.php" ?>
        <section class="form-container">
            <form class="register" action="" method="post" enctype="multipart/form-data">
                <h3>Add New Reclamation</h3>

                <div class="col">
                    <p>Title <span>*</span></p>
                    <input type="text" name="nom" placeholder="Enter Title" maxlength="50" required class="box">
                </div>
                <div class="col">
                    <p>Subject <span>*</span></p>

                    <select name="sujet" id="sujet" required class="box">
                        <option disabled selected>Select Subject</option>
                        <option value="Courses">Courses</option>
                        <option value="Lessons">Lessons</option>
                        <option value="Events">Events</option>
                        <option value="Forum">Forum</option>
                    </select>
                </div>


                <div class="col">
                    <p>Message <span>*</span></p>
                    <textarea type="text" name="message" id="message" maxlength="255" required class="box">
                        </textarea>
                </div>
                <div id="error">
                    <?php echo $error; ?>
                </div>
                <input type="submit" name="submit" value="Save" class="btn">
            </form>
        </section>

    </section>


</body>

</html>