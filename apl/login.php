<?php

session_start();
//header("Content-Type: text/html;charset=UTF-8");

if(isset($_POST['password'])){
	$_SESSION['loginJoutai'] = md5($_POST['password']);
}

if(isset($_GET['password'])){
	$_SESSION['loginJoutai'] = md5($_GET['password']);
}

header("location:admin.php");

?>