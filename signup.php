<?php
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$username=$_POST['username'];
$email=$_POST['email'];
$birthdate=$_POST['birthdate'];
$password=$_POST['password'];
$conn=mysqli_connect("localhost","root","","login");
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
  } 
  $sql="INSERT INTO users(first_name,last_name,username,e_mail,birthdate,password) VALUES('$firstname','$lastname','$username','$email','$birthdate','$password')";
if(mysqli_query($conn,$sql))
{
    header('Location: index.html');
}
else{
    echo "Error : " . mysqli_error($conn);
}

mysqli_close($conn);
?>