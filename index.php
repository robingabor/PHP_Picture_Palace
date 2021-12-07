<?php

session_start();

require('webpage.php');
require('functions.php');


$index = new Webpage();

// Lets set the content to display

$index->content .="<section class='section'>";
// Slider start here
$index->content .="<ul id='autoWidth'>";

$classSuffix='a';

foreach($films as $film):

        $index->content .="<li class='item-$classSuffix'>";
                // EZ JÖN mAJD a helyére
                        $index->content .="<div class='box'>";
                        $index->content .= "<div class='slide-img'>";
                                // print_r($film);
                                $index->content .="<img src='web/".$film['poster']."' alt=''>";
                                // we going to need an layer over our img
                                $index->content .="<div class='overlay'>";
                                        // buy-btnú
                                                                        
                                        $index->content .="<a class='buy-btn' href=".sprintf('%s?id=%s','details.php',$film['id'])." >More Details and Booking</a>";
                                        // $index->content .="<input style='width:160px;height:40px;' type='button' value='More Details and Booking'/>";                                        
                                        
                                $index->content .="</div>";
                        $index->content .="</div>";  
                        $index->content .="<div class='detail-box'>";
                                $index->content .="<div class='type'>"; 
                                        $index->content .="<a href='#'>".$film['title']."</a>";  
                                        $index->content .="<span>New Arrival</span>";                   
                                $index->content .="</div>";
                                $index->content .="<a href='#' class='runtime'>".$film['running_time']." min</a>";
                        $index->content .="</div>";
                $index->content .="</div>";  
        $index->content .="</li>";

        $classSuffix++;
endforeach;
  
  $index->content .="</ul>";  

  $index->content .="</section>";
    

// Display the html 
$index->Display();



?>

