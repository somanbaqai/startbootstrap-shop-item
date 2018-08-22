<?php
include("dbhelper.php");

$_SQL_BAYANS    = "select F.id, F.title, F.filename, F.file_description, F.dlversion, F.postdate from  
	majliseirshad_org.wp_vibh0o_download_monitor_files as F 
WHERE F.Id IN (select download_id from majliseirshad_org.wp_vibh0o_download_monitor_relationships where taxonomy_id = ?)
order by postDate desc LIMIT ?,?;";

$db = DatabaseHelper::getInstance();
$conn = $db->getConnection(); 


/** Fetching records from DB */
$stmt = $conn->prepare($_SQL_BAYANS);
$param1 = 1; // category
$param2 = 1; // from
$param3 = 50; // to
$stmt->bind_param("sss",$param1,$param2,$param3);
// $result = $conn->query($_SQL_BAYANS);
$stmt->execute();
$result = $stmt->get_result();
header('Content-Type: application/json');
if ($result->num_rows > 0) {
    $rows = array();

    while($r = $result->fetch_assoc()){        
        $rows['result'][] = $r;
    }
    
    // echo "id: " . $row["id"]. " - Title: " . $row["title"]. " " . $row["filename"]. "<br>";
    //     while($row = $result->fetch_assoc()) {
    // }
    
    print_r(json_encode($rows));
    $stmt->close();
}else{    
    http_response_code(404);
}

?>