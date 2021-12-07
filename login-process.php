<?php

require('functions.php');
require('user_validator.php'); 
require('input_validator.php');

// Connecting to our db
$Conn= $db->con;


// lets create a function to get user info based on the id
function get_user_info($Conn,$userId){
    $query = "SELECT * FROM customer WHERE id = ?";

    $q = mysqli_stmt_init($Conn);
    mysqli_stmt_prepare($q,$query);
    mysqli_stmt_bind_param($q,'i',$userId);
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    return empty($row) ? false : $row;
}

// lets create a new instacne of InputValidator 
$inputValidation = new InputValidator($_POST);


// Lets validate the entries

// Lets validate the entries
if(isset($_POST['submit'])){

    $email = $inputValidation->test_input($_POST['email']);
    $password = $_POST['password'];


    //if there are no errors then we can start to check
    // if the email and psw combo is okay or not
    $errors = $inputValidation->errors;

    if(empty($errors)){
        //  get inspiration message if all good
        echo "There is all good so far keep it up ;) ";

        $query = "SELECT id,name,email,password,profileImage,registerDate FROM customer WHERE email = ?";

        $q = mysqli_stmt_init($Conn);

        mysqli_stmt_prepare($q,$query);

        mysqli_stmt_bind_param($q,'s',$email);

        mysqli_stmt_execute($q);

        $result = mysqli_stmt_get_result($q);

        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        print_r($row);

        if(!empty($row)){
            // lets verify the password if our resulting row is not empty
            echo "a row változó nem üres";
            if(password_verify($password,$row['password'])){

                session_start();
                $_SESSION['user'] = $row;
                
                echo "a jelszavak egyeznek";
                // redirect the user to our index.php
                echo "Password verified";
                header('Location: index.php');
                exit();
            }

        }else{
            // In this case they are not a member yet
            print "You are not a member yet, please register";
        }


    }else{
        echo "Please fill out email and password to login";
    }
    

}



?>