<?php

// Create a user validator class to handle validation          DONE
// constructor wich takes from POST data from form           
// check required "fiels to check" are present in our date
// create methods to validate individual fields
// -- a method to validate title
// -- a method to validate email
// return an error array once all checks are 

class UserValidator{

    private $data;          // this property going to hold our data from POST
    private $errors = [];   // our errors initially an emty array
    private static $fields = ['username', 'email','psw','psw2'];
    // NOTE TO MYSELF : static properties can be reached with the self keyword and  with ::

    public function __construct($post_data){
        $this->data = $post_data;
    }

    public function validateForm(){
        // we have to check whether the needed fields are present in the $_POST array
        foreach(self::$fields as $field){
            if(!array_key_exists($field,$this->data)){
                trigger_error("$field is not present in data");
                return;
            }
        }
        // if they are exist we want to call our validator methods
        $this->validateUsername();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;

    }

    // ERROR HANDLER
    private function addError($key,$value){
        $this->errors[$key] = $value;
    }

    // USER VALIDATOR
    private function validateUsername(){
        // first we want to trim the white space
        $val = trim($this->data['username']);
        //lets check if it is empty or not
        if(empty($val)){
            $this->addError('username','username cannot be empty');
        }else{
            // we going to perform some regex
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/',$val)){
                $this->addError('username', 'username must be 6-12 chars & alphanumerical');
            }
        }
    }

    // EMAIL VALIDATOR
    private function validateEmail(){
        $val = trim($this->data['email']);

        if(empty($val)){
            $this->addError('email','email cannot be empty');
        }else{
            // we going to use a built in filter
            if(!filter_var($val,FILTER_VALIDATE_EMAIL)){
                $this->addError('email','email must be valid email');
            }
        }
    }

    // PSW validator
    private function validatePassword(){
        $psw = trim($this->data['psw']); 
        $psw2 = trim($this->data['psw2']); 

        if(empty($psw) || empty($psw2)){
            $this->addError('psw','password cannot be empty');
        }else{
            // we have to check if the 2 psw are the same
            if(strcmp($psw,$psw2)!=0){
                $this->addError('psw','passwords are not match');
            }
        }
    }


}



?>