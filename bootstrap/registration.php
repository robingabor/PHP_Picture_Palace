<?php

require('webpage.php');

require('db_connect.php');

require('user_validator.php');

//check if the form was submitted
if(isset($_POST['submit'])){
    // lets validate the entries
    // lets create a new instacne of UserVAlidator
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    //if there arae no errors we would like to save data to our db

}
$username = $_POST['username'] ? $_POST['username'] : '';
$email = $_POST['email'] ? $_POST['email'] : '';
    
$Conn;
ConnectDB($Conn); // csatlakozás

$registration = new Webpage();

$registration->content = "<h1>Plese fill out our registration form</h1>";

$registration->content .="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
    $registration->content .="<h2>Create a new user</h2>";
    // what we need is a username, an email, a psw and the psw again
    $registration->content .= "<label for=''>Username</label>";
    $registration->content .="<input type='text' name='username' value='". $username ."' >";
    $registration->content .="<div class='error'>";
        echo $errors['username'] ?? '';
    $registration->content .="</div>";

    $registration->content .= "<label for=''>Email</label>";
    $registration->content .="<input type='text' name='email' value='". $email ."' >";
    $registration->content .="<div class='error'>";
        echo $errors['email'] ?? '';
    $registration->content .="</div>";

    $registration->content .= "<label for=''>Password</label>";
    $registration->content .="<input type='password' name='psw' >";
    $registration->content .="<div class='error'>";
        echo $errors['psw'] ?? '';
    $registration->content .="</div>";

    $registration->content .= "<label for=''>Password Again</label>";
    $registration->content .="<input type='password' name='psw2' ";
    $registration->content .="<div class='error'>";
        echo $errors['psw2'] ?? '';
    $registration->content .="</div>";
    // <!-- EBBE JÖN MAJD AZ AJAX által szolgáltatott hibák -->
    $registration->content .="<div id='reg-message'></div>";

    $registration->content .= "<input type='submit' value='submit' name='submit'>";
$registration->content .="</form>";

$registration->Display();

$Conn->close();

?>