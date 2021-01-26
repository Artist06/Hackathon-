<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, HEAD, OPTIONS");
header("Access-Control-Allow-Headers: *");

// Server name is localhost 
$servername = "ec2-52-6-75-198.compute-1.amazonaws.com"; 
  
// In my case, user name will be root 
$username = "maoeizzpabkiws"; 
  
// Password is empty 
$password = "5821762c1520d9fd66618ba143a7e510928a43bca83c4f3ef9b95cd13ba75415"; 

$database = "dd81qjvfuts0di";

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
//$conn = new mysqli($servername,  $username, $password, "dd81qjvfuts0di"); 
$conn = pg_connect("host=".($servername)." port=5432 dbname=".($database)." user=".($username)." password=".($password));
  
// Check connection 
/*if ($conn->connect_error) { 
    die("Connection failure: " 
        . $conn->connect_error); 
}  
if ($conn->ping()) {
    printf (($name).", you're registered.");
} else {
    printf ("Error: %s\n", $conn->error);
}*/
// Creating a table employees 
$sql="CREATE TABLE IF NOT EXISTS `employees`(`Sl_no` smallint(6) NOT NULL,
  `Full_name` varchar(30) NOT NULL,
  `ID_no` smallint(6) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `registration_date` date NOT NULL,
  `ID_preview` varchar(100) NOT NULL)";

pg_query($conn, $sql);
//$conn -> query($sql);


// Inserting records
/*$stmt = $conn->prepare("INSERT INTO `Employees` (Full_name, ID_no, Contact, Email, 
                                    registration_date, ID_preview) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siisss", $name, $org_number, $ph_number, $email, $date, $image);
$stmt->execute();*/

$sql = "INSERT into `employees` (Full_name, ID_no, Contact, Email, registration_date, ID_preview) values ($name, $org_number, $ph_number, $email, $date, $image)" ;
pg_query($conn, $sql);
if(!pg_query($conn, $sql)){
  echo "Something's wrong, please try again\n";
} else{
  echo $name." you're inserted";
}

/*$sql = $conn->prepare("SELECT Sl_no from employees where Full_name = ?");
$sql->bind_param('s',$name);
$sql->execute();
$result = $sql->get_result();*/

$sql = "SELECT Sl_no from employees where Full_name = ".($name);
$result = pg_query($conn, $sql);


/*if($stmt->execute()){
    echo ($name)." you are registered";
}else{
    //echo "Something's wrong, please try again";
    $stmt->error;
}*/

/*while($row = $result->fetch_assoc()){
    echo "You're ".$row['Sl_no']."th in the line";
}*/

while($row = pg_fetch_array($result)) {
  echo "You're ".$row['Sl_no']."th in the line";                         
}

$content="";
  
// Closing connection 
/*$sql->close();
$stmt->close();
$conn->close();*/

pg_close($conn);
?>
