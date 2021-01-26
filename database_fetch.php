<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, HEAD, OPTIONS");
header("Access-Control-Allow-Headers: *");
// Server name ... 
$servername = "ec2-52-6-75-198.compute-1.amazonaws.com"; 
  
//user name will ....
$username = "maoeizzpabkiws"; 
  
// Password is .....
$password = "5821762c1520d9fd66618ba143a7e510928a43bca83c4f3ef9b95cd13ba75415"; 

$database = "dd81qjvfuts0di";


foreach($_POST as $p){
    $name=$p;
}

$conn = pg_connect("host=".($servername)." port=5432 dbname=".($database)." user=".($username)." password=".($password)." connect_timeout=5");


/*$sql = $conn->prepare("SELECT Sl_no,Full_name from employees where Full_name = ?");
$sql->bind_param('s',$name);
$sql->execute();
$result = $sql->get_result();*/

$sql =<<<EOF SELECT Sl_no,Full_name from employees where Full_name =.$name;EOF;
$result = pg_query($conn, $sql);


/*if ($result->field_count > 0){
    while($row = $result->fetch_assoc()){
        echo ($name).", you are already registered, you're ".($row['Sl_no'])."th on the line";
    }
}
else{
    echo "sorry, you are not registered";
}*/

if(pg_num_fields($result)>0){
  while($row = pg_fetch_array($result)) {
    echo ($name).", you're already registered, you're ".$row['Sl_no']."th in the line";                         
  }
}
else{
    echo "sorry, you are not registered";
}


/*$sql->close();
$conn->close();*/

pg_close($conn);
?>
