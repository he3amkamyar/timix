<?php

session_start();
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['is-admin']);
setcookie("email",null,-1); 
unset($_COOKIE['email']);
header('Location: index.php');