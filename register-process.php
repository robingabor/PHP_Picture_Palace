<?php

require('functions.php');
require('user_validator.php'); 
require('input_validator.php');

// IDE JÖHET A FELTÖLTÖTT KÉP VALIDÁLÁS
// lets create a new instacne of InputVAlidator    
$inputValidation = new InputValidator($_POST,$_FILES);


// Connecting to our db
$Conn= $db->con;

// Lets validate the entries
if(isset($_POST['submit'])){

    $username = $inputValidation->test_input($_POST['username']);

    $email = $inputValidation->test_input($_POST['email']);

    $password = $inputValidation->validate_password($_POST['password'],$_POST['confirm_pwd']);

    // lets grab our value of the input type file
    // wich is in our FILES superglobal
    $files = $_FILES['profileUpload'];

    // print_r($files);

    // we want to store this image in our assets/profile/ folder
    $profileImage = $inputValidation->uplodeProfile("./assets/profile/",$files);

    
    //if there arae no errors we would like to save data to our db
    $errors = $inputValidation->errors;

    if(empty($errors)){
        echo "Valid";

        // register a new user
        // we need to store the above values in our db 

        // lets hash the psw
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        
        // make a query
        $query = "INSERT INTO customer(name,email,password,profileImage,registerDate)";
        $query .= "VALUES(?,?,?,?,NOW())";
        // initialize the statement
        $q = mysqli_stmt_init($Conn);

        // prepared statement
        // this will secure our db from mísql injenction
        mysqli_stmt_prepare($q,$query);

        // we have to bind parameteres to this statement
        mysqli_stmt_bind_param($q,'ssss',$username,$email,$hashed_pass,$profileImage);

        // once the binding is ready we need to execute our statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q)==1){
            // if the registration was succesfully
            // lets head to our login.php
            print "record succesfully inserted";

            // START A SESSION
            session_start();

            // create Session variable wich will equal with our AUTO_INCREMENT generated id
            // mysqli_insert_id returns the id the from the last query
            $_SESSION['userID'] = mysqli_insert_id($Conn);

            header('Location: login.php');
            exit();

        }else{
            print "Error while registration";
        }


        
    }else{
        echo "NOT Valid!!4!";
    }

}

    








?>