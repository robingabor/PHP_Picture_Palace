<?php

require('webpage.php');
require('functions.php');
require('insert.php');    
   


// Átveszem az AJAX-on küldött változókat és SESSION-be rögzítem
if(isset($_POST['timeslot']) && isset($_POST['date'])){
    
    $session->setParameter('booking_movie','timeslot',$_POST['timeslot']);
    $session->setParameter('booking_movie','date',$_POST['date']);
    // print_r($_POST);
}
if(isset($_REQUEST['selectedSeats']) && isset($_POST['totalPrice'])){
   
    $session->setParameter('booking_movie','selectedSeats',$_POST['selectedSeats']);
    $session->setParameter('booking_movie','totalPrice',$_POST['totalPrice']);
}
print_r($_SESSION['booking_movie']);
#ITT NÉZZÜK MEG,HOGY FOGLALT_E MÁR
$alreadyBooked = $bookings->alreadyExist($_SESSION['booking_movie']['date'],$_SESSION['booking_movie']['timeslot'],$_SESSION['booking_movie']['id']);

print_r($alreadyBooked); // Működik, fasza 




$bookseats= new Webpage();


$bookseats->content ="<div class='d-flex flex-column justify-content-center align-items-center bg-muted text-white'>";


$bookseats->content .="<div class='ticket-select-container'>";
    $bookseats->content .="<h4><label>Please Select a Ticket type</label></h4>";
        # SELECT FOR DIFFERENT TICKET PRICE OPTIONS
        $bookseats->content .="<select class='w-100 mx-auto form-control bg-warning font-weight-bold' id='ticket'>";
            $bookseats->content .="<option value='50' class='font-weight-bold'>Student 50% off</option>";
            $bookseats->content .="<option value='50' class='font-weight-bold'>Pensioner 50% off</option>";
            $bookseats->content .="<option value='100' class='font-weight-bold'>Adult</option>";
    $bookseats->content .="</select>";
$bookseats->content .="</div>";

# SHOWCASE LIST OF THE SEATS
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
    
$bookseats->content .="<div id='container'>"; // Container for the seats
$bookseats->content .="<div class='screen'></div>"; // SCREEN
        # Here comes the screen
        $id = 0; // counter
        for($i=1;$i<=6;$i++){  // NÉZŐTÉR SORAINAK SZÁMA

            if($alreadyBooked):
                $indexes = array();
                $explodedIndexes = "";
                foreach($alreadyBooked as $key=>$value):
                    echo $value;
                    //we want to make an array from our  $value string
                    // wich contains the  timeslots and seats already booked (timeslot => seats)
                    $indexes[] = substr($value,1,strpos($value,"]")-1);
                    // now we can make an array out of our indexes
                    $explodedIndexes = implode(",", $indexes);
                    $explodedIndexes = explode(",",$explodedIndexes);
                    print_r($explodedIndexes);
                    // for($k=0;$k<sizeof($explodedIndexes);$k++){
                    //     echo $explodedIndexes[$k];
                    // }              
    
                endforeach;
            endif;
            
            // miden elemre seat class valamint occupied classt, ami ha szerepel a alreadyBooked-ban, akkor-> vagyis FOGLALT

            $bookseats->content .="<div class='row'>";
            
            for($j=1;$j<=8;$j++){ // NÉZŐTÉR OSZLOPAINAK SZÁMA
                if($alreadyBooked && in_array($id,$explodedIndexes)){
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

    //  MODAL start 
    //  LETS INCLUDE OUR MODAL 

    include('./Template/modal/modal_template.php');
    
    //  ! MODAL end 
         
    
$bookseats->content .="</div>";

# CALLING OUR DISPLAY METHOD
$bookseats->Display();


?>

<script>
        
    $('#book').click(function(){
        sendPostReq();
        var price = $("#price").html();
        var seats = $("#seats").html();
        console.log('Zár:',price);
        console.log('Ülések',seats);
        // beszetteljük az inputjaink value attribútumát, amit aztán elmentünk az adatbázisban
        $("input[name|='seats']").attr("value",seats);
        $("input[name|='price']").attr("value",price);

        var alreadyBooked = "<?php $alreadyBooked;?>";
        console.log('Bookings:',alreadyBooked);


       
                       
        var timeslot = $(this).attr('data-timeslot');
        var modalContent = document.querySelector('.modal-content');
        // WTF  IS SLOT
       $('#slot').html(timeslot); 
       $('#timeslot').val(timeslot);
       $('#myModal').modal('show');    
        
        
    //    $('#myModal').submit(function(){
                           
            
    //     });        
    
    });
       
    

    // alert showing function
    function showConfirmationMessage(){
            let modalHeader = document.querySelector('.modal-header');
            let modalBody = document.querySelector('.modal-body');
            let modalContent = document.querySelector('.modal-content');
                                    
            modalHeader.innerHTML = "";
            modalBody.style.display = "none"
            // let message = document.createElement('h4');
            // message.classList.add('modal-title font-weight-bold text-primary');
            // message.innerText = "Your Booking was succesfull, you will recieve a confirmation email soon";
            // modalBody.appendChild(message);
            modalHeader.innerHTML = "<h4 class='modal-title font-weight-bold text-primary'>Your Booking was succesfull, you will recieve a confirmation email soon</h4>";

    }
    
    // var lots_of_stuff_already_done = false;

    // $('#myModal').on('submit', function(e) {
    //     if (lots_of_stuff_already_done) {
    //         lots_of_stuff_already_done = false; // reset flag
    //         return; // let the event bubble away
    //     }

    //     e.preventDefault();

    //     // do lots of stuff
    //     showConfirmationMessage()

    //     lots_of_stuff_already_done = true; // set flag
    //     $('#myModal').trigger('submit');
    // });


    document.getElementById("modalForm").addEventListener("submit", function(event){
             
               
        // II. Working
        function syncDelay(milliseconds){
            var start = new Date().getTime();
            var end = 0;
            while((end-start)<milliseconds){                
                end = new Date().getTime();                                
            }
        }  
        showConfirmationMessage()      
        syncDelay(5000)        
                               
        //Submitting or form            
        // document.getElementById("myModal").submit();
        // $('#myModal').submit(function(){
                           
            
        // });   
    });
    

</script>


