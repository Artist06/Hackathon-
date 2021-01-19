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

//current date
$date = date("Y-m-d");

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  $decoded = json_decode($content, true);

  //If json_decode failed, the JSON is invalid.
  if(! is_array($decoded)) {
      echo "Invalid json";

  } else {
      $name=$decoded['name'];
      $org_number=$decoded['id_no'];
      $ph_number=$decoded['contact'];
      $email=$decoded['email'];
      $image=$decoded['image'];
      //$image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
    // Send error back to user.
  }
}

// Creating a connection 
$conn = new mysqli($servername,  
            $username, $password, "Employee_information"); 
  
// Check connection 
if ($conn->connect_error) { 
    die("Connection failure: " 
        . $conn->connect_error); 
}  
if ($conn->ping()) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", $conn->error);
}
// Creating a table Employees 
/*$sql="CREATE TABLE IF NOT EXISTS `Employees`(Sl_no SMALLINT NOT NULL primary key AUTO_INCREMENT, Full_name varchar(30), 
      ID_no SMALLINT, Contact varchar(10), Email varchar(30), registration_date DATE, 
      ID_preview varchar(100))";
$conn -> query($sql);*/

// Inserting records
$stmt = $conn->prepare("INSERT INTO `Employees` (Full_name, ID_no, Contact, Email, 
                                    registration_date, ID_preview) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siisss", $name, $org_number, $ph_number, $email, $date, $image);
$stmt->execute();

if($stmt->execute())
    echo "record inserted";
else
    echo $stmt->error;

$content="";
  
// Closing connection 
$stmt->close();
$conn->close(); 
?>
