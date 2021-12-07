<?php

// Require MySQL connection
include_once('./database/DBController.php');
// Require Movies Class
include_once('./database/Movies.php');
// Require Session Class
include_once('./database/Session.php');
// Require Bookings Class
include_once('./database/Bookings.php');


// New DB Controller Object
$db = new DBController();

// New Movies Object
$movies = new Movies($db);
$films = $movies->getData();

//  New Sesssion Object
$session = new Session();
// Setting User
$user = $_SESSION['user'] ?? 'Visitor';

// New Booking Object
$bookings = new Bookings($db);

?>