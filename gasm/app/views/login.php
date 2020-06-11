<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/login.css">
    <title>The Login Form</title>
</head>
    <header>
        <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <h1 class="logo">GaSM</h1>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <nav>
            <ul>
            <li><a href="http://localhost:1234/gasm/public/"><strong>🏡Home</strong></a></li>
                <li><a href="http://localhost:1234/gasm/public/campaigns"><strong>Campaigns</strong></a></li>
               
               <li><a href="http://localhost:1234/gasm/public/map"><strong>Map</strong></a></li>
                <li><a href="http://localhost:1234/gasm/public/statistics"><strong>Statistics</strong></a></li>
                <?php if(!isset( $_SESSION['username']))
        {
               echo '<li><a href="http://localhost:1234/gasm/public/loginForm/index"><strong>Login</strong></a></li>' ;}?>
            </ul>
        </nav>
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>
        <?php if(isset( $_SESSION['username']))
        {
       echo '<form class="logout" action="http://localhost:1234/gasm/public/loginForm/logout" method="POST">
    <input type="image"  src="https://image.flaticon.com/icons/svg/589/589061.svg" width="50" height="50">
</form>';} ?>
    </header>

<body>
    <div class="wrap">
        <form class="login-form" action="http://localhost:1234/gasm/public/loginForm/submit" method="POST">
            <div class="form-header">
                <h3>🌿Login to GaSM🌿</h3>
                
            </div>
            <!--<span class="loginError"><?php if(!empty($data[0]['login'])){ print_r($data[0]['login']);}else {}?></span> -->
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["username"])&&!empty($_POST['username'])&&empty($data[0]['usernameErr'])){} else if(isset($_POST["username"])&&!empty($_POST['username'])&&!empty($data[0]['usernameErr'])){ print_r($data[0]['usernameErr']);} else{ if(!empty($data[0]['usernameErr'])) print_r($data[0]['usernameErr']);}?></span>
                <input type="text" class="form-input" placeholder="Username" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : '';?>">
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["password"])&&!empty($_POST['password'])){} else{ if(!empty($data[0]['passwordErr'])) print_r($data[0]['passwordErr']);}?></span>
                <input type="password" class="form-input" placeholder="Password" name="password"  value="<?php echo isset($_POST["password"]) ? $_POST["password"] : '';?>">
            </div>
            <div class="formular">
                <button class="form-button" type="submit">Login</button>
            </div>
            <div class="form-footer">
            Don't have an account? <a href="http://localhost:1234/gasm/public/registerForm">Sign Up</a>
            </div>
        </form>
    </div>
</body>




<footer>
    <div class="first-footer-part">
        <h3>👨‍👨‍👧‍👧Contact details:</h3>
        <ul>
        <li>Email: gasm@recycle.com</li>
        <li> Tel: 0040748820151</li> 
        <li><Address> Flowers Street, 9</Address>
         <li>Contact us!💬</li>
        </li>   
     </ul>   
    </div>
    <span class='border'></span>   
  
    <div class="second-footer-part">
            <h2>🌻Recycle the present🌻</h2>
            <h3>🌻Save the future🌻</h3>

    </div>
    <span class='border'></span>   
    <div class="third-footer-part">
        <h3>You can also find us on:</h3>
    
        <a href="https://www.facebook.com/" class="fa fa-facebook" target="_blank"></a>
        <a href="https://www.twitter.com" class="fa fa-twitter" target="_blank"></a>
        <a href="https://www.instagram.com" class="fa fa-instagram" target="_blank"></a>
    
 
    </div>
</footer>
</html>