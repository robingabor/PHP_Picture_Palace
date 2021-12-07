<?php

class Session{

    public function __construct()
    {
        if(!isset($_SESSION)) $this->init_session();
    }

    public function get_session_data( $session_name ){
        return $_SESSION[$session_name];
    }
    
    public function set_session_data( $session_name , $data ){
        $_SESSION[$session_name] = $data;
    }


    public function init_session(){
        session_start();
    }

    public function parameterExist($session_name){
        return isset($_SESSION[$session_name]);
    }

    // public function setParameter($session_name , $is_array = false ){
    //     if( !$this->parameterExist($session_name)){
    //         if( $is_array == true ){
    //             $_SESSION[$session_name] = array();
    //         }
    //         else{
    //             $_SESSION[$session_name] = '';
    //         }
    //     }
    // }

    public function setParameter($session_name,$key,$value){
        if($this->parameterExist($session_name)){
            $_SESSION[$session_name][$key] = $value;
        }
    }

    public function insert_value($session_name,array $data){
        
        $_SESSION[$session_name] = $data;
    }
    
    public function display_session( $session_name ){
        echo '<pre>';print_r($_SESSION[$session_name]);echo '</pre>';
    }
    
    public function remove_session( $session_name = '' ){
        if( !empty($session_name) ){
            unset( $_SESSION[$session_name] );
        }
        else{
            unset($_SESSION);
            //session_unset();
            //session_destroy();
        }
    }  
    

}

?>
