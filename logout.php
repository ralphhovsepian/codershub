<?php

// Logout from your account
session_start();
include './Classes/User.class.php';

User::logout();

 ?>
