<?php

require('webpage.php');
require('functions.php');
    
// Connecting to our db
$Conn= $db->con;

print_r($_SESSION['booking_movie']);

$booking= new Webpage();


// to improve our back-end logic
// we going to use DateTime and TimeInterval objects instead of strtotime and date
$duration = $_SESSION['booking_movie']['running_time']; // the movie's duration in minutes
$cleanup = 30;            // its the "cleanup" time between 2 movies in minutes
$start = "09:00";          // opening hour
$end   = "22:00";           //closing hour


$dt = new DateTime();
//  DateTime::setIsoDate()recieves 2 params now: year and weekf
if(isset($_GET['previousWeek']) && isset($_GET['year'])){
    $dt->setISODate($_GET['year'], $_GET['previousWeek']);

    $previousWeek = $dt->sub(new DateInterval('P1W'));
    $previousWeek = $previousWeek->format('W');
    
}else if(isset($_GET['nextWeek']) && isset($_GET['year'])){
    $dt->setISODate($_GET['year'], $_GET['nextWeek']);

    $nextWeek = $dt->add(new DateInterval('P1W'));
    $nextWeek = $nextWeek->format('W');
}else{
    $dt->setISODate($dt->format('o'), $dt->format('W'));  
}



// $year = $dt->format('o');
$week = $dt->format('W');   //actual week, we going to passed in query string
$month = $dt->format('F');  //actual month
$year = $dt->format('Y');   //actual year, we going to passed in query string

# HERE STARTS THE CONTENT
$booking->content = "<section class='section d-block'>";
$booking->content .= "<div class='container'>";
$booking->content .= "<div class='row'>";
$booking->content .= "<div class='col-md-12'>";

$booking->content .="<center>";
$booking->content .="<h2 class='text-warning'> $month $year</h2>";
$booking->content .="<h2 class='text-warning'>Week : $week</h2>";
// Previous week
$booking->content .="<div class='d-flex justify-content-center align-items-center text-center'>";
$booking->content .="<a class='' href='" . $_SERVER['PHP_SELF'] . "?previousWeek=" . "$week" . "&year=" .$year." '><img src='https://img.icons8.com/plasticine/75/000000/circled-chevron-left.png'/></a>";
// Current Week
$booking->content .="<a class='' href='booking.php'><h3 class='text-warning'>Current Week</h3></a>";
//Next Week
$booking->content .="<a class='btn' href='" . $_SERVER['PHP_SELF'] . "?nextWeek=" . "$week" . "&year=" .$year." '><img src='https://img.icons8.com/plasticine/75/000000/circled-chevron-right.png'/></a>";
$booking->content .="</div>";
$booking->content .="</center>";

$booking->content .="</br></br>";

//Here comes the table : it was dark
$booking->content .="<div class='table-responsive py-3'>";
$booking->content .="<table class='table table-success '>";
$booking->content .="<thead>";//thead start
$booking->content .="<tr>";
$booking->content .="<th scope='col'>Date</th>";
$booking->content .="<th colspan='6' class='text-left'>".$_SESSION['booking_movie']['title']."</th>";
$booking->content .="</tr>";
$booking->content .="</thead>"; //thead end
$booking->content .="<tbody>"; //tbody start

do {
    $booking->content .= "<tr>";
    if($dt->format('d M Y')==date('d M Y')){// lets mark today date
        $booking->content .="<th scope='row' style='background:tomato'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</th>\n";
    }else{
        $booking->content .="<th scope='row'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</th>\n"; 
    }
    // Lets call our timeslot maker function
    $timeslots= $bookings->timeslots($duration,$cleanup, $start, $end);
    foreach ($timeslots as $ts){
        // we are not allowed to book dates  wich past the current date and time
        if($dt->format('d M Y') < date('d M Y')){
            $booking->content .="<td><button data-date=".$dt->format('Y-m-d')." data-timeslot=".$ts." disabled class='timeslot btn btn-info btn-xs disabled'> $ts </button></td>";
        }else{
            $booking->content .="<td><button data-date=".$dt->format('Y-m-d')." data-timeslot=".$ts." class='timeslot btn btn-info btn-xs'> $ts </button></td>";
        }                                       
    }
    $booking->content .= "</tr>";
    // kérjük a következő napot
    $dt->modify('+1 day');    
    
} while ($week == $dt->format('W')); // we doing this while we are within the current week

$booking->content .="</tbody>";//tbody end
$booking->content .="</table>";
$booking->content .="</div >";


$booking->content .= "</div>";//col-md-12 end
$booking->content .= "</div>";//row end
$booking->content .= "</div>";//container end
$booking->content .= "</section>";//section end



# CALLING OUR DISPLAY METHOD
$booking->Display();



?>
<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> -->


<script>
    // $(".timeslot").click(function(){

    //   var timeslot = $(this).attr('data-timeslot');
    //   console.log(timeslot);
    //   var date = $(this).attr('data-date');
    //   console.log(date);
      
      
    //     // Send Ajax request to backend.php, 
    //     $.post("book_seats.php", {timeslot: timeslot,date: date});        

    //     location.replace("book_seats.php");
      
    // });
    let slots = document.querySelectorAll('.timeslot');
    slots.forEach(ts=>{
        ts.addEventListener('click',e =>{
            let date = e.target.dataset.date;
            let timeslot = e.target.dataset.timeslot;
            console.log(date, timeslot);
            // Lets send AJAX request to the backend, 
            $.ajax({
                method:"POST",
                url:"book_seats.php",
                data:{
                    timeslot : timeslot,
                    date : date
                }
            }).done(location.replace("book_seats.php"));
        })
    })
</script>

