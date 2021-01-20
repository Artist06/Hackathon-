<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, HEAD, OPTIONS");
header("Access-Control-Allow-Headers: *");
// Server name is localhost 
$servername = "localhost"; 
  
// In my case, user name will be root 
$username = "root"; 
  
// Password is empty 
$password = ""; 

foreach($_POST as $p){
    $name=$p;
}

$conn = new mysqli($servername,  
            $username, $password, "Employee_information"); 

$sql = $conn->prepare("SELECT Sl_no,Full_name from employees where Full_name = ?");
$sql->bind_param('s',$name);
$sql->execute();
$result = $sql->get_result();


if ($result->field_count > 0){
    while($row = $result->fetch_assoc()){
        echo ($name).", you are already registered, you're ".($row['Sl_no'])."th on the line";
    }
}
else{
    echo "sorry, you are not registered";
}
$sql->close();
$conn->close(); 
?>