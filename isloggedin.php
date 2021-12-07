<?php
    // session_start();

    // If our user is logged in we welcome her/him and show link to log our,
    // otherwise we echo a link to log in

    if(isset($_SESSION['user'])){                           
                        
        echo "<div class='col'><h3 style='color:white;'>Welcome, ".$_SESSION['user']['name']."<h3></div>";
        echo "<a class='navbar-brand' href='logout.php'><button class='btn btn-primary' type='submit'>Log out <i class='fas fa-sign-in-alt'></i></button></a>";
                        
    }else{
        echo "<a class='navbar-brand' href='login.php'><button class='btn btn-primary' type='submit'>Log in <i class='fas fa-sign-in-alt'></i></button></a>";
    } 

?>