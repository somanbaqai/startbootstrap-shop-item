<?php
include("dbhelper.php");

$_SQL_BAYANS    = "select p.id as id, p.post_title as title, p.post_content as file_description, 1 as dlversion, p.post_date as postdate 
                    ,REPLACE(REPLACE(REPLACE(m.meta_value,'[', ''),']',''),'\"','') filename , m.meta_key
                    from majliseirshad_org.wp_vibh0o_posts p 
                    INNER JOIN majliseirshad_org.wp_vibh0o_posts v on p.id = v.post_parent
                    INNER JOIN majliseirshad_org.wp_vibh0o_postmeta m ON m.post_id = v.id
                    where p.post_type = 'dlm_download' 
                    and p.post_status != 'auto-draft' 
                    and m.meta_key like '%files'
                    order by p.ID desc
                    limit ?,?;";



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
    //$stmt->bind_param("sii",$taxId,$from,$to);
    $stmt->bind_param("ii",$from,$to);
    
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