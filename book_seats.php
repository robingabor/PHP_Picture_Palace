<?php

session_start();

require('webpage.php');



//ezt fogjuk megtölteni
$bookings = array();
require('insert.php');    


// Átveszem az AJAX-on küldött változókat
if(isset($_POST['timeslot']) && isset($_POST['date'])){
    $_SESSION['booking_movie']['timeslot'] = $_POST['timeslot'];
    $_SESSION['booking_movie']['date'] = $_POST['date'];
}
if(isset($_REQUEST['selectedSeats'])&& isset($_POST['totalPrice'])){
    unset($_SESSION['booking_movie']['moviePrice']);
    $_SESSION['booking_movie']['selectedSeats'] = $_POST['selectedSeats'];
    $_SESSION['booking_movie']['totalPrice'] = $_POST['totalPrice'];
}
print_r($_SESSION['booking_movie']);
#ITT NÉZZÜK MEG,HOGY FOGLALT_E MÁR
$bookings = alreadyExist($Conn,$bookings,$_SESSION['booking_movie']['date'],$_SESSION['booking_movie']['timeslot'],$_SESSION['booking_movie']['id']);

print_r($bookings); // Működik, fasza 




$bookseats= new Webpage();


$bookseats->content ="<div class='d-flex flex-column justify-content-center align-items-center bg-muted text-white'>";


$bookseats->content .="<div class='movie-container'>";
    $bookseats->content .="<h4><label>Please Select a Ticket type</label></h4>";
        $bookseats->content .="<select class='w-100 mx-auto form-control bg-warning font-weight-bold' id='movie'>";
            $bookseats->content .="<option value='50' class='font-weight-bold'>Student 50% off</option>";
            $bookseats->content .="<option value='50'>Pensioner 50% off</option>";
            $bookseats->content .="<option value='100'>Adult</option>";
    $bookseats->content .="</select>";
$bookseats->content .="</div>";

$bookseats->content .="<ul class='showcase'>";
    $bookseats->content .="<li>";
        $bookseats->content .="<div class='seat'></div>";
        $bookseats->content .="<small>N/A</small>";
    $bookseats->content .="</li>";
    $bookseats->content .="<li>";
        $bookseats->content .="<div class='seat selected'></div>";
        $bookseats->content .="<small>Selected</small>";
    $bookseats->content .="</li>";
    $bookseats->content .="<li>";
        $bookseats->content .="<div class='seat occupied'></div>";
        $bookseats->content .="<small>Occupied</small>";
    $bookseats->content .="</li>";
$bookseats->content .="</ul>";
    
