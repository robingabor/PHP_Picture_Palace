<?php
//THis going to be our template page

class Webpage{
    #PROPERTIES
    // our content property wich going to change frpm page to page
    public $content;
    public $title = "PHP Picture Palace";
    public $keywords = array("cinema","movie","booking","premier","popcorn","nachos");
    public $navbar = array("Homepage" => "index2.php",
                            "Login" =>"login.php",
                            "Registration"=>"registration.php",
                            "All Movie"=>"index.php",
                            "Add a Movie" =>"add.php");// ezt majd csak az admin láthatja
        
    # METHODS
    //setter
    function __set($name,$value){
        $this->$name = $value;
    }

    // this is our overall dipslay function
    public function Display(){
        echo "<!DOCTYPE html>";
        echo "<html>";

        echo "<head>";
            $this->DisplayTitle();
            $this->DisplayDesign();
            $this->DisplaySEO();
        echo "</head>";

        echo "<body>";
            echo "<div id='frame class='d-flex justify-content-center text-center'>"; // id=frame volt
                $this->DisplayHeader();
                $this->DisplayNavbar();
                // here comes the content
                    echo "<div  id='content' class=' text-center'>";//m-x-5  text-center
                    echo $this->content;
                    echo "</div>";                
                $this->DisplayFooter();    
            echo "</div>";
        echo "</body>";  

        echo "</html>";
    }
    
    public function DisplayTitle(){
        echo "<title class='py-5 text-warning'>$this->title</title>";
    }

    public function DisplayDesign(){
        //here comes the style html elements an scripts    
        
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>";
        // echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
        // echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>";
        echo "<link href='style.css' rel='stylesheet' type='text/css'/>";
        echo "<link href='css/lightslider.css' rel='stylesheet' type='text/css'/>";         
        echo "<script src='https://kit.fontawesome.com/c88e92549b.js' crossorigin='anonymous'></script>";
        
    }

    public function DisplaySEO(){
        echo "<meta name='keywords' content=' ";
            for($i=0;$i<sizeof($this->keywords);$i++){
                echo $this->keywords[$i];
                if($i < (sizeof($this->keywords)-1)){
                    echo ", ";
                }
            }
        echo " ' />";
    }

    public function DisplayHeader(){
        echo "<div id='header' class='container-fluid' style='background-color:rgba(0,0,0,0.7);'>";
            echo "<div class='row justify-content-around'>";

                // Here comes the title
                echo "<div id='header-title' class='col'>";
                    echo "<h1 class='text-warning' >$this->title</h1>";
                echo "</div>";
                
                //Welcome / Sign Out
                // echo "<form action='login.php' method='POST'>";
                //     echo "<div class='row'>";
                //         echo "<div class='col'><input type='text' name='name' placeholder='Name' class='form-control' /></div>";
                //         echo "<div class='col'><input type='password' name='password' placeholder='Password' class='form-control' /></div>";
                //         echo "<button class='btn btn-primary' type='submit'><i class='fas fa-sign-in-alt'></i></button>";
                //     echo "</div>";
                // echo "</form>";

                
                    // echo "<div class='row'>";                                                                     
                                                
                    //     session_start();
                    //     if(isset($_SESSION['user'])){                           
                            
                    //         echo "<div class='col'><h3>Welcome, ".$_SESSION['user']['userName']."<h3></div>";
                    //         echo "<a href='logout.php'><button class='btn btn-primary' type='submit'>Log out <i class='fas fa-sign-in-alt'></i></button></a>";
                            
                    //     }else{
                    //         echo "<a href='login.php'><button class='btn btn-primary' type='submit'>Log in <i class='fas fa-sign-in-alt'></i></button></a>";
                    //     }                      
                       
                    // echo "</div>";
                

            echo "</div>";
        echo "</div>";
    }

    // we need a func wich checks our current URL
    // we have to find our substring in our current URL
    public function isCurrentUrl($url){
        if(strpos($_SERVER['PHP_SELF'],$url)==false){
            return false;
        }else{
            return true;
        }
    }

    public function DisplayNavbar(){
        echo "<nav id='menu' class='navbar sticky-top navbar-expand-lg '>";        

        require('isloggedin.php');

        
            echo "<button class='navbar-toggler navbar-light bg-light' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>";
                echo "<span class='navbar-toggler-icon'></span>";
            echo "</button>";

            echo "<div class='collapse navbar-collapse' id='navbarTogglerDemo02'>";
            echo "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
                foreach($this->navbar as $key=>$value){
                    
                        if($this->isCurrentUrl($value)){
                           // we need to disable the current url
                           echo "<li class='nav-item active'>";
                                echo "<span class='nav-link disabled font-weight-bold'>$key<span>";
                           echo "</li>"; 
                        }else{
                            echo "<li class='nav-item'>";
                                echo "<a href='$value' class='nav-link font-weight-bold'>$key</a>";
                            echo "</li>";
                        }
                                                          
                }                
            echo "</ul>";
            echo "</div>";
        echo "</nav>";
    }

    public function DisplayFooter(){
        echo "<div id='footer'>";
            echo "The page made by Robin Gábor";
            echo "<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>";
            echo "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>";
            echo "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>";
            echo "<script src='js/lightslider.js' ></script>";
            echo "<script src='js/slider.js' ></script>";
        echo "</div>";

    }
}


?>
