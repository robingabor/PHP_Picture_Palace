<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body style="max-width: 800px; min-width: 200px; margin: auto;padding:10px; color:white; font-family:Helvetica;  background-image: linear-gradient(to bottom, rgba(138,43,226,1),rgba(30,144,255,1));">
    <h3 style="text-align:center;">Dear <span style="color:dodgerblue; font-weight:bold;">{USER}</span>, thank you for your booking!</h1>
        <h4 style="text-align:center;">Your Booking Details are the following: </h3>

        <table style="background-color: rgba(138,43,226,1); font-size: 18px;margin: 20px; padding: 10px; display:flex; justify-content:center; ">
      
            <tr style="color:aliceblue;">
                    <td rowspan="6"><img src="{POSTER}" alt="" style="width: 25%;display:block; margin: auto;"></td>
                    <!-- <td rowspan="5" style="background-image:url({POSTER});background-position:center; background-size:cover; width:25%; height:25%; "></td> -->
                    <td style="color:dodgerblue; font-weight:bold;">Movie Title: </td>
                    <td> {TITLE}</td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Date: </td>
                    <td>{DATE}</td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Time: </td>
                    <td>{TIME}</td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Running time: </td>
                    <td>{RUNNING_TIME}</td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Seats: </td>
                    <td>{SEATS}</td>
                </tr>
                <tr style="color:aliceblue;">
                    <td style="color:dodgerblue; font-weight:bold;">Total Price: </td>
                    <td>{totalPrice}</td>
                </tr>        
            
        </table>
            
        
        
        <center><h3>Enjoy the movie</h3></center>
        <center><small>Please buy your tickets 30 minutes before the beginning of the film, otherwise your reservation will be cancelled </small>  </center>
        
        
        
</body>
</html>