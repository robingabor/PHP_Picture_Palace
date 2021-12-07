<?php

class Bookings{
    // property to the db
    public $db = null;
    // We want to store the already booked dates and times in here
    public static $alreadyBooked = array();


    // Dependency Injenction
    public function __construct(DBController $db)
    {
        if(!isset($db->con)) return null;
        $this->db = $db;
    }

    // function to divide the time into timeslots , between the start and end date
    // depending on the duration of the given movie
    function timeslots($duration,$cleanup,$start,$end){
        $start = new DateTime($start);
        $end = new DateTime($end);
        // Duration of the film
        $durationInterval = new DateInterval("PT".$duration."M"); //Stands for : Period Time x Minutes
        // Duration of the cleanup between the films
        $cleanupInterval = new DateInterval("PT".$cleanup."M");   //Stands for : Period Time x Minutes
        $slots = array();
    
        for($intStart = $start;$intStart<$end;$intStart->add($durationInterval)->add($cleanupInterval)){
            $periodEnd = clone $intStart;// in every iteration we clone the actual value of the intStart
            $periodEnd->add($durationInterval);
            if($periodEnd > $end){
                break;
            }
            $slots[] = $intStart->format("H:iA")."-".$periodEnd->format("H:iA"); // "H:iA" format will give us i.e the following: 09:00PM
        }
        return $slots;
    }


    public function insertBooking($bookingDetails = null, $table = 'bookings' ){ 

        if($this->db->con != null){
            if($bookingDetails != null){
                $keys = implode(',',array_keys($bookingDetails));
                $values = array_values($bookingDetails);
                print_r($values);
                                
                // we going to use prepared statement
                $stmt = $this->db->con->prepare("INSERT INTO $table($keys)
                                        VALUES(?,?,?,?,?,?)");
                $stmt->bind_param('ssssss',$values[0],$values[1],$values[2],$values[3],$values[4],$values[5]);
                //execute
                $stmt->execute();
                $stmt->close();     

                // $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s);",$table,$keys,$values);
                                            
                // // query kell, true vagy false-t kaopunk hogy sikerült -e
                // if($this->db->con->query($query_string)){
                //     echo "SUCCESSFULL BOOKING" . "</br>";
                //     // we going to fill an array with the bookings
                //     // $bookings[][$date] =$timeslot; 
                //     // print_r($bookings);
                //     require('mail_sender.php');
                //     // header('Location: index2.php');

                // query kell, true vagy false-t kaopunk hogy sikerült -e
                if($stmt){
                    echo "SUCCESSFULL BOOKING" . "</br>";
                    
                    header("Location: Template/html_email_template.php");
                    die;

                }else{
                    echo "BOOKING UNSUCCESSFULL" . "</br>";
                    echo $this->db->con->error. "</br>";
                } 
            }
        }   
        
    }

    // A method to check if there is alredy a booked date & time for the specific movie
    function alreadyExist($date = null,$timeslot = null,$movie_id= null){
        //LETS CHECK LATER IF IT IS ALREADY BOOKED OR NOT
        if($date && $timeslot && $movie_id):
            $sql = "SELECT * FROM bookings
                WHERE movie_id='$movie_id' AND date='$date' AND timeslot='$timeslot' ";
        
            $result = $this->db->con->query($sql);

            // check if the result  is greater than 0            
            if($result->num_rows>0):
                
                $seats = array();
                $alreadyBooked = array();

                // fetch result into an assoc array 
                while($row = $result->fetch_assoc()){
                    // Populating the seats array with the seat wich are occupied(already booked)
                    $seats[] = $row['seats'];                                  
                                 
                }
                
                for($i = 0; $i < count($seats); $i++){
                    $alreadyBooked[] = $seats[$i];                       
                    
                }
                print_r($alreadyBooked);
                self::$alreadyBooked = $alreadyBooked;
                return $alreadyBooked;
            endif;
        endif;
        
    }


}

?>