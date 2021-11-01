<?php
session_start();
require('db_connect.php');
$Conn;
ConnectDB($Conn); // csatlakozás

# bookings táblát szeretnénk feltölteni    
// csatlakozás-> paraméteren fogjuk átvenni
if(isset($_POST['submit'])){ // átvesszük a foglalás adatait Post-on
    
       insertBooking($Conn);
}



function insertBooking($Conn){ // $bookings-kell e vajh ide  
    
    $date = $_POST['date'];
    $timeslot = $_POST['timeslot'];
    $customer_id = $_SESSION['user']['id'];
    $movie_id = $_POST['id'];
    $total_price = $_POST['price'];
    $seats = $_POST['seats']; 

    // hogyan fogjuk befűzni
    $sql = "INSERT INTO bookings(date,timeslot,customer_id,movie_id,total_price,seats)
    VALUES('$date','$timeslot','$customer_id','$movie_id','$total_price','$seats')";

    // query kell, true vagy false-t kaopunk hogy sikerült -e
    if($Conn->query($sql)){
    echo "SIKERES FOGLALÁS" . "</br>";
    // we going to fill an array with the bookings
    // $bookings[][$date] =$timeslot; 
    // print_r($bookings);
    require('mail_sender.php');
    // header('Location: index2.php');
    }else{
        echo "SIKERTELEN FOGLALÁS" . "</br>";
        echo $Conn->error;
    } 
}

function alreadyExist($Conn,$bookings,$date,$timeslot,$movie_id){
    //LETS CHECK LATER IF IT IS ALREADY BOOKED OR NOT
    $sql2 = "SELECT * FROM bookings
            WHERE movie_id='$movie_id' AND date='$date' AND timeslot='$timeslot' ";
    
    $result = $Conn->query($sql2);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $rowDate = $row['date'];
            $rowTimeslot =$row['timeslot'];
            $rowSeats = $row['seats'];
            $bookings[$rowTimeslot] = $rowSeats;
            // var_dump($bookings);
            return $bookings;
    }
    }
}


    // # Ugyan az prepared staement-tel
    // // we going to use prepared statement
    // $stmt = $Conn->prepare("INSERT INTO bookings (date,timeslot,customer_id,movie_id,total_price,seats)
    //                         VALUES(?,?,?,?,?,?)");
    // $stmt->bind_param('ssssss',$date,$timeslot,$customer_id,$movie_id,$total_price,$seats);
    // //execute
    // $stmt->execute();
    // $stmt->close();     

?>