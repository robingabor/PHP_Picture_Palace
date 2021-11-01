<?php
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


$index->content ="<div class='container-fluid'>";


$index->content .= "<div id='demo'  class='carousel slide' data-ride='carousel'>";


$index->content .="<div class='carousel-inner row justify-content-around'>";
    
    $count=0;
    foreach($movies as $movie){       
        
        if($count==0){
                $index->content .="<div class='col carousel-item active'>";
        }else{
                $index->content .="<div class='col carousel-item'>";
        }
        
        $index->content .="<img src='web/".$movie['poster']."' class='w-25 border border-warning' style='filter: hue-rotate(270deg)' alt='Los Angeles' >";
        $index->content .="<div class='carousel-caption'>";
        $index->content .="<h2><a style='filter: hue-rotate(90deg)' href='details.php?id=".$movie['id']."'>More Details and Booking</a></h2>";
        $index->content .="<p>for the Movie: </p>";
        $index->content .="<h3>".$movie['title']."</h3>";
       
        $index->content .="</div>";   
        $index->content .="</div>";
         
        $count++;
}

$index->content .="</div>"; // carouser inner záró
$index->content .="<a class='carousel-control-prev' role='button' href='#demo' data-slide='prev'>";
        $index->content .="<span class='carousel-control-prev-icon'></span>";
        $index->content .="<span class='sr-only'>Previous</span>";
        $index->content .="</a>";
        $index->content .="<a class='carousel-control-next' role='button' href='#demo' data-slide='next'>";
        $index->content .="<span class='carousel-control-next-icon'></span>";
        $index->content .="<span class='sr-only'>Next</span>";
        $index->content .="</a>"; 
$index->content .="</div>";

$index->content .="</div>"; // container záró
    
    


$index->Display();



?>