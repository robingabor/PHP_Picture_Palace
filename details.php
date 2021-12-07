<?php

require('webpage.php');
require('functions.php');


// Connecting to our db
$Conn= $db->con;

// if we pass down (via URL) info with a query string that will be in the $-GEt superglobal assoc array
if(isset($_GET['id'])){
    
    $movie = $movies->getMovieById($_GET['id']);

}

// check if delete form was submitted
if(isset($_POST['delete'])){
    
    $movies->deleteMovieById($_POST['id']);

}

// check if the book form was submitted
if(isset($_POST['book']) ){
    // lets store the needed values if the user is logged in otherwise lets redirect them to the login page   
        $id = filter_input(INPUT_POST,'id');
        $title = filter_input(INPUT_POST,'title');
        $running_time= filter_input(INPUT_POST,'running_time');
        $poster  = filter_input(INPUT_POST,'poster');
                
        // if the uer is logged in then she/he will be able to proceed the booking
        if($user != 'Visitor'){
            $booking_movie = array
            (
            'id' => $id,
            'title' => $title,
            'running_time' => $running_time,
            'poster' => "web/"."{$poster}",
            );
            print_r($_SESSION['booking_movie']);
            // we going to check if the parameter 'booking_movie' already set or not,
            // if it is lets unset it
            if($session->parameterExist('booking_movie')){
                // session_unset( $_SESSION['booking_movie']);                
                $_SESSION['booking_movie'] = array();                
            }            
            $session->insert_value('booking_movie',$booking_movie); 
            // print_r($_SESSION['booking_movie']);            

            header("Location: booking.php?id=$id&running_time=$running_time ");
        }else{
            // if the user is not logged in we send him to the login page
            header("Location: login.php");
        }
           
    
}

$details = new Webpage();

$details->content = "<section class='section d-block'>";

$details->content .="<h2 class='py-5 tect-center text-white'>Movie Details<h2>";

$details->content .="<div class='container rounded' style='background-color:#ffbb33;'>";
// $details->content .="<div class='container rounded' style='background-image:url(web/".$movie['poster'].");opacity: 0.8;background-repeat: no-repeat;background-position: center;'   >";

// $details->content .= "<center><h1 class='p-2' style='color:#0d47a1;filter: hue-rotate(0deg)'>Movie Details</h1></center>";
//we have to check if the movie exist
if($movie){
    // $details->content .="<img src='web/".$movie['poster']."' class='w-25' >";

   $details->content .="<div class='table-responsive py-5'>";
    $details->content .="<table class='table table-borderless w-75 column justify-content-around'>";

        $details->content .="<tr>";
            // $details->content .="<td rowspan='6' class='slide-img img-fluid'><img src='web/".$movie['poster']."' class='w-50 mx-auto d-block' ></td>";
            $details->content .="<td rowspan='6' class='slide-img img-fluid w-25'><img src='web/".$movie['poster']."'  ></td>";
            $details->content .="<td class='font-weight-bold  text-info' >Title:</td>";
            $details->content .="<td><h4 style='color:white;font-weight:bold;'>".htmlspecialchars($movie['title'])."</h4></td>";
        $details->content .="</tr>";

        $details->content .="<tr>";            
            $details->content .="<td class='font-weight-bold  text-info' >Release Date:</td>";    
            $details->content .="<td><h4 style='color:white;font-weight:bold;'>".htmlspecialchars($movie['release_date'])."</h4></td>";
        $details->content .="</tr>";

        $details->content .="<tr>";            
            $details->content .="<td class='font-weight-bold  text-info' >Description:</td>"; 
            $details->content .="<td><h4 style='color:white;font-weight:bold;'>".htmlspecialchars($movie['description'])."</h4></td>";
        $details->content .="</tr>";

        $details->content .="<tr>";            
            $details->content .="<td class='font-weight-bold  text-info' >Language:</td>"; 
            $details->content .="<td><h4 style='color:white;font-weight:bold;'>".htmlspecialchars($movie['language'])."</h4></td>";
        $details->content .="</tr>";

        $details->content .="<tr>";            
            $details->content .="<td class='font-weight-bold  text-info' >Running Time(MIN):</td>";
            $details->content .="<td><h4 style='color:white;font-weight:bold;'>".htmlspecialchars($movie['running_time'])."</h4></td>";
        $details->content .="</tr>";

        $details->content .="<tr>";             
            $details->content .="<td class='font-weight-bold  text-info' >Genre:</td>";
            $details->content .="<td><h4 style='color:white;font-weight:bold;'>".htmlspecialchars($movie['genre'])."</h4></td>";
        $details->content .="</tr>";

    $details->content .="</table>";
    $details->content .="</div>";

   # ezt majd úgy hogy ha admin akkor törölni tudja ha vendég akkor bookolni
    $details->content .="<form action='details.php' method='POST'>";
    $details->content .="<input type='hidden' name='title' value='".$movie['title']."'>";
    $details->content .="<input type='hidden' name='id' value='".$movie['id']."'>";
    $details->content .="<input type='hidden' name='running_time' value='".$movie['running_time']."'>";
    $details->content .="<input type='hidden' name='poster' value='".$movie['poster']."'>";
    //   we have to check if the user is logged in or not
    if($user != 'Visitor'){
        $details->content .="<input type='submit' name='book' value='Book Movie' class='btn btn-primary mx-auto d-block'>";
    }else{
        $details->content .="<input type='submit' name='book' value='Book Movie' onclick='myFunction()' class='btn btn-lg border-3 border-white mx-auto d-block' style='background-color:#0d47a1; color:#ffbb33;font-weight:700;'>";
        $details->content .="<p class='font-weight-bold text-danger'>You Are Not logged in yet</p>";
        $details->content .="<p class='font-weight-bold text-danger'>Please <a href='login.php' >log in</a> in order to process your booking</p>";
    }
    
    $details->content .="<input type='submit' name='delete' value='Delete Movie' class='btn btn-danger btn-lg border-white mx-auto d-block' style='color:#ffbb33;font-weight:700;'>";
    $details->content .="</form>";

}else{
    
    $details->content .= "There is no such movie";
}
$details->content .="</div>";

 

$details->content .="</section>";





$details->Display();

?>

<script>
    function myFunction(){
        alert('Please log in in order to be able to process your booking');
        // window.location.href = "login.php";
    }
</script>