<?php

session_start();

class SendMails{
    public $to;
    public $subject;
    public $txt;
    public $headers;
    public $from;
    public $cc;
}

$user = $_SESSION['user']['userName'] ?? "N/A";
$title = $_SESSION['booking_movie']['title'] ?? "N/A";
$date = $_SESSION['booking_movie']['date'] ?? "N/A";
$timeslot = $_SESSION['booking_movie']['timeslot'] ?? "N/A";
$running_time = $_SESSION['booking_movie']['running_time'] ?? "N/A";
$selectedSeats = $_SESSION['booking_movie']['selectedSeats'] ?? "N/A";
$totalPrice = $_SESSION['booking_movie']['totalPrice'] ?? "N/A";


// testing variable, its a flag basically
// if  it is set to false to email will be sent, if it is set to true the email wont send, developer mode
define("DEMO",true); 

print_r($_SESSION);

// We want to send a formatted html template as our email confirmation
// Location of the html template file we want ot use
$template_file = "./html_email_template.php";

$to = "robin.j.gabor@gmail.com";
$subject = "Booking Confirmation";
// all headers must have correct capitalization

// Lets create an assoc array wich going to replace the key values in our html email template
$swap_var = array(
    "{USER}"=>$user,
    "{TITLE}"=>$title,
    "{DATE}"=>$date,
    "{TIME}"=>$timeslot,
    "{RUNNING_TIME}"=>$running_time,
    "{SEATS}"=>$selectedSeats,
    "{totalPrice}"=>$totalPrice,
    "{POSTER}"=>"./web/baby-driver_a597_720x1280.jpg"
);

$headers = "From: PHP Picture Palace <lomutpali@gmail.com>\r\n"; 
// if we would like to send html email, then we have to append more headers
// capitalization of the headers is really important, otherwise the email wont process
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if(file_exists($template_file)){
    // we going to save our template html file as a string basically
    $message = file_get_contents($template_file);
}else{
    die("Unable to locate template file");
}

// SEARCH AND REPLACE ALL THE array keys of  SWAP VAR
foreach(array_keys($swap_var) as $key){
    if(strlen($key)>2 && trim($key) !=""){
        $message = str_replace($key,$swap_var[$key],$message);
    }
}

// Display the eamil message to the user
echo $message;

if(DEMO){
    die("</br>No Email was sent on purpose");
}

if (mail($to,$subject,$message,$headers)) {
    echo "</br>Email successfully sent to $to";
} else {
    echo "Email sending failed...";
}

?>