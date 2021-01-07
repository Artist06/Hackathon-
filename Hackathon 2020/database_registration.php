<?php

// Server name must be localhost 
$servername = "localhost"; 
  
// In my case, user name will be root 
$username = "root"; 
  
// Password is empty 
$password = "root"; 

//current date
$date = date("d/m/Y");

// cookie value
$name='';

//cookie value
$org_number='';

//cookie value
$ph_number='';

//cookie value
$email='';

//image value
$image='';

if(isset($_COOKIE)) {
    var_dump($_COOKIE);
    foreach($_COOKIE as  $key => $val)
    {
      if($key=='name'){

          $name=$val;
      }
      else if($key=='ID No'){

          $org_number=$val;
      }
      else if($key=='Mobile No'){

          $ph_number=$val;
      }
      else if($key=='Email'){

          $email=$val;
      }
      else if($key=='Image'){

          $image=$val;
      }
    }
} 
 
// Creating a connection 
$conn = new mysqli($servername,  
            $username, $password); 
  
// Check connection 
if ($conn->connect_error) { 
    die("Connection failure: " 
        . $conn->connect_error); 
}  
  
// Creating a database named Employee_information and table Employees 
$sql = "CREATE DATABASE IF NOT EXISTS Employee_information"; 
if ($conn->query($sql) === TRUE) { 
    echo "Database with name Employee_information"; 
} else { 
    echo "Error: " . $conn->error; 
}
$sql="CREATE TABLE IF NOT EXISTS Employees(Sl_no INT IDENTITY(1,1) , Full_name varchar(30), ID_no INT, Contact INT, Email varchar(30), registration_date DATE, ID_preview blob(10M))";
$conn -> query($sql);

// Inserting records
mysqli_select_db($conn, "Employee_information");
if($conn -> query("SELECT Full_name from Employees WHERE Full_name = $name") != $name){
    $sql = "INSERT INTO Employees (Full_name, ID, Contact, Email, registration_date, ID_preview) VALUES ($name, $org_number, $ph_number, $email, $date, $image)";
    if ($conn->query($sql) === TRUE){
        echo "Inserted " .$conn->query("SELECT Sl_No from Employees where Full_name=$name"). "record(s)";
    }else { 
        echo "Error: " . $conn->error; 
    }
}
else{
    echo "Don't worry ".$name.", you are already registered.";
}

  
// Closing connection 
$conn->close(); 
?>