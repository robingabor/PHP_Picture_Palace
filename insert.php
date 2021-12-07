<?php

require('functions.php');



# we would like to populate the booking table
// if we have the needed data from POST and SESSION gloabal vars we are good to insert them  
if(isset($_POST['submit'])){ 
    print_r( $_POST);
    $bookingDetails = array(
        // the array keys are corresponding with the bookings table's schema
        'date' => $_POST['date'],
        'timeslot' => $_POST['timeslot'],
        'customer_id' => $_SESSION['user']['id'] ?? 1,
        'movie_id' => $_POST['id'],
        'total_price' => $_POST['price'],
        'seats' => $_POST['seats']        
    );

    // echo gettype($_POST['seats'])."</br>"; 

    $bookings->insertBooking($bookingDetails);
    
}



    

?>