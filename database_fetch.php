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

foreach($_POST as $p){
    $name=$p;
}

$conn = new mysqli($servername,  
            $username, $password, "dd81qjvfuts0di"); 


// Creating a table employees 
$sql="CREATE TABLE IF NOT EXISTS `employees`(`Sl_no` smallint(6) NOT NULL,
  `Full_name` varchar(30) NOT NULL,
  `ID_no` smallint(6) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `registration_date` date NOT NULL,
  `ID_preview` varchar(100) NOT NULL)";
$conn -> query($sql);



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
