<?php

// Create a input validator class to handle validation          DONE
// constructor wich takes data from  POST and FILES as well        
// check required "fiels to check" are present in our date
// create methods to validate individual fields
// -- a method to validate title
// -- a method to validate email
// return an error array once all checks are 

class InputValidator{
    public $data;           // this property going to hold our data from $_POST
    public $files;          // this property going to hold our data from $_FILES
    public $errors = [];    // this is for our error initially an emty array
    

    // we need a constructor
    // I do NOT want always assign a value to the $files_data property lets assign default value 
    public function __construct($post_data ,$files_data = null){
        if(!$files_data){
            $this->data =$post_data;            
        }else{
            $this->data =$post_data;
            $this->files = $files_data;
        }        
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
        
        $input = trim($input);          //renove whitespaces from the beginning and end of a string
        $input = stripslashes($input); // removes backslashes
        $input = htmlspecialchars($input); // Preventing XSS hacks

        return $input;
    }
    
    public function validate_password($password,$confirm_pwd){
        $password = trim($password);
        $confirm_pwd = trim($confirm_pwd);

        if(empty($password) || empty($confirm_pwd) ){
            $this->addError($password,'PASSWORD CANNOT BE EMPTY');
        }else{
            //We have to check if the 2 psw are the same or not
            if(strcmp($password,$confirm_pwd)!==0){
                $this->addError($password,'PASSWORDS ARE NOT MATCH');
            }else{
                return $password;
            }
        }

    }

    //file validation and move
    function test_file($path,$input){
                
        if(empty($input)){
            $this->addError($input,"A(n) $input is required");
        }else{
            echo "<pre>";
            print_r($input);
             // we going to create an extension array with the extensions we allow to upload
             $extensions = array('pdf','jpg','png','gif','jpeg');
             // lets extract the extensions from our files with the use of the explode()
             $file_ext= explode('.',$input['name'][0]);
             print_r($file_ext);                

             // the end() function returns the last element of an array
             $file_ext = end($file_ext);
             // now we have to check if the $file_ext in our array 
             print_r($file_ext);
             
             
             if(!in_array($file_ext, $extensions)){
                 ?>    <div class='alert alert-danger'>
                 <?php echo "{$input['name']} - Invalid file extension";
                 ?>    </div>    <?php
             }else{
                 // we going to move our uploaded files to a new location from our tmp
                 move_uploaded_file($input['tmp_name'][0], $path.$input['name'][0]);
                 echo "<div class='alert alert-success'>";
                 echo $input['name'][0];
                 echo "</div>";
                 return $input['name'][0];
             }
        }
        
               
        
    }

    function uplodeProfile($path,$file){
        // this is where we want to store our profile picture
        $tartgetDir = $path;
        // if the user does not specify any image, then we have to use a default value
        $default = "icons8-login-as-user-48.png";
    
        // get the filename : with the basename() method
        $filename = basename($file['name']);
        // target file path = dir name + file name
        $targetFilePath = $tartgetDir.$filename;
        // pathinfo can provide us the folder, the filename and the extension.We need the extension of the file 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    
        if(!empty($filename)){
            // lets restrict the file formats we accept
            $allowType = array('jpg','png','jpeg', 'gif','pdf');
            if(in_array($fileType,$allowType)){
                // if the file extension is OK we going to move our uploaded files to a new location from our tmp
                if(move_uploaded_file($file['tmp_name'],$targetFilePath)){
                    return $targetFilePath;
                }
            }
        }
        // return default image
        return $tartgetDir.$default;
    }

          


}

?>