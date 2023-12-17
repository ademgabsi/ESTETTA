<?php
include '../../config.php';
include SITE_ROOT . '/Controller/UserC.php';

$userC = new UserC();

if (isset($_POST['submit'])) {

    $id = uniqid();
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass = filter_var(sha1($_POST['pass']), FILTER_SANITIZE_STRING);
    $cpass = filter_var(sha1($_POST['cpass']), FILTER_SANITIZE_STRING);

    $image = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = uniqid() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $image_folder = SITE_ROOT . '/Assets/BackOffice/User/' . str_replace(' ', '', $rename);
    $image_foldertoSave = 'http://localhost:8083/projetWeb2A-2A11-G6/Assets/BackOffice/User/' . str_replace(' ', '', $rename);


    if ($userC->getByEmail($email)) {
        $message[] = 'Email already taken!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
        } else {

            move_uploaded_file($image_tmp_name, $image_folder);
            $newUser = new User(null, $name, $email, 2, $image_foldertoSave, $pass);
            $userC->register($newUser);
            $message[] = 'New Student registered! Please login now';
            header('location:login.php');

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            background-image: url('http://localhost:8083/2/crud/Assets/FrontOffice/images/pexels-ylanite-koppens-2008145.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-container {
            max-width: 500px;
            margin: 50px auto;
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


        /* Add more styles as needed */
    </style>
    <link rel="stylesheet" href="darkmode.css">
</head>

<body style="padding-left: 0;">
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
    </button>


    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
      <div class="message form">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>

    <!-- register section starts  -->
    <section class="form-container">
        <form class="register" action="" method="post" enctype="multipart/form-data">
            <h3>Register New</h3>
            <div class="flex">
                <div class="col">
                    <p>Your name <span>*</span></p>
                    <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
                    <p>Your email <span>*</span></p>
                    <input type="email" name="email" placeholder="Enter your email" maxlength="20" required class="box">
                </div>
                <div class="col">
                    <p>Your password <span>*</span></p>
                    <input type="password" name="pass" placeholder="Enter your password" maxlength="20" required
                        class="box">
                    <p>Confirm password <span>*</span></p>
                    <input type="password" name="cpass" placeholder="Confirm your password" maxlength="20" required
                        class="box">
                    <p>Select pic <span>*</span></p>
                    <input type="file" name="image" accept="image/*" required class="box">
                </div>
            </div>
            <p class="link">Already have an account? <a href="login.php">Login now</a></p>
            <input type="submit" name="submit" value="Register now" class="btn">
        </form>
    </section>

    <script src="darkmode.js"></script>
</body>

</html>