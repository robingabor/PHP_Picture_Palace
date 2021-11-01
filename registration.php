<?php

session_start();
require('webpage.php');
require('register-process.php');


// when request arrives with POST method 
//     then we going to call our register-process.php file
// if($_SERVER['REQUEST_METHOD']== 'POST'){
//     require('register-process.php');
// }


$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';    


$registration = new Webpage();


$registration->content ='<section class="d-flex justify-content-center text-center" id="register">';
        
    $registration->content .='<div class="row m-0">';
        $registration->content .='<div class="col-lg-4 offset-lg-2">';
            $registration->content .='<div class="text-center pb-5 text-nowrap">';
                $registration->content .='<h1 class="login-title text-white">Register</h1>';
                $registration->content .='<p class="p-1 m-0 font-ubuntu text-white font-weight-bold" style="letter-spacing:2px;">Register and enjoy additional features</hp>';
                $registration->content .='<span class="font-ubuntu"><h4 class="text-warning">Already have an account? <a href="login.php" class="text-white font-weight-bold">Login</a> </h4></span>';
            $registration->content .='</div>';
            
            $registration->content .='<div class="upload-profile-image d-flex justify-content-center pb-5">';
                $registration->content .='<div class="text-center">';
                    $registration->content .='<div class="d-flex justify-content-center">';
                        $registration->content .='<img class="camera-icon" src="assets/icons8-camera-50.png" alt="camera">';
                    $registration->content .='</div>';
                
                    $registration->content .='<img src="assets/instagram-profile-icon-by-Vexels.png" style="width:200px;height:200px;background:white" class="img rounded-circle" alt="profile">';
                    $registration->content .='<h4 class="form-text text-white font-weight-bold text-warning"> Choose Image</h4>';
                    // <!-- HTML5 magic: we can reach this input element outside of the form. -->
                    $registration->content .='<input form="reg-form" type="file" class="form-control-file" name="profileUpload" id="upload-profile">';
            $registration->content .='</div>';             

        $registration->content .='</div>';

        $registration->content .='<div class="d-flex justify-content-center">';
            $registration->content .='<form action="registration.php"  method="post" enctype="multipart/form-data" id="reg-form">';
                $registration->content .='<div class="form-row">';
                    $registration->content .='<div class="col">';
                        $registration->content .="<input type='text' value='$username' name='username' id='username' class='form-control' placeholder='Username'>";
                        $registration->content .='</div>';                                
                    $registration->content .='</div>';
                    $registration->content .='<div class="form-row my-4">';
                        $registration->content .='<div class="col">';
                            $registration->content .="<input type='email' value='$email' required name='email' id='email' class='form-control' placeholder='Email'>";
                            $registration->content .='</div>';
                        $registration->content .='</div>';
                    $registration->content .='<div class="form-row my-4">';
                        $registration->content .='<div class="col">';
                            $registration->content .='<input type="password" required name="password" id="password" class="form-control" placeholder="Password">';
                        $registration->content .='</div>';
                    $registration->content .='</div>';
                    $registration->content .='<div class="form-row my-4">';
                        $registration->content .='<div class="col">';
                            $registration->content .='<input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirm Password">';
                            // <!--  Here comes the error if it is any -->
                            $registration->content .='<small id="confirm-error" class="text-danger"></small>';
                        $registration->content .='</div>';
                    $registration->content .='</div>';
                    $registration->content .='<div class="form-check form-check">';
                        $registration->content .='<input type="checkbox" required name="agreement" class="form-check-input">';
                        $registration->content .='<label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree<a href="#"> terms, conditions and policy</a></label>';
                    $registration->content .='</div>';
                    $registration->content .='<div class="submit-btn text-center my-5">';
                        $registration->content .='<button type="submit" name="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>';
                    $registration->content .='</div>';
                $registration->content .='</form>';
        $registration->content .='</div>';

    $registration->content .='</div>';

$registration->content .='</div>';
$registration->content .='</section>';


$registration->Display();

$Conn->close();


?>
<!-- Húzzuk be a js file-okat -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src='js/main.js'></script>