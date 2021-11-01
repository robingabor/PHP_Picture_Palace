<?php

require('db_connect.php');

$Conn;
ConnectDB($Conn); // csatlakozás

$output ="";



if(isset($_POST['action'])){

    $query = "SELECT * FROM movies WHERE id>22 ";

    if(isset($_POST['running_time']) ){
        
        
        // if min and max are all set, and not empty, then we going to concat to the query a new condition part
        $query .= " AND running_time  <= '".$_POST['running_time']."' ";

    }
    if(isset($_POST['genre'])){

        $imploded = implode("','",$_POST['genre']);
        
        $query .=" AND genre IN('".$imploded."') ";

    }
    if(isset($_POST['language'])){

        $imploded = implode("','",$_POST['language']);
                
        $query .=" AND language IN('".$imploded."') ";

    }

    echo $query;

    // // make query and get results
    $result = mysqli_query($Conn,$query);
    $movies = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $affected_rows = mysqli_affected_rows($Conn);
    
    if($affected_rows > 0){
        foreach($movies as $row){
            // we want to append html code to our output variable
            $output .= "     
                        <div class='card-group col-sm-12 col-md-6 col-lg-3'>
                            <div class='flip-card'>
                            <div class='flip-card-inner'>
                            <div class='flip-card-front'>
                                <img class='img-fluid card-img-top' src='web/".$row['poster']."' alt='Card image cap'>
                            </div>
                            <div class='flip-card-back'>
                                <h1>John Doe</h1>
                                <p>Architect & Engineer</p>
                                <p>We love that guy</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        ";     
                            
                        //     <div class="card border-success mb-3" style="max-width: 18rem;">
                        //     <div class="card-header bg-transparent border-success">Header</div>
                        //     <div class="card-body text-success style="background-image:url(local/'.$row['poster'].');"  ">
                            
                        //     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
                        //     </div>
                        //     <div class="card-footer bg-transparent border-success">Footer</div>
                        // </div>
                        
        }
    }else{
        $output = '<h3>No data found</h3>';
    }

    // we going to echo a
    if(isset($output)){
        echo $output;
    }
    

    // // free result from memory
    // mysqli_free_result($result);

    // CloseDB($Conn); // kapcoslat bontása
    }

?>