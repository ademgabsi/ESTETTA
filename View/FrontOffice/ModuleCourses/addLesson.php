<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/LessonC.php';
include SITE_ROOT . '/Controller/CourseC.php';
include SITE_ROOT . '/Controller/UserC.php';
include_once SITE_ROOT . '/Model/User.php';
include_once SITE_ROOT . '/Model/Lesson.php';

$CourseC = new CourseC();

$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();
if ($user_id == '') {
    header('location:../../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);
if (!$connectedUser) {
    header('location:../../UserAuth/login.php');
}

$error = "";

$LessonC = new LessonC();
$course_id = "";
$allCourses = $CourseC->afficherCourse();
if (
    isset($_POST["lesson_name"]) &&
    isset($_POST["lesson_description"]) &&
    isset($_FILES["lesson_video"]) &&
    (isset($_POST["course_id"]) || isset($_GET["course_id"]))
) {
    if (
        !empty($_POST['lesson_name']) &&
        !empty($_POST["lesson_description"]) &&
        !empty($_FILES["lesson_video"]) &&
        (!empty($_POST["course_id"]) || $_GET["course_id"] != "")
    ) {

        if (isset($_GET["course_id"]) && $_GET["course_id"] != "") {
            $course_id = $_GET["course_id"];

        } else {
            $course_id = $_POST["course_id"];
        }
        $lesson_video = $_FILES['lesson_video']['name'];
        $lesson_video_tmp = $_FILES['lesson_video']['tmp_name'];
        $video_folder = SITE_ROOT . '/Assets/BackOffice/Lesson/' . str_replace(' ', '', $lesson_video);
        $video_foldertoSave = 'http://localhost:8083/projetWeb2A-2A11-G6/Assets/BackOffice/Lesson/' . str_replace(' ', '', $lesson_video);
        move_uploaded_file($lesson_video_tmp, $video_folder);

        $newLesson = new Lesson(
            null,
            $_POST['lesson_name'],
            $_POST['lesson_description'],
            $video_foldertoSave,
            $course_id
        );
        $LessonC->ajouterLesson($newLesson);

        header('Location: lessons.php?course_id=' . $course_id);

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
                <h3>Add New Lesson</h3>
                <div class="flex">
                    <div class="col">
                        <p>Lesson Name <span>*</span></p>
                        <input type="text" name="lesson_name" placeholder="Enter your Lesson Name" maxlength="50"
                            required class="box">


                    </div>
                    <div class="col">

                        <p>Lesson Video: <span>*</span></p>

                        <input type="file" name="lesson_video" id="lesson_video" required class="box">
                    </div>

                </div>
                <?php if (!isset($_GET['course_id']) || $_GET['course_id'] == '') { ?>
                    <div class="col">
                        <p>Course <span>*</span></p>
                        <select name="course_id" id="course_id_select" class="box">
                            <option value="" disabled selected>Select Course</option>
                            <?php foreach ($allCourses as $course) { ?>
                                <option value="<?= $course['course_id']; ?>">
                                    <?php echo $course['course_name']; ?>
                                </option>

                            <?php } ?>

                        </select>
                    <?php } ?>
                </div>
                <div class="col">
                    <p>Lesson Description <span>*</span></p>
                    <textarea type="text" name="lesson_description" id="lesson_description" maxlength="255" required
                        class="box">
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