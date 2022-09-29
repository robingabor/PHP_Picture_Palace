<?php
// START A SESSION
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href='css/style.css' rel='stylesheet' type='text/css'/>
</head>
<body  style="background-color: dodgerblue">

    <div style="max-width: 1200px; min-width: 150px;height:100vh; margin: auto;display: flex;flex-direction:column; align-items:center; align-content:space-between; padding:10px; color:white; font-family:Helvetica;  background-color: #ffbb33;">

        <h1 style="text-align:center;">Dear <span style="color:dodgerblue; font-weight:bold;"><?php echo $_SESSION['user']['name'] ?? '' ?>,</span> thank you for your booking!</h1>
        <h3 style="text-align:center;">Your Booking Details are the following: </h3>

        <table style="border:10px solid DodgerBlue;min-height:400px; font-size: 1.5rem;margin: 20px; padding: 32px;line-height: 2; display:flex;flex-direction:column;justify-content:center;align-items:center;">
      
                <tr style="color:aliceblue;">
                    
                    <td style="color:dodgerblue; font-weight:bold;">Title: </td>
                    <td> <?php echo $_SESSION['booking_movie']['title'] ?? "" ?></td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Date: </td>
                    <td><?php echo $_SESSION['booking_movie']['date'] ?? "" ?></td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Time: </td>
                    <td><?php echo $_SESSION['booking_movie']['timeslot'] ?? "" ?></td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Runtime: </td>
                    <td><?php echo $_SESSION['booking_movie']['running_time'] ?? "" ?></td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Seats: </td>
                    <td><?php echo $_SESSION['booking_movie']['selectedSeats'] ?? "" ?></td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Price: </td>
                    <td><?php echo $_SESSION['booking_movie']['totalPrice'] ?? "" ?></td>
                </tr>        
            
        </table>
            
        
        
        <center><h3>Enjoy the movie</h3></center>
        <center><small>Please buy your tickets 30 minutes before the beginning of the film, otherwise your reservation will be cancelled </small>  </center>
        <center><h1><a href="../index.php">BACK TO THE MAIN PAGE</a></h1>  </center>

    </div>
    
        
        
        
</body>
</html>