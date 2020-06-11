
<!DOCTYPE html>
<?php
    function printError($data,$field){
        if(isset($_POST[$field]) && !empty($_POST[$field])) 
        {} else 
        {if(!empty($data[0][$field])) 
            print_r( $data[0][$field]);}
    }
    function printLast($field){
        echo isset($_POST[$field]) ? $_POST[$field] : '';
    }
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/formular_instiintare.css">
    <title>Formular</title>
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
                
           
    </nav>
    <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
    </label>
</header>

<body>
   
     <div class="wrap" >
      
        <form class="login-form" action="http://localhost:1234/gasm/public/form/submit" method="POST">
            <div class="form-header" >
                <h3>Register your area situation</h3>
                
            </div>
            <div class="formular">
                
                <span class="error">*Requiered fields</span>
                <br></br>
                <span class="error">* <?php printError($data,'first_name') ?></span>
                <input type="text" class="form-input" placeholder="First Name" name = 'first_name' value="<?php printLast('first_name') ?>">
              
            </div>
            <div class="formular">
            <span class="error">* <?php printError($data,'last_name') ?></span>
                <input type="text" class="form-input" placeholder="Last Name" name='last_name' value="<?php printLast('last_name') ?>">
          
            </div>
            <div class="formular">
            <span class="error">* <?php printError($data,'email') ?></span>
                <input type="email" class="form-input" placeholder="Email" name='email' value="<?php printLast('email') ?>">
                
            </div>
            <div class="formular">
            <span class="error">* <?php printError($data,'role') ?></span>
            <br>
            <input name="role" type="radio"  value="citizen" <?php if (isset($_POST['role']) && $_POST['role'] == "citizen") echo 'checked="checked"'; ?>>
            <label for="citizen">Citizen</label><br>
            <input name="role" type="radio"  value="public or private institution" <?php if (isset($_POST['role']) && $_POST['role'] == "public or private institution") echo 'checked="checked"';?>>
            <label for="public or private institution" >Public/Private Institution</label><br>
           </div>
           <div class="formular">
            <label for="type">Choose a category:</label><br>
            <select name ="type" class="form-input" >
                 <option value="plastic" <?php echo (isset($_POST['type']) && $_POST['type'] == 'plastic') ? 'selected="selected"' : ''; ?>>plastic</option>
               <option value="paper" <?php echo (isset($_POST['type']) && $_POST['type'] == 'paper') ? 'selected="selected"' : ''; ?>>paper</option>
               <option value="glass" <?php echo (isset($_POST['type']) && $_POST['type'] == 'glass') ? 'selected="selected"' : ''; ?>>glass</option>
            </select>
            </div>
           <div class="formular">
            <span class="error"><?php if(isset($data[0]['city'])) print_r($data[0]['city']);?> </span>
            <br>
            <label for="city">City :</label><br>
            <select name ="city" class="form-input" >
               <option  value="Alba">Alba</option>
               <option value="Arad">Arad</option>
               <option value="Arges">Arges</option>
               <option value="Bacau">Bacau</option>
               <option value="Bihor">Bihor</option>
               <option value="Bistrita-Nasaud">Bistrita-Nasaud</option>
               <option value="Botosani">Botosani</option>
               <option value="Brasov">Brasov</option>
               <option value="Braila">Braila</option>
               <option value="Bucuresti">Bucuresti</option>
               <option value="Buzau">Buzau</option>
               <option value="Caras-Severin">Caras-Severin</option>
               <option value="Calarasi">Calarasi</option>
               <option value="Cluj">Cluj</option>
               <option value="Constanta">Constanta</option>
               <option value="Covasna">Covasna</option>
               <option value="Dambovita">Dambovita</option>
               <option value="Dolj">Dolj</option>
               <option value="Galati">Galati</option>
               <option value="Giurgiu">Giurgiu</option>
               <option value="Gorj">Gorj</option>
               <option value="Harghita">Harghita</option>
               <option value="Hunedoara">Hunedoara</option>
               <option value="Ialomita">Ialomita</option>
               <option value="Iasi">Iasi</option>
               <option value="Ilfov">Ilfov</option>
               <option value="Maramures">Maramures</option>
               <option value="Mehedinti">Mehedinti</option>
               <option value="Mures">Mures</option>
               <option value="Neamt">Neamt</option>
               <option value="Olt">Olt</option>
               <option value="Prahova">Prahova</option>
               <option value="Satu Mare">Satu Mare</option>
               <option value="Salaj">Salaj</option>
               <option value="Sibiu">Sibiu</option>
               <option value="Suceava">Suceava</option>
               <option value="Teleorman">Teleorman</option>
               <option value="Timis">Timis</option>
               <option value="Tulcea">Tulcea</option>
               <option value="Vaslui">Vaslui</option>
               <option value="Valcea">Valcea</option>
               <option value="Vrancea">Vrancea</option>
          
            </select>
            <br>
            <br>
           
            <div class="formular">
            <span class="error">* <?php printError($data,'cartier') ?></span>
                <input type="text" class="form-input"  placeholder="Neighbourhood" name ="cartier" value="<?php printLast('cartier') ?>">
                
            </div>
            <span class="error">* <?php printError($data,'trash') ?></span>
            <input type="number" class="form-input" name="trash" placeholder="Estimated trash quantity(kg)" min="1" max="500" value="<?php printLast('trash') ?>">
            </div>
            <div class="formular">
                <button class="form-button" type="submit" value="submit">Submit area Maprmation</button>
            </div>
           <!--  <div class="form-footer">
            Do you have any other questions for us?Submit them here:<a href="#">Your Questions</a>
            </div> -->
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
