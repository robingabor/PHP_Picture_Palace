<?php

session_start();

require('webpage.php');
require('login-process.php');

$Conn;
ConnectDB($Conn); // Connect


$user = array();

if(isset($_SESSION['userID'])){

    // $user = get_user_info($_SESSION['userID']);
    print($_SESSION['userID']);
    $user = get_user_info($Conn,$_SESSION['userID']);
}

$login = new Webpage();

$imgSrc = isset($user['profileImage']) ? $_SESSION['userID'] : 'assets/instagram-profile-icon-by-Vexels.png';


$login->content ='<section class="d-flex justify-content-center text-center" id="login">';
        
    $login->content .='<div class="row m-0">';
        $login->content .='<div class="col-lg-4 offset-lg-2">';
            $login->content .='<div class="text-center pb-5">';
                $login->content .='<h1 class="login-title text-dark">Login</h1>';
                $login->content .='<p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features</p>';
                $login->content .='<span class="font-ubuntu text-black-50">Create a new<a href="registration.php">Account</a> </span>';
            $login->content .='</div>';
            $login->content .='<div class="upload-profile-image d-flex justify-content-center pb-5">';
                $login->content .='<div class="text-center">';                    
                
                    $login->content .="<img src='$imgSrc' style='width:200px;height:200px;background:white' class='img rounded-circle' alt='profile'>";                    
                    
                $login->content .='</div>';             

        $login->content .='</div>';

        $login->content .='<div class="d-flex justify-content-center">';
            $login->content .='<form action="login.php"  method="post" enctype="multipart/form-data" id="login-form">';
                
                    $login->content .='<div class="form-row my-4">';
                        $login->content .='<div class="col">';
                            $login->content .="<input type='email' required name='email' id='email' class='form-control' placeholder='Email'>";
                            $login->content .='</div>';
                        $login->content .='</div>'; 

                    $login->content .='<div class="form-row my-4">';
                        $login->content .='<div class="col">';
                            $login->content .='<input type="password" required name="password" id="password" class="form-control" placeholder="Password">';
                        $login->content .='</div>';
                    $login->content .='</div>';                    
                   
                    $login->content .='<div class="submit-btn text-center my-5">';
                        $login->content .='<button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Login</button>';
                    $login->content .='</div>';
                $login->content .='</form>';

        $login->content .='</div>';

    $login->content .='</div>';

$login->content .='</div>';
$login->content .='</section>';


$login->Display();

// $Conn->close();


?>
<!-- Húzzuk be a js file-okat -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src='js/main.js'></script>