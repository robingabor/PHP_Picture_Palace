<?php 

// This is how we should retrive our value if we were sent it like basic text and not a form

// $data = file_get_contents("php://input");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // print_r($_POST);
    $text = '%'. $_POST['text'].'%';

    $string =  "mysql:host=localhost;dbname=cinema2;port=3307";

    try{

        $con = new PDO($string,'root','');
        // set the PDO error mode to exception
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);        

    }catch(PDOException $err){        

        die($err->getMessage());
    }
    
    // read from DB
    // we should sanitize with  the data with addslashes() OR use prepared statement

    $stm = $con->prepare("SELECT * FROM movies where title LIKE :text  ");

    $stm->execute(["text"=>$text]);

     $result = $stm->fetchAll();

    // sending data -> json encloding   and when recieveing-> json decoding

    // Sending result back : everythig we echo here will be returned as a result
    echo json_encode($result);
}



?>