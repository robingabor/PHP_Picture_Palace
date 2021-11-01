<?php
require('webpage.php');

require('db_connect.php');

$Conn;
ConnectDB($Conn); // csatlakozás


// // make query and get results
// $result = mysqli_query($Conn,$sql);

// // get the result ( fetch)
// // fetch the resulting rows as an associative array
// $movies = mysqli_fetch_all($result,MYSQLI_ASSOC);

// // free result from memory
// mysqli_free_result($result);

// CloseDB($Conn); // kapcoslat bontása




$index = new Webpage();

//we set the content to display
$index->content = "<h2>Welcome to PHP Picture Palace<h2>";


    $index->content .= "<div class='container' >";

        //Szűrők
        $index->content .= "<div class='row col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2' >";

            $index->content .= "</br>";
            $index->content .= "<h2 align='center' >Product filter</h2>";
            $index->content .= "</br>";

            $index->content .= "<div '>";

                // slider running_time
                $index->content .= "<div class='form-group'>";
                    $index->content .= "<h3>Running Time</h3>";
                    //MIN running_time
                    $index->content .="<input type='hidden' id='hidden_minimum_rt' value='0'>";
                    // Max running_time
                    $index->content .="<input type='hidden' id='hidden_maximum_rt' value='120'>";
                    $index->content .="<p id='running_time_show'>0-120</p>";
                    $index->content .="<div id='rt_range'></div>";
                $index->content .= "</div>";

                // szűr genre
                $index->content .= "<div class='form-group'>";
                    $index->content .= "<h3>Genre</h3>";
                        
                        $sql = "SELECT DISTINCT(genre) FROM movies
                                ORDER BY genre ";
                       $result = mysqli_query($Conn,$sql);
                       $genres = mysqli_fetch_all($result,MYSQLI_ASSOC);

                                                    
                            $index->content .="<div class='form-group row'>";
                            $index->content .="<div class='list-group-flush'>";
                            foreach($genres as $row)
                            {
                                $index->content .="<div class=''>";
                                $index->content .="<label class='form-check-label'>";
                                    $index->content .="<input type='checkbox' class='form-check-input genre' value='".$row['genre']."' >";
                                    $index->content .=$row['genre'];
                                $index->content .="</label>";
                                $index->content .="</div>";
                            }
                            $index->content .="</div>";
                            $index->content .="</div>";                                

                $index->content .= "</div>";

                // szűr language
                $index->content .= "<div class='form-group'>";
                    $index->content .= "<h3>Language</h3>";

                    $sql2 = " SELECT DISTINCT(language) FROM movies ORDER BY language ";
                    $result2 = mysqli_query($Conn, $sql2);
                    $languages = mysqli_fetch_all($result2, MYSQLI_ASSOC);

                    $index->content .="<div class='form-group row'>";
                            $index->content .="<div class='form-check list-group-flush'>";
                            foreach($languages as $row)
                            {
                                $index->content .="<div class='list-group-item'>";
                                $index->content .="<label class='form-check-label'>";
                                    $index->content .="<input type='checkbox' class='form-check-input language' value='".$row['language']."' >";
                                    $index->content .=$row['language'];
                                $index->content .="</label>";
                                $index->content .="</div>";
                            }
                            $index->content .="</div>";
                            $index->content .="</div>";        
                            

                $index->content .= "</div>";
            
            $index->content .= "</div>"; // collezárás

                          
            

        
        $index->content .= "</div>"; // row-vége
        // SZŰRŐVÉGE    

        $index->content .="<div >";
            $index->content .="<br />";
                $index->content .="<div class='row filter_data'>";
                $index->content .="<div class='col-sm-12 col-md-4 col-lg-3'></div>";

                $index->content .="</div>";
            $index->content .="</div>";
    
    $index->content .= "</div >";  // container



$index->Display();

?>

<!-- Jöhet egy kis jQuery a modal kezelésére -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script >

$(document).ready(function(){

    filter_data();

    function filter_data(){
        var action ='fetch_data';
        var minimum_running_time = $("#hidden_minimum_rt").val();
        var maximum_running_time = $("#hidden_maximum_rt").val();
        // lets store our filtered values
        var genre = get_filter('genre'); // this array contains the checked values
        var language = get_filter('language'); // this array contains the checked values
        //Now we need an ajax request
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            // data we want to send
            data:{action : action,minimum_running_time:minimum_running_time,maximum_running_time:maximum_running_time,
                  genre:genre,language:language},
            //lastly we send success callback function,
            // wich is calleed when AJAX request is completed succesfukky
            success:function(data){
                $(".filter_data").html(data);
            }
        }); 
    }

    function get_filter(class_name){
        var filter = []; // we going to store our values of the selected checkboxes

        // selected class names:
        $('.'+class_name+':checked').each(function(){
            // we going to puch the selected values to our filter array
            filter.push($(this).val());
        });
        return filter;
    }

    $("input").click(function(){
        filter_data();
    });

});

</script>