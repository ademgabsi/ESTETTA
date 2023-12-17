<?php
include "../../config.php";

include SITE_ROOT . '/Controller/CourseC.php';
include SITE_ROOT . '/Controller/UserC.php';

$CourseC = new CourseC();
$userC = new UserC();
$user_id = $userC->getUserIdFromCookie();

if ($user_id == '') {
  header('location:../UserAuth/login.php');

}

$connectedUser = $userC->getById($user_id);
if (!$connectedUser) {
  header('location:../UserAuth/login.php');

}

$allCourses = $CourseC->afficherCourse();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WELCOME TO !ESTETTA</title>
  <link rel="stylesheet" href="table.css" />
  <link rel="stylesheet" href="styles.css" />
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
    integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
  <style>

  </style>
</head>

<body>

  <!--code of header -->
  <section class="header">
    <?php include "Component/header_user.php" ?>


    <div class="text-box">
      <h1>
        The free and fun way <br />
        to learn Music , Art & Languages
      </h1>
      <p>
        Embark on a creative journey celebrating the realms of art, language, and music! <br> Dive into the world of
        expression through our engaging courses, where mastering the language of art becomes an enchanting and enjoyable
        exploration.
      </p>
      <a href="#course" class="button-next">NEXT</a>
    </div>
  </section>


  <!--code of course-->
  <section class="course" id="course">
    <h1>Courses we offer</h1>
    <p></p>

    <div class="row" style="flex-wrap: nowrap;">
      <div class="course-col">
        <h3>Intermediate</h3>
        <p>
          Hone the nuances of artistic language, exploring brushwork and color blending in our painting course. Elevate
          your skills from novice to intermediate, embracing the expressive journey through the realms of art, language,
          and music. </p>
      </div>

      <div class="course-col">
        <h3>Degree</h3>
        <p>

          Elevate your creative mastery to new heights in our Bachelor of Arts in Fine Arts program, seamlessly
          intertwining the realms of art, language, and music with academic excellence. Unleash your artistic potential
          through this inspiring journey. </p>
      </div>

      <div class="course-col">
        <h3>Post-Graduation</h3>
        <p>

          Achieve artistic brilliance through our Postgraduate Diploma in Creative Arts—an innovation-focused program
          dedicated to mastering the rich interplay of art, language, and music in the realm of boundless creativity.
        </p>
      </div>
    </div>
  </section>

  <!--code of type of courses-->
  <section class="type_of_courses" id="type_of_courses">
    <h1>List of courses</h1>
    <br>
    <?php if ($connectedUser["role"] == 1) {
      ?>
      <div class="icons">
        <a href="ModuleCourses/addCourse.php" class="button-next"><i class="fa fa-plus"></i></a>
      </div>
    <?php } ?>
    <div class="row">
      <?php foreach ($allCourses as $course) { ?>
        <div class="courses-col">
          <img src=<?= $course['course_img']; ?> />
          <div class="layer">

            <a href="ModuleCourses/lessons.php?course_id=<?= $course['course_id']; ?>" class="">
              <h3>
                <?= $course['course_name']; ?>
              </h3>
            </a>
          </div>

          <table class="course-info">
            <tr>
              <td>Course Description:</td>
              <td>
                <?= $course['course_desc']; ?>
              </td>
            </tr>
            <tr>
              <td>Course Author:</td>
              <td>
                <?= $course['course_author']; ?>
              </td>
            </tr>
            <tr>
              <td>Course Duration:</td>
              <td>
                <?= $course['course_duration']; ?> Hours
              </td>
            </tr>
          </table>
          <?php if ($connectedUser["role"] == 0) { ?>
            <div class="icons">

              <a href="#" class="button-next delete-course" data-course-id="<?= $course['course_id']; ?>"><i
                  class="fa fa-trash-o"></i></a>
            </div>
          <?php } ?>
          <?php if ($connectedUser["role"] == 1) { ?>
            <div class="icons">
              <a href="ModuleCourses/modifieCourse.php?course_id=<?= $course['course_id']; ?>" class="button-next"><i
                  class="fa fa-edit"></i></a>
              <a href="#" class="button-next delete-course" data-course-id="<?= $course['course_id']; ?>">
                <i class="fa fa-trash-o"></i>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php }
      ?>
    </div>
  </section>




  <!--code of commentaire -->

  <section class="commentaire">
    <h1>What our students says ?</h1>

    <div class="row">
      <div class="comment">
        <img src="http://localhost:8083/projetWeb2A-2A11-G6/Assets/FrontOffice/images/user1.png" />
        <div>
          <p>
            Your courses transformed my passion into proficiency! Engaging
            lessons and expert guidance propelled my artistry to new horizons.
          </p>
          <h3>Tony</h3>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
        </div>
      </div>

      <div class="comment">
        <img src="http://localhost:8083/projetWeb2A-2A11-G6/Assets/FrontOffice/images/user2.png" />
        <div>
          <p>
            Enrolling in your courses was a game-changer. The supportive
            community and challenging curriculum turned my artistic
            aspirations into tangible skills. Grateful for the journey!
          </p>
          <h3>Angela</h3>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-half-o"></i>
        </div>
      </div>
    </div>
  </section>

  <!--code of contact -->

  <section class="cta">
    <h1>
      Enroll for our various online courses <br />
      anywhere from the world
    </h1>
    <a href="" class="button-next">CONTACT US</a>
  </section>

  <!--code of footer -->

  <?php include "Component/footer.php" ?>

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
      $('.delete-course').click(function (e) {
        e.preventDefault();
        var course_id = $(this).data('course-id');

        if (confirm('Are you sure you want to delete this course?')) {
          $.ajax({
            type: 'GET',
            url: 'ModuleCourses/supprimerCourse.php',
            data: { course_id: course_id },
            success: function (response) {

              console.log(response);
              $(e.target).closest('.courses-col').remove();
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