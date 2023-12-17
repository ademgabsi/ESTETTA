<?php
include SITE_ROOT . '/Controller/UserC.php';
include '../../config.php';

$userC = new UserC();
$message = [];

if (isset($_POST['submit'])) {
    $db = config::getConnexion();

    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass = filter_var(sha1($_POST['pass']), FILTER_SANITIZE_STRING);


    $row = $userC->login($email, $pass);
 
    if ($row) {
        setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
        if ($row['role'] == 0) {
            header('location:../FrontOffice/Acceuil.php');

        } else {
            header('location:../FrontOffice/Acceuil.php');
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="darkmode.css">
    <style>
        /* Reset some default styles */
        body,
        h1,
        h2,
        h3,
        p,
        input,
        button {
            margin: 3;
            padding: 3;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            transition: background-color 0.3s, color 0.3s;
            /* Add transition for smoother mode switch */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('http://localhost:8083/2/crud/Assets/FrontOffice/images/pexels-ylanite-koppens-2008145.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }


        .form-container {
            max-width: 600px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #fff;
            padding: 60px;
            border-radius: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, color 0.3s;
            margin: 50px auto;
        }

        /* Form styling */
        .login {
            text-align: center;
        }

        .login h3 {
            margin-bottom: 20px;
            color: #007bff;
            font-size: 24px;
        }

        /* Input box styling */
        .box {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 30px;
            background-color: #f5f5f5;
            color: #495057;
            transition: border-color 0.3s;
            font-size: 16px;
        }

        .box:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Link styling */
        .link {
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            font-size: 14px;
        }

        /* Button styling */
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 18px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Message styling */
        .message {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            position: relative;
            font-size: 14px;
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

</head>

<body style="padding-left: 0;">
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
    </button>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message form">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>

    <!-- register section starts  -->

    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="login" onsubmit="return validateForm()">
            <h3>welcome back!</h3>
            <p>Your Email <span></span></p>
            <input type="email" id="email" name="email" placeholder="enter your email" maxlength="50" class="box">
            <p>Your Password <span></span></p>
            <input type="password" id="pass" name="pass" placeholder="enter your password" maxlength="20" class="box">
            <p class="link">Don't have an account? <a href="register.php">Register new</a></p>
            <input type="submit" name="submit" value="Login now" class="btn">
        </form>
    </section>


    <script src="darkmode.js"></script>


</body>

</html>