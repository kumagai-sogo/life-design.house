<?php
session_start();
//header("Content-Type: text/html;charset=UTF-8");

unset($_SESSION['loginJoutai']);

header("location:admin.php");

?>