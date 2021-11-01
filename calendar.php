<?php

require('db_connect.php');
$Conn;
ConnectDB($Conn); // csatlakozás

function build_calendar($date,$timestamp,$Conn){
    $stmt = $Conn->prepare("SELECT * FROM bookings WHERE date=? AND timeslot=?");
    $stmt->bind_param("ss",$date,$timestamp);
    $bookings = ();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
            }
        }
        $stmt->close();
    }
}


?>