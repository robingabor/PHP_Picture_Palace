<?php

// session_start();

require('webpage.php');
require('functions.php');
require('input_validator.php');

// Connecting to our db
$Conn= $db->con;

    
    //check if the form was submitted
    if(isset($_POST['submit']) && isset($_FILES['poster'])){
        // lets validate the entries
        // lets create a new instacne of UserVAlidator
        
        $validation = new InputValidator($_POST,$_FILES);
        $errors= $validation->errors;
        // átveszzük a form-unk által átvett adatokat
        $title = $validation->test_input($_POST['title']);
        $description = $validation->test_input($_POST['description']);
        $release_date = $validation->test_input($_POST['release_date']);
        $language = $validation->test_input($_POST['language']);
        $running_time = $_POST['running_time'];
        $genre = $validation->test_input($_POST['genre']);
        $poster =$validation->test_file('web/',$_FILES['poster']);
        
        // we have to check if there was any errors, if there is no error, then the form is valid
        //  The array_filter() function filters the values of an array using a callback function.
        // then we redirect the user to the homepage
        if (!array_filter($errors)){
            //if there arae no errors we would like to save data to our db
            echo "NO errors yet";
             // protecting against SQL injection protect our db from harmful code  
            // we going to clear our variables with  real_escape_string
            $title = mysqli_real_escape_string($Conn,$_POST['title']);
            $description = mysqli_real_escape_string($Conn,$_POST['description']);
            $release_date = mysqli_real_escape_string($Conn,$_POST['release_date']);
            $language = mysqli_real_escape_string($Conn,$_POST['language']);
            $running_time = mysqli_real_escape_string($Conn,$_POST['running_time']);
            $genre = mysqli_real_escape_string($Conn,$_POST['genre']);
            $poster =mysqli_real_escape_string($Conn,$poster);

            print_r($poster);

            

            // 1) Write query to save the inputs
            $sql = "INSERT INTO movies(title,description, release_date,language,running_time,genre,poster)
                    VALUES('$title','$description', '$release_date', '$language','$running_time','$genre','$poster')";    
            // 2) Save to db and check
            if(mysqli_query($Conn,$sql)):
                // lets redirect with the header build in method
                //header('Location: index.php');
                echo "Sikeres felöltés";
            else: echo"Query error" . mysqli_error($Conn);    
            endif;
        }else{
            for($i=0;$i<count($errors);$i++){
                echo $errors[$i];
            }
        }

        

        

    }

    
# Lets initalize our Webpage
$add = new Webpage();


//  lets crate a form to a new movie
$add->content ="<h2 class='center my-3 text-white'>+ Add a Movie</h2>";

$add->content .="<section class='container section rounded-lg shadow-lg text-info ' style='background-color:rgba(0,0,0,0.7);' >";

#we set the content to display
// $add->content .= "<h2 class='text-info'>Welcome to PHP Picture Palace</h2>";

        

        //  We want the add.phph file to handle this request
        //  We going to use PHP_SELF in the action attribute
       //in pur form we need to add enctype="multipart/form-data" attribute
        $add->content .= "<form action=". $_SERVER['PHP_SELF']." method='POST' enctype='multipart/form-data' class=' light-green accent-1'>";
        
        $add->content .="<label>The Title of the Movie</label>";
        $add->content .="<input type='text' name='title' class='form-control'   >";
        $add->content .="<div class='red-text'></div>";

        $add->content .="<label>Description:</label>";
        $add->content .="<input type='text' name='description' class='form-control'>";
        $add->content .="<div class='red-text'></div>";

        $add->content .="<label> Release date of the moovie:</label>";
        $add->content .="<input type='date' name='release_date' class='form-control' >";
        $add->content .="<div class='red-text'></div>";

        $add->content .="<label>Language</label>";
        $add->content .="<input type='text' name='language' class='form-control' >";
        $add->content .="<div class='red-text'></div>";

        $add->content .="<label>Running Time</label>";
        $add->content .="<input type='number' name='running_time' required min='30' max='360' class='form-control'>";
        $add->content .="<div class='red-text'></div>";

        $add->content .="<label>Genre</label>";
        $add->content .="<input type='text' name='genre' class='form-control' >";
        $add->content .="<div class='red-text'></div>";

        $add->content .="<label>Upload Poster Image</label>";
        $add->content .="<input type='file' name='poster[]' required value='' multiple='' class='form-control' >";
        $add->content .="<div class='red-text'></div>";
        
        $add->content .="<div class='center'>";
        $add->content .="<button type='submit' name='submit' class='btn btn-info waves-effect waves-light btn-large brand z-depth-3'>Add New Movie</button>";
        $add->content .="</div>";
        
            $add->content .="</form>";

        $add->content .= "</section>";

$add->Display();

?>