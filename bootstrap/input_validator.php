<?php

// Create a input validator class to handle validation          DONE
// constructor wich takes from POST data from form           
// check required "fiels to check" are present in our date
// create methods to validate individual fields
// -- a method to validate title
// -- a method to validate email
// return an error array once all checks are 

class InputValidator{
    public $data;           // this property going to hold our data from POST
    public $files;
    public $errors = [];    // this is for our error initially an emty array
    

    // we need a constructor
    public function __construct($post_data,$files_data){
        $this->data =$post_data;
        $this->files = $files_data;
    }
    // adding error if needed
    private function addError($key, $val){
        $this->errors[$key] = $val;
    }

    //validálás
    function test_input($input){
        if(empty($input)){
            $this->addError($input,"A(n) $input is required");
        }
        //whitespace karakterek eltávolítása
        $input = trim($input);
        $input = stripslashes($input); // removes backslashes
        $input = htmlspecialchars($input);

        return $input;
    } 

    //file validation and move
    function test_file($input){
        if(empty($input)){
            $this->addError($input,"A(n) $input is required");
        }else{
            print_r($input['name'][0]);
             // we going to create an extension array with the extensions we allow to uploas
             $extensions = array('pdf','exe','jpg','png','gif','jpeg');
             // lets extract the extensions from our files with the use of the explode()
             $file_ext= explode('.',$input['name'][0]);
             print_r($file_ext);                

             // the end() function returns the last element of an array
             $file_ext = end($file_ext);
             // now we have to check if the $file_ext in our array       

             
             
             if(!in_array($file_ext, $extensions)){
                 ?>    <div class='alert alert-danger'>
                 <?php echo "{$input['name'][0]} - Invalid file extension";
                 ?>    </div>    <?php
             }else{
                 // we going to move our uploaded files to a new location from our tmp
                 move_uploaded_file($input['tmp_name'][0], "web/".$input['name'][0]);
                 echo "<div class='alert alert-success'>";
                 echo $input['name'][0];
                 echo "</div>";
                 return $input['name'][0];
             }
        }
        
               
        
    }

          


}

?>