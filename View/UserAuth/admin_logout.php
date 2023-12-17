<?php

include '../../config.php';

   setcookie('user_id', '', time() - 1, '/');

   header('location:login.php');

?>