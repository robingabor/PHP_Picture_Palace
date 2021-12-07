<?php

require('webpage.php');
require('functions.php');
require('login-process.php');

// when the request arrives via POST method 
// then we going to require register-process.php 
// if($_SERVER['REQUEST_METHOD']== 'POST'){
    
// }

if(isset($_SESSION['userID'])){
    
    print($_SESSION['userID']);
    $user = get_user_info($Conn,$_SESSION['userID']);

}

// Connecting to our db
$Conn= $db->con;

$user = array();


$imgSrc = isset($user['profileImage']) ? $user['profileImage'] : 'assets/instagram-profile-icon-by-Vexels.png';

// Lets create an assoc array wich going to replace the key values in our html  template
$swap_var = array(
    "{IMG_SRC}"=>$imgSrc
);



if(file_exists('Template\login.template.php')){
    // we going to parse our template html file as a string basically
    $html = file_get_contents('Template\login.template.php');
}else{
    die("Unable to locate template file");
}

// SEARCH AND REPLACE ALL THE array keys in the HTML template 
foreach(array_keys($swap_var) as $key){
    if(strlen($key)>2 && trim($key) !=""){
        $html = str_replace($key,$swap_var[$key],$html);
    }
}

// Creating a new login page
$login = new Webpage();

// Populate its content
$login->content = $html;

// Lets display our content
$login->Display();

// Close the connection
$Conn->close();


?>
<!-- Húzzuk be a js file-okat -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src='js/main.js'></script>