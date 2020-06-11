<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/register.css">
        <title>The Register Form</title>
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
        <form class="login-form" action="http://localhost:1234/gasm/public/registerForm/submit" method="POST" >
            <div class="form-header">
            
                <h3>Signup to GaSM</h3>
                
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["first_name"])&&!empty($_POST['first_name'])){} else{ if(!empty($data[0]['first_name'])) print_r($data[0]['first_name']);}?></span>
                <input type="text" class="form-input" placeholder="First name" name="first_name" value="<?php echo isset($_POST["first_name"]) ? $_POST["first_name"] : '';?>">
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["last_name"])&&!empty($_POST['last_name'])){} else{ if(!empty($data[0]['last_name'])) print_r($data[0]['last_name']);}?></span>
                <input type="text" class="form-input" placeholder="Last name" name="last_name"  value="<?php echo isset($_POST["last_name"]) ? $_POST["last_name"] : '';?>">
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["username"])&&!empty($_POST['username'])&&empty($data[0]['username'])){} else if(isset($_POST["username"])&&!empty($_POST['username'])&&!empty($data[0]['username'])){print_r($data[0]['username']);} else{ if(!empty($data[0]['username'])) print_r($data[0]['username']);}?></span>
                <input type="text" class="form-input" placeholder="Username" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : '';?>">
            </div>
            <div class="formular"> 
            <input name="role" type="radio"  value="citizen" checked>
            <label for="citizen">Citizen</label><br>
            <input name="role" type="radio"  value="public or private institution">
            <label for="public or private institution" >Public/Private Institution</label><br>
           </div>
            <div class="formular">
                <input type="text" class="form-input" placeholder="Organization" name="organization">
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["email"])&&!empty($_POST['email'])&&empty($data[0]['email'])){} else if(isset($_POST["email"])&&!empty($_POST['email'])&&!empty($data[0]['email'])){print_r($data[0]['email']);} else{ if(!empty($data[0]['email'])) print_r($data[0]['email']);}?></span>
                <input type="email" class="form-input" placeholder="E-mail" name="email"  value="<?php echo isset($_POST["email"]) ? $_POST["email"] : '';?>">
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["birth_date"])&&!empty($_POST['birth_date'])){} else{ if(!empty($data[0]['birth_date'])) print_r($data[0]['birth_date']);}?></span>
                <input type="date" class="form-input" placeholder="Birthdate" name="birth_date"  value="<?php echo isset($_POST["birth_date"]) ? $_POST["birth_date"] : '';?>">
            </div>
            <div class="formular">
            <span class="error">*<?php if(isset($_POST["password"])&&!empty($_POST['password'])){} else{ if(!empty($data[0]['password'])) print_r($data[0]['password']);}?></span>
                <input type="password" class="form-input" placeholder="Password" name="password"  value="<?php echo isset($_POST["password"]) ? $_POST["password"] : '';?>">
            </div>
            <div class="formular">
                <button class="form-button" type="submit">Register</button>
            </div>
            <div class="form-footer">
            Already have an account? <a href="http://localhost:1234/gasm/public/loginForm">Login</a>
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