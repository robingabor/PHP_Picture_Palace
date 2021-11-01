<?php

session_start();

require('webpage.php');

require('db_connect.php');

$Conn;
ConnectDB($Conn); // csatlakozás

//Select all the movies from moovie db
$sql = "SELECT id,title,description, release_date,language,running_time,genre,poster
        FROM movies
        ORDER BY release_date ";

// make query and get results
$result = mysqli_query($Conn,$sql);

// get the result ( fetch)
// fetch the resulting rows as an associative array
$movies = mysqli_fetch_all($result,MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

CloseDB($Conn); // kapcoslat bontása


$index = new Webpage();

//we set the content to display

$index->content .="<section class='section'>";

$index->content .="<ul id='autoWidth'>";

$classSuffix='a';

foreach($movies as $movie){

        $index->content .="<li class='item-$classSuffix'>";
                // EZ JÖN mAJD a helyére
                        $index->content .="<div class='box'>";
                        $index->content .= "<div class='slide-img'>";
                                $index->content .="<img src='web/".$movie['poster']."' alt=''>";
                                // we going to need an overlayer
                                $index->content .="<div class='overlay'>";
                                        // buy-btnú                                        
                                        $index->content .="<a class='buy-btn' href='details.php?id=".$movie['id']."' >More Details and Booking</a>";
                                        // $index->content .="<input style='width:160px;height:40px;' type='button' value='More Details and Booking'/>";                                        
                                        
                                $index->content .="</div>";
                        $index->content .="</div>";  
                        $index->content .="<div class='detail-box'>";
                                $index->content .="<div class='type'>"; 
                                        $index->content .="<a href='#'>".$movie['title']."</a>";  
                                        $index->content .="<span>New Arrival</span>";                   
                                $index->content .="</div>";
                                $index->content .="<a href='#' class='price'>".$movie['running_time']." min</a>";
                        $index->content .="</div>";
                $index->content .="</div>";  
        $index->content .="</li>";

        $classSuffix++;
}
  
  $index->content .="</ul>";  

  $index->content .="</section>";
    


$index->Display();



?>

<!-- <link type="text/css" rel="stylesheet" href="css/lightslider.css" />                  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/lightslider.js"></script>
<script src='js/slider.js'></script> -->

<!-- JÖHET PÁR script link a slider kezeléséhez -->
<!-- 
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src='js/lightslider.js' ></script>;
<script src='js/slider.js'></script> -->