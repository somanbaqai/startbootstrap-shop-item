<?php
class DatabaseHelper{

    private  $_connection;
    private static $_instance; //The single instance
    private $_DB_CONNECTION = "dbConnection";
    private $_DB_USER       = "userName";
    private $_DB_PASSWORD   = "dbPassword";


    // Constructor
	private function __construct() {
        $this->connectDB();
        //  $cfgElements = parse_ini_file("../secrets/config.ini");
        // if(! is_array($cfgElements)){
        //     throw new Exception("Configuration file not found");
        // }
        // // Make a  db connection here
		// $this->_connection = new mysqli($cfgElements["dbConnection"], 
        //             $cfgElements["userName"], 
        //             $cfgElements["dbPassword"]);	
		// // Error handling
		// if ($_connection->connect_error) {
        //     die("Connection failed: " . $_connection->connect_error);
        // } 
    }

    /*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
    
    public function connectDB(){
        $cfgElements = parse_ini_file("../secrets/config.ini");
        if(! is_array($cfgElements)){
            throw new Exception("Configuration file not found");
        }
        // Make a  db connection here
        $cfgElements["dbConnection"];
		$this->_connection = new mysqli($cfgElements["dbConnection"], 
                    $cfgElements["userName"], 
                    $cfgElements["dbPassword"]);	
		// Error handling
		if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->$_connection->connect_error);
        } 
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}

}
?>