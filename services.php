<?php
/*
// Show all information, defaults to INFO_ALL
phpinfo();
// Show just the module information.
// phpinfo(8) yields identical results.
phpinfo(INFO_MODULES);
*/

/* Step#1: Load configuration file */
$cfgElements = parse_ini_file("../secrets/config.ini");
if(! is_array($cfgElements)){
    throw new Exception("Configuration file not found");
}
/* END */
$_DB_CONNECTION = "dbConnection";
$_DB_USER       = "userName";
$_DB_PASSWORD   = "dbPassword";
$_SQL_BAYANS    = "select F.id, F.title, F.filename, F.file_description, F.dlversion, F.postdate from  
	majliseirshad_org.wp_vibh0o_download_monitor_files as F 
WHERE F.Id IN (select download_id from majliseirshad_org.wp_vibh0o_download_monitor_relationships where taxonomy_id = 1001)
order by postDate desc LIMIT 1,50;";
static $conn     = NULL;
// Create connection
if(is_null($conn)){    
    $conn = new mysqli($cfgElements[$_DB_CONNECTION], 
                    $cfgElements[$_DB_USER], 
                    $cfgElements[$_DB_PASSWORD]);
    // $GLOBAL['DBCON'] = $conn;
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// echo "Connected successfully";

/*
$init_array = parse_ini_file("config.ini");
print_r($init_array['userName']);
*/

/** Fetching records from DB */
$result = $conn->query($_SQL_BAYANS);
header('Content-Type: application/json');
if ($result->num_rows > 0) {
    $rows = array();

    while($r = $result->fetch_assoc()){
        $rows['result'][] = $r;
    }
    
    // echo "id: " . $row["id"]. " - Title: " . $row["title"]. " " . $row["filename"]. "<br>";
    //     while($row = $result->fetch_assoc()) {
    // }
    
    print_r("From if statement:" + json_encode($rows));
}else{    
    http_response_code(404);
}

?>