$bookseats->content .="<div class='container'>"; // Container for the seats
$bookseats->content .="<div class='screen'></div>"; // SCREEN
        # Here comes the screen
        $id = 0; // counter
        for($i=1;$i<=6;$i++){  // NÉZŐTÉR SORAINAK SZÁMA

            if($bookings){
                foreach($bookings as $key=>$value){
                    echo $key;
                    //we want to make an array from our  $value string
                    $indexes = substr($value,1,strpos($value,"]")-1);
                    $explodedIndexes = explode(",", $indexes);
                    print_r($explodedIndexes);
                    for($k=0;$k<sizeof($explodedIndexes);$k++){
                        echo $explodedIndexes[$k];
                    }              
    
                }
            }
            
            // miden elemre occupied classt, ami ha szerepel a bookings-ban, akkor-> vagyis FOGLALT
            // máskülönben pedig ""

            $bookseats->content .="<div class='row'>";
            
            for($j=1;$j<=8;$j++){ // NÉZŐTÉR OSZLOPAINAK SZÁMA
                if($bookings && in_array($id,$explodedIndexes)){
                    $bookseats->content .="<div id='$id' class='occupied seat'></div>";
                    $id++;
                }else{
                    $bookseats->content .="<div id='$id' class='seat'></div>";
                    $id++;
                }                                
                
            }
            
            $bookseats->content .="</div>";
        }        

    $bookseats->content .="</div>";

    // $bookseats->content .="<div id='seats'></div>";
    // $bookseats->content .="<div id='price'></div>";
    
    

    $bookseats->content .="<button id='book' type='submit' class='btn btn-warning'>Book Selected Seats</button>";
    // $bookseats->content .="<a href='\javascript:sendPostReq()\'><input type='submit' >PROÓBA<input></a>";

    $bookseats->content .="<h3 >You have selected: <span id='count' class='text-warning'>0</span> Seats, for a price of $ <span id='total' class='text-warning'>0</span> </h3>";

    // <!-- # MODAL TESZT -->
    $bookseats->content .="<div id='myModal' class='modal fade' role='dialog'>";
        $bookseats->content .="<div class='modal-dialog'>";

    // <!-- Modal content-->
            $bookseats->content .="<div class='modal-content'>";
                $bookseats->content .="<div class='modal-header'>";
        
        // <!-- Ide jön a foglalás dátuma  -->
                    $bookseats->content .="<h4 class='modal-title text-primary'>Your booking details are the following: <span id='title'></span></h4>";        
                    $bookseats->content .="</div>";
                $bookseats->content .="<div class='modal-body'>";
                $bookseats->content .="<div class='row'>";
                $bookseats->content .="<div class='col-md-12'>";
                // <!-- egy formot akarunk a modalunkba rakni -->
                $bookseats->content .="<form action='insert.php' method='POST'>";
                $bookseats->content .="<div class='form-group text-danger d-flex justify-content-space-around'>";
                $bookseats->content .="<label for='' class='text-center'>Date : </label>";
                $bookseats->content .="<input readonly name='date' class='border-0 text-primary text-center' value=".$_SESSION['booking_movie']['date'].">";
                $bookseats->content .="</div>";                
                $bookseats->content .=" <div class='form-group text-danger'>";
                $bookseats->content .="<label for='' class='text-center'>Movie Title : </label>";                    
                $bookseats->content .="<input readonly name='title' class='border-0 text-primary text-center' value=".$_SESSION['booking_movie']['title'].">";
                $bookseats->content .="</div>";
                $bookseats->content .="<div class='form-group text-danger'>";
                $bookseats->content .="<label for='' class='text-center'>Selected seats: </label>";                     
                $bookseats->content .="<input type='hidden' readonly name='seats' class='text-center'><span id='seats' class='text-primary text-center'></span></input>";
                $bookseats->content .="</div>";                    
                $bookseats->content .="<div class='form-group text-danger'>";
                $bookseats->content .="<label for='' class='text-center'>Timeslot : </label>";
                $bookseats->content .="<input readonly name='timeslot' class='border-0 text-primary text-center' value=".$_SESSION['booking_movie']['timeslot'].">";
                $bookseats->content .="</div>";
                $bookseats->content .="<div class='form-group text-danger'>";
                $bookseats->content .="<label for='' class='text-center'>Total price : </label>";
                $bookseats->content .="<input type='hidden' readonly name='price'  ><span id='price'  class='text-primary text-center'></span></input>";
                $bookseats->content .="</div>";
                $bookseats->content .="<input type='hidden' readonly name='id' value=".$_SESSION['booking_movie']['id']."></input>";
                $bookseats->content .="<div class='form-group float-left text-danger'>";
                $bookseats->content .="<label for='' class='text-center'></label>";
                $bookseats->content .="<input id='confirm' value='Confirm' class='btn btn-primary' type='submit' name='submit'></input>";
                $bookseats->content .="</div>";

                $bookseats->content .="</form>";
                $bookseats->content .="</div>";
                $bookseats->content .="</div>";
                $bookseats->content .="</div>";
                $bookseats->content .="<div class='modal-footer'>";
                $bookseats->content .="<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
                $bookseats->content .="</div>";
                $bookseats->content .="</div>";

                $bookseats->content .="</div>";
                $bookseats->content .="</div>";

    // $bookseats->content .="<script src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js'></script>"; 
    // $bookseats->content .="<script src='script.js'></script>"; 
        
    
$bookseats->content .="</div>";

# CALLING OUR DISPLAY METHOD
$bookseats->Display();


?>

<!-- Jöhet egy kis jQuery a modal kezelésére -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src='js/script.js'></script>

<script>
        
    $('#book').click(function(){
        sendPostReq();
        var price = $("#price").html();
        var seats = $("#seats").html();
        console.log('Zár:',price);
        console.log('Ülések',seats);
        // modalban lévő input value mezőjének beállítása
        $("input[name|='seats']").attr("value",seats);
        $("input[name|='price']").attr("value",price);

        var bookings = "<?php $bookings;?>";
        console.log('Bookings:',bookings);


       
                       
        var timeslot = $(this).attr('data-timeslot');
       $('#slot').html(timeslot);
       $('#timeslot').val(timeslot);
       $('#myModal').modal('show');       
       $('#myModal').submit(function(){
                           
            
        }); 
       
    });
    

</script>


