<?php
include "../../../config.php";

include SITE_ROOT . '/Controller/CommentC.php';
include SITE_ROOT . '/Controller/LikeUserLessonC.php';
include SITE_ROOT . '/Controller/LessonC.php';
include SITE_ROOT . '/Controller/CourseC.php';
include SITE_ROOT . '/Controller/UserC.php';

$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();

if ($user_id == '') {
    header('location:../../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);
if (!$connectedUser) {
    header('location:../../UserAuth/login.php');

}

$LessonC = new LessonC();
$courseC = new CourseC();
$commentC = new CommentC();
$likeUserLessonC = new LikeUserLessonC();
$allLessons = $LessonC->afficherLesson();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php if (isset($_GET['course_id'])) {
        $courseTitre = $courseC->showCourse($_GET['course_id']);

        ?>
        <title>
            <? $courseTitre['course_name'] ?>
        </title>
    <?php } ?>
    <link rel="fonction" href="" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Kay+Pho+Du:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


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
            width: 100px;
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

        .watch-video {
            text-align: center;
            padding: 30px;
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .video-container {
            position: relative;
            max-width: 60%;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            transition: transform 0.3s ease;
        }

        .course-info {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: left;
        }

        .course-info td {
            padding: 10px;
            border-bottom: 5px solid #a70606;
        }

        .title {
            font-size: 28px;
            color: #2c3e50;
            font-weight: bold;
            text-transform: uppercase;
        }

        .video-container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .search-bar {
            text-align: right;
            padding: 20px;
            position: absolute;
            top: 0;
            right: 0;
        }

        form {
            display: flex;
            align-items: center;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 14px;
        }

        .search-icon {
            background-color: black;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .search-icon i {
            font-size: 18px;
        }

        .interaction-section {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .interaction-section button {
            padding: 8px 16px;
            margin-right: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
        }

        .like-button {
            background-color: #4CAF50;
        }

        .dislike-button {
            background-color: #f44336;
        }

        .post-comment-button {
            background-color: #3498db;
        }

        .commentbox1 {
            flex: 1;
            text-align: left;
        }


        .commentbox2 {
            flex: 3;
            text-align: left;
        }


        .comment-section {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        .like-dislike-count {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            margin-right: 10px;
        }

        .like-count,
        .dislike-count {
            margin-right: 5px;
        }

        .comment-display {
            margin-top: 10px;
        }

        .comment {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .student-icon {
            width: 30px;
            /* Adjust the size as needed */
            height: 30px;
            /* Adjust the size as needed */
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-text {
            flex-grow: 1;
        }

        .comment {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            /* Add padding for space within the rounded corners */
            background-color: #f2f2f2;
            /* Background color for comment section */
            border-radius: 8px;
            /* Adjust the border-radius for rounded corners */
        }

        .comment-display {
            margin-top: 10px;
            border-radius: 8px;
            /* Adjust the border-radius for rounded corners */
            overflow: hidden;
            /* Ensure child elements don't overflow beyond rounded corners */
        }

        .student-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-text {
            flex-grow: 1;
        }

        .user-name {
            font-weight: bold;
            margin-right: 5px;
        }

        .btn-like {
            cursor: pointer;
            outline: 0;
            color: black;

        }

        .btn-like:focus {
            outline: none;
        }

        .green {
            color: green !important;
        }

        .red {
            color: red !important;

        }
    </style>

</head>

<body>

    <!--code of header -->
    <section class="header">
        <?php include "../Component/header_user.php" ?>
    </section>


    <!--code of video -->
    <section class="watch-video">
        <?php if ($connectedUser["role"] == 1) { ?>
            <div class="icons">
                <a href=<?= "addLesson.php?course_id=" . $_GET['course_id'] ?>
                    class="button-next"><i class="fa fa-plus"></i></a>
            </div>

            <?php
        }
        foreach ($allLessons as $lesson) {
            if (!isset($_GET['course_id']) || ($_GET['course_id'] == $lesson['course_id'] && isset($_GET['course_id']))) {
                $commentArray = $commentC->getCommentByLesson($lesson['lesson_id']);
                $allLike = $likeUserLessonC->getlikeUserLessonByLesson($lesson['lesson_id']);
                $likeUserLesson = null;
                $numberLikes = 0;
                $numberDisLikes = 0;

                if (is_array($allLike)) {
                    foreach ($allLike as $like) {
                        if (isset($like['status']) && $like['status'] == 0) {
                            $numberDisLikes++;
                        }
                        if (isset($like['status']) && $like['status'] == 1) {
                            $numberLikes++;
                        }
                        if (isset($like['id_user']) && $like['id_user'] == $user_id) {
                            $likeUserLesson = $like;
                        }
                    }
                }

                $commentCount = count($commentArray);

                ?>

                <div class="video-container lessons-col">
                    <div class="video">
                        <video style="width:100%" src=<?= $lesson['lesson_video']; ?> controls poster="" id="video "></video>
                    </div>
                    <table class="course-info">
                        <tr>
                            <td>Lesson Name:</td>
                            <td>
                                <?= $lesson['lesson_name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Lesson Description:</td>
                            <td>
                                <?= $lesson['lesson_description']; ?>
                            </td>
                        </tr>
                    </table>
                    <?php if ($connectedUser["role"] == 1) { ?>

                        <div class="icons">
                            <a href="modifieLesson.php?lesson_id=<?= $lesson['lesson_id']; ?>"
                                class="button-next"><i class="fa fa-edit"></i></a>
                            <a href="#" class="button-next delete-lesson" data-lesson-id="<?= $lesson['lesson_id']; ?>"
                                data-course-id="<?= $lesson['course_id']; ?>"><i class="fa fa-trash-o"></i></a>
                        </div>
                    <?php } ?>
                    <?php if ($connectedUser["role"] == 0) { ?>
                        <div class="icons">

                            <a href="#" class="button-next delete-lesson" data-lesson-id="<?= $lesson['lesson_id']; ?>"><i
                                    class="fa fa-trash-o"></i></a>
                        </div>
                    <?php } ?>
                    <!-- Like, Dislike, Comment section -->
                    <div class="interaction-section">
                        <div class="like-dislike-count">

                            <a href="likeLesson.php?lesson_id=<?= $lesson['lesson_id']; ?>"
                                class="<?php echo isset($likeUserLesson) && $likeUserLesson['status'] == 1 ? 'btn-like green' : 'btn-like'; ?>"><i
                                    class="fa fa-thumbs-up fa-lg" aria-hidden="true">
                                    <?= $numberLikes; ?> Likes
                                </i></a>
                            <a href="disLikeLesson.php?lesson_id=<?= $lesson['lesson_id']; ?>"
                                class="<?php echo isset($likeUserLesson) && $likeUserLesson['status'] == 0 ? 'btn-like red' : 'btn-like'; ?>"><i
                                    class="fa fa-thumbs-down fa-lg" aria-hidden="true">
                                    <?= $numberDisLikes; ?> Dislikes
                                </i></a>
                        </div>
                        <span class="comment-count"><i class="fa fa-comment"></i>
                            <?= $commentCount; ?> Comments
                        </span>
                        <form method="POST" action=<?= "addComment.php?lesson_id=" . $lesson['lesson_id'] . '&course_id=' . $_GET['course_id'] ?>>
                            <textarea class="comment-section" name="comment_txt" placeholder="Add a comment..." value=''
                                required></textarea>
                            <input class="post-comment-button " type="submit" name="submit_comment_txt" value="Post Comment">
                        </form>
                    </div>


                    <?php
                    foreach ($commentArray as $comment) {
                        $commentCount++;
                        $db = config::getConnexion();

                        $select_profile = $db->prepare("SELECT * FROM `user` WHERE id = ?");
                        $select_profile->execute([$comment['id_user']]);

                        if ($select_profile->rowCount() > 0) {
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

                            ?>

                            <!-- Comment display section -->
                            <div class="comment-display comment-cols">
                                <!-- Example Comment -->
                                <div class="comment">
                                    <img src="<?= $fetch_profile['image'] ?>" alt="Student Icon" class="student-icon">
                                    <span class="user-name commentbox1">
                                        <?= $fetch_profile['name'] ?>
                                    </span>
                                    <p class="comment-text commentbox2">
                                        <?php echo $comment['comment']; ?>
                                    </p>
                                    <p class="comment-text commentbox1">
                                        <?= $comment['date']; ?>
                                    </p>
                                    <?php if ($connectedUser["id"] == $comment['id_user']) { ?>

                                        <td>
                                            <a href="#" class="delete-comment" data-comment-id="<?= $comment['id']; ?>"
                                                data-course-id="<?= $lesson['course_id']; ?>"><i class="fa fa-trash-o"></i></a>

                                        </td>
                                    <?php } ?>

                                </div>
                                <!-- Repeat the above structure for additional comments -->
                            </div>
                            <?php
                        }
                    }

                    ?>
                    <!-- Comment display section -->

                </div>
                <?php

            }
        }
        ?>
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


    <script>
        $(document).ready(function () {
            $('.delete-comment').click(function (e) {
                e.preventDefault();
                var comment_id = $(this).data('comment-id');
                var course_id = $(this).data('course-id');

                if (confirm('Are you sure you want to delete this lesson?')) {
                    $.ajax({
                        type: 'GET',
                        url: 'supprimerComment.php',
                        data: { comment_id: comment_id, course_id: course_id },
                        success: function (response) {
                            console.log(response);
                            $(e.target).closest('.comment-cols').remove();
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.delete-lesson').click(function (e) {
                e.preventDefault();
                var lesson_id = $(this).data('lesson-id');
                var course_id = $(this).data('course-id');

                if (confirm('Are you sure you want to delete this lesson?')) {
                    $.ajax({
                        type: 'GET',
                        url: 'supprimerLesson.php',
                        data: { lesson_id: lesson_id, course_id: course_id },
                        success: function (response) {
                            console.log(response);
                            $(e.target).closest('.lessons-col').remove();
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>