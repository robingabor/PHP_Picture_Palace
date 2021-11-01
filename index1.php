<?php
require('webpage.php');

require('db_connect.php');

$Conn;
ConnectDB($Conn); // csatlakozás

//Select all the movies from moovie db
$sql = "SELECT title,description, release_date,language,running_time,genre,poster
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
$index->content = "<h2>Welcome to PHP Picture Palace<h2>";


    $index->content .= "<div class='container' >";
    $index->content .= "<div class='row '>";
    foreach($movies as $movie){
        //row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4
    
    $index->content .="<div class=' card-group col-sm-4 col-md-3 col-lg-3'>";
    // card classa volt : col-sm-4 col-md-3 col-lg-3
    $index->content .="<div class='card '>";
    
    $index->content .="<div class='card-body'>";
    $index->content .="<img class='img-fluid card-img-top' src='web/".$movie['poster']."' alt='Card image cap'>";
    $index->content .="</div>"; // Card body vége

    $index->content .="<h6 class='card-title text-muted'>".$movie['title']."</h6>";
    $index->content .="<p class='card-text'>".$movie['description']."</p>";

    $index->content .="</div>";
    $index->content .="</div>";
}
    $index->content .= "</div >";
    
    $index->content .= "</div >";



$index->Display();



?>