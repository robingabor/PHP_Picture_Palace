<?php

session_start();

session_unset( $_SESSION['userID']);

$_SESSION = array();

session_destroy();

header('Location: index2.php');

?>