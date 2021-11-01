<?php
session_start();

print_r($_SESSION['user']);

require('webpage.php');

require('db_connect.php');
    
$Conn;
ConnectDB($Conn); // csatlakozás

// check if delete form was submitted
if(isset($_POST['delete'])){
    // first we have to escape any sensitive sql charachter to protect our db
    $id_to_delete = mysqli_real_escape_string($Conn,$_POST['id']);

    // now lets make a sql to delete 1 field only
    $sql2 = "DELETE FROM movies
            WHERE id = $id_to_delete";
    
    if(mysqli_query($Conn,$sql2)){
        // in case of succes lets change the location
        header('Location: index2.php');
    }else{
        //failure
        echo 'Query Error : ' . mysqli_error($Conn);
    }
}

// if we pass down (via URL) info with a query string that will be in the $-GEt superglobal assoc array
// let check if isset
if(isset($_GET['id'])){
    // first we have to escape any sensitive sql charachter to protect our db
    $id = mysqli_real_escape_string($Conn,$_GET['id']);

    // now lets make a sql to select 1 field only
    $sql = "SELECT * FROM movies
            WHERE id=$id";
    //get the query result        
    $result = mysqli_query($Conn,$sql);

    // fetch result into an assoc array
    // mysqli_fetch_assoc fetches only 1 result
    $movie = mysqli_fetch_assoc($result);

    //now lets free the results
    mysqli_free_result($result);

    //close the connecti
    mysqli_close($Conn);
}

if(isset($_POST['book']) ){
    // később ezt SESSION tárolhatná...    
        $id = $_POST['id'];
        $title = $_POST['title'];
        $running_time= $_POST['running_time'];

        $_SESSION['booking_movie'] = array
        (
            'id' => filter_input(INPUT_POST,'id'),
            'title' => filter_input(INPUT_POST,'title'),
            'running_time' => filter_input(INPUT_POST,'running_time'),
        );
        // if the uer is logged in then she/he will be able to proceed the booking
        if($_SESSION['user']){
            header("Location: booking.php?id=$id&running_time=$running_time ");
        }else{
            // if the use is not logged in we send him to the login page
            header("Location: login.php");
        }
           
    
}

$details = new Webpage();



$details->content ="<div class='container-fluid' style='background-color:#aa66cc;'>";

$details->content .= "<center><h1 class='p-2' style='color:#0d47a1;filter: hue-rotate(0deg)'>Movie Details</h1></center>";
//we have to check if the movie exist
if($movie){
    //$details->content .="<img src='web/".$movie['poster']."' class='w-25' >";
   
    $details->content .="<table class='table w-75 column justify-content-around'>";
        $details->content .="<tr>";
            $details->content .="<td rowspan='6' class='slide-img'><img src='web/".$movie['poster']."' class='w-50 mx-auto d-block' ></td>";
            $details->content .="<td class='font-weight-bold text-uppercase' style='color:#ffbb33;'>Title: </td>";
            $details->content .="<td><h3 style='color:#0d47a1;'>".htmlspecialchars($movie['title'])."</h4></td>";
        $details->content .="</tr>";
        $details->content .="<tr>";
            
            $details->content .="<td class='font-weight-bold text-uppercase' style='color:#ffbb33;'>Release Date: </td>";    
            $details->content .="<td><h4 style='color:#0d47a1;'>".htmlspecialchars($movie['release_date'])."</h5></td>";
        $details->content .="</tr>";
        $details->content .="<tr>";
            
            $details->content .="<td class='font-weight-bold text-uppercase' style='color:#ffbb33;'>Description</td>"; 
            $details->content .="<td><h6 style='color:#0d47a1;'>".htmlspecialchars($movie['description'])."</h6></td>";
        $details->content .="</tr>";
        $details->content .="<tr>";
            
            $details->content .="<td class='font-weight-bold text-uppercase' style='color:#ffbb33;'>Language </td>"; 
            $details->content .="<td><h6 style='color:#0d47a1;'>".htmlspecialchars($movie['language'])."</h6></td>";
        $details->content .="</tr>";
        $details->content .="<tr>";
            
            $details->content .="<td class='font-weight-bold text-uppercase' style='color:#ffbb33;'>Running Time(MIN) : </td>";
            $details->content .="<td><h6 style='color:#0d47a1;'>".htmlspecialchars($movie['running_time'])."</h6></td>";
        $details->content .="</tr>";
        $details->content .="<tr>";
             
            $details->content .="<td class='font-weight-bold text-uppercase' style='color:#ffbb33;'>Genre:  </td>";
            $details->content .="<td><h6 style='color:#0d47a1;'>".htmlspecialchars($movie['genre'])."</h6></td>";
        $details->content .="</tr>";
    $details->content .="</table>";

   # ezt majd úgy hogy ha admin akkor törölni tudja ha vendég akkor bookolni
    $details->content .="<form action='details.php' method='POST'>";
    $details->content .="<input type='hidden' name='title' value='".$movie['title']."'>";
    $details->content .="<input type='hidden' name='id' value='".$movie['id']."'>";
    $details->content .="<input type='hidden' name='running_time' value='".$movie['running_time']."'>";
    //   we have to check if the user is logged in or not
    if($_SESSION['user']){
        $details->content .="<input type='submit' name='book' value='Book Movie' class='btn btn-warning mx-auto d-block'>";
    }else{
        $details->content .="<input type='submit' name='book' value='Book Movie' onclick='myFunction()' class='btn btn-warning mx-auto d-block'>";
        $details->content .="<p class='font-weight-bold text-danger'>You Are Not logged in yet</p>";
        $details->content .="<p class='font-weight-bold text-danger'>Please <a href='login.php' style='color:#0d47a1;'>log in</a> in order to process your booking</p>";
    }
    
    $details->content .="<input type='submit' name='delete' value='Delete Movie' class='btn btn-danger mx-auto d-block'>";
    $details->content .="</form>";

}else{
    
    $details->content .= "There is no such movie";
}
$details->content .="</div>";





$details->Display();

?>

<script>
    function myFunction(){
        alert('Please log in in order to be able to process your booking');
        // window.location.href = "login.php";
    }
</script>