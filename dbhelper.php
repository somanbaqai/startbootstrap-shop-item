<?php
class DatabaseHelper{

    private  $_connection;
    private static $_instance; //The single instance
    private $_DB_CONNECTION = "dbConnection";
    private $_DB_USER       = "userName";
    private $_DB_PASSWORD   = "dbPassword";
    private $_SQL_BAYANS    = "select F.id, F.title, F.filename, F.file_description, F.dlversion, F.postdate from  
        majliseirshad_org.wp_vibh0o_download_monitor_files as F 
    WHERE F.Id IN (select download_id from majliseirshad_org.wp_vibh0o_download_monitor_relationships where taxonomy_id = 1001)
    order by postDate desc LIMIT 1,50;";

    // Constructor
	private function __construct() {
        this->connectDB();
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
		$this->_connection = new new mysqli($cfgElements[$_DB_CONNECTION], 
                    $cfgElements[$_DB_USER], 
                    $cfgElements[$_DB_PASSWORD]);	
		// Error handling
		if ($_connection->connect_error) {
            die("Connection failed: " . $_connection->connect_error);
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