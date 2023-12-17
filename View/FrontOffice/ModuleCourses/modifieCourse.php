<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/CourseC.php';
include SITE_ROOT . '/Controller/UserC.php';
include_once SITE_ROOT . '/Model/User.php';
include_once SITE_ROOT . '/Model/Course.php';

$courseC = new CourseC();
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

$error = "";

$course = null;


if (
    isset($_POST["course_name"]) &&
    isset($_POST["course_desc"]) &&
    isset($_POST["course_author"]) &&

    isset($_POST["course_duration"])
) {
    if (
        !empty($_POST['course_name']) &&
        !empty($_POST["course_desc"]) &&
        !empty($_POST['course_author']) &&

        !empty($_POST['course_duration'])
    ) {

        if (isset($_FILES["course_img"]) && !empty($_FILES['course_img']) && !empty($_FILES['course_img']['name'])) {
            $course_img = $_FILES['course_img']['name'];
            $course_img_tmp = $_FILES['course_img']['tmp_name'];
            $img_folder = SITE_ROOT . '/Assets/BackOffice/Course/' . $course_img;
            $img_foldertoSave = 'http://localhost:8083/projetWeb2A-2A11-G6/Assets/BackOffice/Course/' . $course_img;
            move_uploaded_file($course_img_tmp, $img_folder);
        } else {
            $img_foldertoSave = $courseC->showCourse($_GET['course_id'])['course_img'];
        }

        $course = new Course(
            null,
            $_POST['course_name'],
            $_POST['course_desc'],
            $_POST['course_author'],
            $img_foldertoSave,
            $_POST['course_duration'],
            $user_id
        );
        var_dump($course);

        $courseC->modifierCourse($course, $_GET['course_id']);


        header('Location: ../Acceuil.php#type_of_courses');
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
            <?php
            $course_id = $_GET['course_id'];
            if (isset($_GET['course_id'])) {
                $oldCourse = $courseC->showCourse($_GET['course_id']);
                ?>
                <form class="register" action="" method="post" enctype="multipart/form-data">
                    <h3>Add New Course</h3>
                    <div class="flex">
                        <div class="col">
                            <p>Course Name <span>*</span></p>
                            <input type="text" name="course_name" placeholder="Enter your Course Name" maxlength="50"
                                value="<?php echo $oldCourse['course_name']; ?>" required class="box">
                            <p>Course Author <span>*</span></p>
                            <input type="text" name="course_author" id="course_author" maxlength="50"
                                value="<?php echo $oldCourse['course_author']; ?>" placeholder="Enter Course Author"
                                required class="box">
                        </div>
                        <div class="col">
                            <p>Course Duration <span>*</span></p>
                            <input type="number" name="course_duration" id="course_duration"
                                value="<?php echo $oldCourse['course_duration']; ?>" placeholder="Enter Course Duration"
                                maxlength="20" required class="box">

                            <p>Course Image: <span>*</span></p>
                            <input type="file" name="course_img" id="course_img" accept="image/*"  class="box">
                        </div>

                    </div>
                    <div class="col">
                        <p>Course Description <span>*</span></p>
                        <textarea type="text" name="course_desc" id="course_desc" maxlength="255" required class="box">
                                <?php echo $oldCourse['course_desc']; ?>
                                            </textarea>
                    </div>
                    <div id="error">
                        <?php echo $error; ?>
                    </div>
                    <input type="submit" name="submit" value="Save" class="btn">
                </form>
                <?php
            }
            ?>
        </section>

    </section>






</body>

</html>