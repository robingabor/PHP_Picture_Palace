<?php
//THis going to be our template page

class Webpage{
    #PROPERTIES
    // our content property wich going to change frpm page to page
    public $content;
    public $title = "PHP Picture Palace";
    public $keywords = array("cinema","movie","booking","premier","popcorn","nachos");
    public $navbar = array("Homepage" => "index2.php",
                            "Contact Us" =>"contact.php",
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
            echo "<div id='frame'>";
                $this->DisplayHeader();
                $this->DisplayNavbar();
                // here comes the content
                    echo "<div id='content' class='m-5'>";
                    echo $this->content;
                    echo "</div>";                
                $this->DisplayFooter();    
            echo "</div>";
        echo "</body>";  

        echo "</html>";
    }
    
    public function DisplayTitle(){
        echo "<title class='text-warning'>$this->title</title>";
    }

    public function DisplayDesign(){
        //here comes the style html elements an scripts
        echo "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>";
        // echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
        // echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>";
        echo "<link href='style.css' rel='stylesheet' type='text/css'/>";
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
        echo "<div id='header' class='container-fluid'>";
            echo "<div class='row justify-content-around'>";

                // Here comes the title
                echo "<div id='header-title' class='col'>";
                    echo "<h1 class='text-warning'>$this->title</h1>";
                echo "</div>";
                
                //Login 
                echo "<form action='login.php' method='POST'>";
                    echo "<div class='row'>";
                        echo "<div class='col'><input type='text' name='name' placeholder='Name' class='form-control' /></div>";
                        echo "<div class='col'><input type='password' name='password' placeholder='Password' class='form-control' /></div>";
                        echo "<button class='btn btn-primary' type='submit'><i class='fas fa-sign-in-alt'></i></button>";
                    echo "</div>";
                echo "</form>";

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
        echo "<nav id='menu' class='navbar navbar-dark bg-muted container-fluid '>";
            echo "<ul class='nav row justify-content-around'>";
                foreach($this->navbar as $key=>$value){
                    echo "<li class='navbar-nav mr-auto '>";
                        if($this->isCurrentUrl($value)){
                           // we need to disable the current url
                           echo "<span class='navbar-brand disabled col font-weight-bold'>$key<span>"; 
                        }else{
                            echo "<a href='$value' class='navbar-brand col font-weight-bold'>$key</a>";
                        }
                    echo "</li>";                                      
                }
                // Kereső mező 
                echo "<li class='navbar-nav mr-auto>";
                    echo  "<div class=''>";
                        echo  "<form action='search.php' id='search_form' >";
                            echo "<label for='myRange'></label>";
                            echo "<input type='text' placeholder='Search..' name='search' id='search'>";
                            echo "<button type='submit' name='submit_search'><i class='fa fa-search'></i></button>";
                        echo  "</form>";
                    echo "</div>";
                echo "</li>";
            echo "</ul>";
        echo "</nav>";
    }

    public function DisplayFooter(){
        echo "<div id='footer'>";
            echo "The page made by Robin Gábor";
            echo "<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>";
            echo "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>";
            echo "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>";
        echo "</div>";

    }
}


?>
