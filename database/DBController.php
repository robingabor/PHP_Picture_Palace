<?php
   
    class DBController{
        // Database connection properties
        protected $server = "localhost";
        protected $user = "root";
        protected $password = "";
        protected $database = "cinema2";
        protected $port = 3306;
        // Connection property
        public $con = null;

        public function __construct()
        {
            $this->con = mysqli_connect($this->server,$this->user,$this->password,$this->database,$this->port);
            $this->con->set_charset("utf8");
            // lets check for errors
            if($this->con->connect_error){
                die("Error connecting the db : ". $this->con->connect_error);
            }
        }

        // Close MySQL Connection
        // destructor is automatically called when the object is not in use
        public function __destruct()
        {
            $this->closeConnection();
        }

        //For mysqli closing connection
        protected function closeConnection(){
            if($this->con != null){
                $this->con->close();
                $this->con = null;
            }
        }
        
    }
?>