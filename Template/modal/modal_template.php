

<div id='myModal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>

        <!-- Modal content-->
        <div class='modal-content'>
            <div class='modal-header' >      
                <!-- Ide jön a foglalás dátuma  -->
                <h4 class='modal-title text-primary'>Your booking details are the following: <span id='title'></span></h4>        
            </div>
            <!-- style='background:url(./local/depositphotos_65955703-stock-photo-blank-yellow-ticket.jpg);background-position:center;background-repeat:no-repeat;background-size:cover;' -->
            <div class='modal-body  font-weight-bold'  >                
                    <div class='row'>
                        <div class='col-md-12' >
                            <!-- FORM -->
                            <form action='insert.php' method='POST' class='container' id='modalForm' >

                                <div class="ticket " >
                                    <div class="holes-top"></div>
                                    <div class="title" >
                                        <p class="cinema" >PHP Picture Palace presents</p>
                                        <p class="movie-title" ><?php echo $_SESSION['booking_movie']['title'] ?? '' ?></p>
                                    </div>
                                    <div class="poster" >
                                        <img id='modal_poster_img' src="<?php echo $_SESSION['booking_movie']['poster'] ?>" alt="Movie: Only God Forgives"  />
                                    </div>
                                    <div id="information" >
                                    <table >
                                        <tr >
                                            <th >SCREEN</th>
                                            <th >ROW</th>
                                            <th > SEATS</th>
                                        </tr>
                                        <tr >
                                            <td class="bigger">1</td>
                                            <td class="bigger">H</td>
                                            <!-- Lets strip the brackets -->
                                            <td class="bigger"><input  type='hidden' readonly name='seats' class=' border-0' value="" style='background-color:transparent;'><span id='seats'></span></input></td> 
                                        </tr>
                                    </table>
                                    <table >
                                        <tr >
                                            <th >PRICE</th>
                                            <th >DATE</th>                                            
                                        </tr>
                                        <tr  class="d-flex justify-content-between">
                                            <td >$<input type='hidden' readonly name='price' value=""><span id='price'></span></input></td>
                                            <!-- Date format should like : 1/13/17 -->
                                            <td ><input readonly name='date' class='border-0 ' style="width: 180px"  value="<?php echo $_SESSION['booking_movie']['date']; ?>" ></td>                                            
                                        </tr>
                                        <tr>
                                            <th >TIMESLOT</th>
                                        </tr>
                                        <tr>
                                            <td><input readonly name='timeslot' class='border-0 ' style="text-align:left;width:275px" value="<?php echo $_SESSION['booking_movie']['timeslot'] ?>" ></td>
                                        </tr>
                                    </table>
                                    </div>
                                    
                                </div>
                                 <!-- ! Ticket end -->

                                <!-- Lets send our values via hidden inputs  -->                                                           
                                <input type="hidden" name="id" value="<?php echo $_SESSION['booking_movie']['id']?>" >

                                <!-- Confirm btn -->
                                <div class='form-group d-flex justify-content-center'>                                  
                                   <input id='confirm' value='Confirm' class='btn btn-white text-center' type='submit' name='submit'></input>
                                </div>                         

                            </form>    
                        </div> 
                    </div> 
                </div> 
                <div class='modal-footer ' >                    
                    <button type='button' class='btn btn-default' data-dismiss='modal' style='color:purple;border: 1px solid purple;background-color: goldenrod;'>X</button>
                </div>
        </div>

    </div>
</div> 
    

    





