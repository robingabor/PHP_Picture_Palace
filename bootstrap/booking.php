<?php

session_start();

require('webpage.php');

require('db_connect.php');
    
$Conn;
ConnectDB($Conn); // csatlakozás

$booking= new Webpage();

# variables from query string
//$id=$_GET['id'];
//$running_time=$_GET['running_time'];


// to improve our back-end logic
// we going to use DateTime and TimeInterval objects instead of strtotime and date
$duration = $_SESSION['booking_movie']['running_time']; // how long the movie last
$cleanup = 30;            // its the time between 2 movies in minutes
$start = "09:00";          // opening hour
$end   = "22:00";           //closing time

function timeslots($duration,$cleanup,$start,$end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $durationInterval = new DateInterval("PT".$duration."M"); //Stands for : Period Time x Minutes
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start;$intStart<$end;$intStart->add($durationInterval)->add($cleanupInterval)){
        $periodEnd = clone $intStart;// in every iteration we clone the actual value of the intStart
        $periodEnd->add($durationInterval);
        if($periodEnd > $end){
            break;
        }
        $slots[] = $intStart->format("H:iA")."-".$periodEnd->format("H:iA");
    }
    return $slots;
}

// We going to user DateTime::setIsoDate() in order to get the week
$dt = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}

$year = $dt->format('o');
$week = $dt->format('W');   //actual week
$month = $dt->format('F');  //actual month
$year = $dt->format('Y');   //actual year

# HERE STARTS THE CONTENT
$booking->content = "<div class='container'>";
$booking->content .= "<div class='row'>";
$booking->content .= "<div class='col-md-12'>";

$booking->content .="<center>";
$booking->content .="<h1 class='text-warning'> $month $year</h2>";
$booking->content .="<h1 class='text-warning'>Week : $week</h2>";
//Previous week
// $booking->content .="<a class='btn btn-warning btn-xs' href='" . $_SERVER['PHP_SELF'] . "?week=" . "($week-1)" . "&year=" .$year." '>Previous Week</a>";
// // Current Week
// $booking->content .="<a class='btn btn-warning btn-xs' href='booking.php'>Current Week</a>";
// //Next Week
// $booking->content .="<a class='btn btn-warning btn-xs' href='".$_SERVER['PHP_SELF']."?week="."($week+1)"."&year=".$year."'>Next Week</a>";
$booking->content .="</center>";

$booking->content .="</br></br>";

//Here comes the table
$booking->content .="<table class='table table-dark'>";
$booking->content .="<thead>";//thead start
$booking->content .="<tr>";
$booking->content .="<th scope='col'>#</th>";
$booking->content .="<th colspan='6'>".$_SESSION['booking_movie']['title']."</th>";
$booking->content .="</tr>";
$booking->content .="</thead>"; //thead end
$booking->content .="<tbody>"; //tbody start

do {
    $booking->content .= "<tr>";
    if($dt->format('d M Y')==date('d M Y')){// today
        $booking->content .="<th scope='row' style='background:tomato'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</th>\n";
    }else{
        $booking->content .="<th scope='row'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</th>\n";
    }
    // Lets call our timeslot maker function
    $timeslots= timeslots($duration,$cleanup, $start, $end);
    foreach ($timeslots as $ts){
        // echo "<tr>";
        $booking->content .="<td><button data-date=".$dt->format('Y-m-d')." data-timeslot=".$ts." class='timeslot btn btn-warning btn-xs'> $ts </button></td>";                               
    }
    $booking->content .= "</tr>";
    // kérjük a következő napot
    $dt->modify('+1 day');    
    
} while ($week == $dt->format('W')); // we doing this while we are within the current week

$booking->content .="</tbody>";//tbody end
$booking->content .="</table>";


$booking->content .= "</div>";//col-md-12 end
$booking->content .= "</div>";//row end
$booking->content .= "</div>";//container end



# CALLING OUR DISPLAY METHOD
$booking->Display();



?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>


<script>
    $(".timeslot").click(function(){

      var timeslot = $(this).attr('data-timeslot');
      console.log(timeslot);
      var date = $(this).attr('data-date');
      console.log(date);
      
      
        // Send Ajax request to backend.php, 
        $.post("book_seats.php", {timeslot: timeslot,date: date});        

        location.replace("book_seats.php");

      
    });    
</script>

