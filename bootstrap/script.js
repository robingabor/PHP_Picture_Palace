
const container = document.querySelector('.container');
// we select our seats wich are not occupied yet, the result going to be a node list
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const allSeats = document.querySelectorAll('.row .seat');
let count = document.getElementById('count');
    console.log(count.innerHTML);

const total = document.getElementById('total');
const movieSelect = document.getElementById('movie'); // we select the selectour
let ticketPrice = movieSelect.value;
    console.log(typeof ticketPrice);

let seatsIndex;
let seatPrice;



//Save selected movie index and price
function selectedMovieData(movieIndex, moviePrice) {
    localStorage.setItem("selectedMovieIndex",movieIndex);
    localStorage.setItem("selectedMoviePrice",moviePrice);
}


// lets create a functiopn to update total value and the count wich is the number of seats selected
function updateSelectedCount(){
    
    const selectedSeats = document.querySelectorAll('.row .seat.selected');
    
    // we need the seat's id-s
    seatsIndex = [...selectedSeats].map((seat)=>[...allSeats].indexOf(seat));
    seatPrice = [...selectedSeats].map((seat)=>{
        return seat.getAttribute("value")*1;
    });
    console.log(seatsIndex);
    console.log(seatPrice);
    let assoc = {};
        assoc[seatsIndex]=seatPrice;
        console.log(assoc);    
    
    // get the sum of the selected seats's price
    const price =  Object.values(assoc);
    const sumValues =price.reduce((a, b) => a + b,);
    let totalPrice=[...sumValues].reduce(function(acc, val) { return acc + val; }, 0);
 
    

    //lets store in the local storege
    localStorage.setItem("SelectedSeats",JSON.stringify(seatsIndex));
    localStorage.setItem("TotalPrice",JSON.stringify(totalPrice));
    

    console.log(selectedSeats);
    count.innerHTML = selectedSeats.length; 
    total.innerHTML = totalPrice;

}

// movie select event listener
movieSelect.addEventListener('change',(e)=>{
     
    ticketPrice = e.target.value;
    
    selectedMovieData(e.target.selectedIndex, e.target.value);
    updateSelectedCount();
    //Update session
    sendPostReq();

    
});


container.addEventListener('click',function(e){
    
    if(e.target.classList.contains('seat') && !e.target.classList.contains('occupied')){
        
        //we going to add/remove(toggle) a selected class
        e.target.classList.toggle('selected');
        // beszettelem neki a jegy árát a value attributumba
        e.target.setAttribute("value",movieSelect.value);        

        //update count
        updateSelectedCount();
        //Update session
        sendPostReq()
    }
});

function sendPostReq(){

    let totalPrice    =  localStorage.getItem("TotalPrice");        
    let selectedSeats =  localStorage.getItem("SelectedSeats");

        console.log(selectedSeats);
        console.log(totalPrice);
            
    // Send Ajax request to backend.php           
    $.post("book_seats.php", {totalPrice: totalPrice,selectedSeats: selectedSeats},function(data,status){
        $("#price").html(totalPrice);
        $("#seats").html(selectedSeats);
    }); 

    // $.ajax({
    //     url: 'book_seats.php',
    //     method: 'POST',
    //     data: {
    //         totalPrice: totalPrice,
    //         selectedSeats: selectedSeats
    //     },
    //     success: function(){
    //         location.reload();
    //     }
    // });
    // location.replace("book_seats.php");

    // const xhr = new XMLHttpRequest();
    //     xhr.onload = function(){
    //         // console.log(this.responseText);
            
    //     };
    //     // Sending POST data with Ajax in JS
    //     xhr.open("POST","book_seats.php",true);
    //     //we have to set the content type of our request body we gouign to send
    //     xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //     // Now lets actually send the request
    //     let totalPrice = localStorage.getItem("TotalPrice");
        
    //     let selectedSeats =  localStorage.getItem("SelectedSeats");

    //     console.log(selectedSeats);
    //     console.log(totalPrice);
        
        

    //     xhr.send("selectedSeats="+selectedSeats+"&totalPrice="+totalPrice);       
        
        
}



        
        
        

