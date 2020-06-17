<?php
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$username=$_POST['username'];
$role=$_POST['role'];
$organization=$_POST['organization'];
$email=$_POST['email'];
$birthdate=$_POST['birthdate'];
$password=$_POST['password'];
$conn=mysqli_connect("localhost","root","","gasm");
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
  } 
  $password=password_hash($password,PASSWORD_BCRYPT);
  $stmt = $conn->prepare("INSERT INTO user(first_name,last_name,username,role,organization,email,birth_date,password) VALUES(?,?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssssss",$firstname,$lastname,$username,$role,$organization,$email,$birthdate,$password);
  if($stmt->execute())
{
    header('Location: index.html');
}
else{
    echo "Error : " . mysqli_error($conn);
}

mysqli_close($conn);
?>