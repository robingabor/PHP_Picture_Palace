<?php
    //lets connect to our database
    function ConnectDB(&$conn){
        $server = "localhost";
        $username = "root";
        $password ="";
        $dbname = "picturepalace";
        $port =3307;

        $conn = new mysqli($server,$username,$password,$dbname,$port);

        if($conn->connect_error){
            die("Error connecting the db : ". $conn->connect_error);
        }
        //set the charset
        $conn->set_charset("utf8");
    }

    // Close db
    function CloseDB(&$conn){
        $conn->close();
    }
?>