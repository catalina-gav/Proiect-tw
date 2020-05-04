<?php
$username=$_POST['username'];
$password=$_POST['password'];
$username=stripcslashes($username);
$password=stripcslashes($password);
$conn=mysqli_connect("localhost","root","","login");
if (!$conn) {
  die("Connection failed: " .mysqli_connect_error());
} 
$result=mysqli_query($conn,"select * from users where username='$username' and password='$password'");
if(mysqli_num_rows($result)>0){
  $answer=mysqli_fetch_assoc($result);
if($answer["username"]==$username&&$answer["password"]==$password){
    header('Location: index.html');
}
}
else{
  echo "Failed to login";
}
$conn->close();
?>