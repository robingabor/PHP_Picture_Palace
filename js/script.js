
const container = document.querySelector('#container');
// we select our seats wich are not occupied yet, the result going to be a node list
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const allSeats = document.querySelectorAll('.row .seat');
// Number of selected seats
let count = document.getElementById('count');
    console.log(count.innerHTML);
// Total price of the tickets
const total = document.getElementById('total');
const ticketSelect = document.getElementById('ticket'); // we select the ticket type
let ticketPrice = ticketSelect.value;
    console.log(typeof ticketPrice);

let seatsIndex;
let seatPrice;



//Save index and price of the selected ticket type
function setLocalStorage(key, value) {
    localStorage.setItem(key,value);
}


// lets create a functiopn to update total value and the count wich is the based on number of seats selected
function updateSelectedCount(){
    // first we need all of the selected seats
    const selectedSeats = document.querySelectorAll('.row .seat.selected');
        
    // we need to copy the selected seats into arr and get the seats-indexes
    seatsIndex = [...selectedSeats].map((seat)=>[...allSeats].indexOf(seat));
    seatPrice = [...selectedSeats].map((seat)=>{
        // lets return an array of the price of each selected seat
        return seat.getAttribute("value")*1;
    });
    console.log(seatsIndex);
    console.log(seatPrice);
    
    // Lets sum up each ticket price we selected
    let totalPrice = seatPrice.reduce(function(acc,val){
        return acc + val;
    },0); 
    console.log("summa :", totalPrice);

    // lets store the sum amount and the selected seats in the local storage
    localStorage.setItem("SelectedSeats",JSON.stringify(seatsIndex));
    localStorage.setItem("TotalPrice",JSON.stringify(totalPrice));
    console.log(selectedSeats);    

    
    count.innerHTML = selectedSeats.length; 
    total.innerHTML = totalPrice;

}



function sendPostReq(){

    let totalPrice    =  localStorage.getItem("TotalPrice");        
    let selectedSeats =  localStorage.getItem("SelectedSeats");

        console.log(selectedSeats);
        console.log(totalPrice);
            
    // Send Ajax request to backend           
    $.post("book_seats.php", {totalPrice: totalPrice,selectedSeats: selectedSeats},function(data,status){
        // if we are succesfull we going to set the price and seats field in our modal in the front end
        $("#price").html(totalPrice);
        $("#seats").html(selectedSeats);
    }); 
}


// ticket select event listener
ticketSelect.addEventListener('change',(e)=>{
    console.log("Debug",e.target.value);
    ticketPrice = e.target.value;
    selectedIndex  = e.target.selectedIndex;

    // lets store the selected index and the ticket price in the local storage
    setLocalStorage("ticketPrice", JSON.stringify(ticketPrice));
    setLocalStorage("selectedIndex",JSON.stringify(selectedIndex));
    // update total value and the seat counter
    updateSelectedCount();
    // Send data to our backend with AJAX 
    sendPostReq();
    
});

allSeats.forEach((seat)=>{
    seat.addEventListener('click',(e)=>{
        console.log("KLIKKK!!",e.target);
        if(e.target.classList.contains('seat') && !e.target.classList.contains('occupied')){
            
            //we going to add/remove(toggle) a selected class
            e.target.classList.toggle('selected');
            // beszettelem neki a jegy árát a value attributumba
            e.target.setAttribute("value",ticketPrice);        
    
            // update total value and the seat counter
            updateSelectedCount();
            // Send data to our backend with AJAX
            sendPostReq()
        }
    });
})

    



        
        
        

