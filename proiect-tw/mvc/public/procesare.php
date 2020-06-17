<?php
$username=$_POST['username'];
$password=$_POST['password'];
$username=stripcslashes($username);
$password=stripcslashes($password);
$conn=mysqli_connect("localhost","root","","gasm");
if (!$conn) {
  die("Connection failed: " .mysqli_connect_error());
} 
$result=mysqli_query($conn,"select * from user where username='$username'");
if(mysqli_num_rows($result)>0){
  $answer=mysqli_fetch_assoc($result);
if(password_verify($password,$answer["password"])){
    header('Location: index.html');
}
}
else{
  echo "Failed to login";
}
$conn->close();
?>

