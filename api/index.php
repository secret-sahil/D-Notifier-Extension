<?php include"db.php"; 
    $r=array();
    header("Access-Control-Allow-Origin:*");
    header('Content-Type:application/json');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 1000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type,Access-Control-Allow-Headers,Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
    
    $query= $db->query('SELECT * FROM api_data WHERE id=(SELECT max(id) FROM api_data)');
    $data = $query->fetch();
    $r['image']=$data[1];
    $r['content']=$data[2];
    echo json_encode($r);
?>