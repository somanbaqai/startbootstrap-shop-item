<?php
include("dbhelper.php");

$_SQL_BAYANS    = "SELECT 
                        F.id, F.title, F.filename, F.file_description, F.dlversion, F.postdate
                    FROM  
	                    majliseirshad_org.wp_vibh0o_download_monitor_files 
                    as F WHERE 
                        F.Id IN (SELECT
                                         download_id 
                                 FROM 
                                        majliseirshad_org.wp_vibh0o_download_monitor_relationships 
                                WHERE taxonomy_id LIKE ?)
                    ORDER BY  postDate desc LIMIT ?,?;";



if(is_null($_GET['from']) || is_null($_GET['to'])) {    
    throw new Exception("Required variable not found");
}
    /** Fetching records from DB */

    $db = DatabaseHelper::getInstance();
    $conn = $db->getConnection(); 
    
    $stmt = $conn->prepare($_SQL_BAYANS);
    $taxId = (is_null($_GET['taxId']))? '%': $_GET['taxId'];// category
    $from = $_GET['from']; // from
    $to = $_GET['to']; // to
    $stmt->bind_param("sii",$taxId,$from,$to);
    // $result = $conn->query($_SQL_BAYANS);
    $stmt->execute();
    $result = $stmt->get_result();
    header('Content-Type: application/json');
    if ($result->num_rows > 0) {
        $rows = array();
    
        while($r = $result->fetch_assoc()){        
            $rows['result'][] = $r;
        }           
        
        print_r(json_encode($rows));
        $stmt->close();
    }else{    
        http_response_code(404);
    }
    







?>