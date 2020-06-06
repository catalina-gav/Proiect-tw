<!DOCTYPE html>
<html lang="en">
<header>
    <link rel="stylesheet" href="index.css">
    
    <h1 class="logo">GaSM</h1>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#">Info</a></li>
            <li><a href="statistics.html">Statistics</a></li>
            <li><a href="login.html">Login</a></li>
        </ul>
    </nav>
    <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
    </label>
</header>
<head>
    <link rel="stylesheet" href="show_statistics.css">
    <title>Statistics</title>
</head>
<body>
    <div class="statistics">
        <form class="statistic-form" action="/statistics" method="POST">
            <div class="formular">
              <!-- <input type="text" class="form-input" placeholder="Choose between day,week,month"> -->
                <select  class="form-input" name="time" form="timeform">
                    <option value="Day">Day</option>
                    <option value="Week">Week</option>
                    <option value="Month">Month</option>
                </select>
            </div>
            <div class="formular">
               <!-- <input type="text" class="form-input" placeholder="Choose neighborhood / city"> -->
               <select  class="form-input" name="space" form="spaceform">
                <option value="Neighborhood">Neighborhood</option>
                <option value="City">City</option>
                </select>
            </div>
            <div class="formular">
                <select  class="form-input" name="format" form="formatform">
                    <option value="HTML">HTML</option>
                    <option value="CSV">CSV</option>
                    <option value="PDF">PDF</option>
                </select>
            </div>
            <div class="formular">
                <button class="button" type="submit">Submit</button>
            </div>
           </form>
    </div>
    <div class="show">

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
            <h3>😄Subscribe to our newsletter:</h1>
            <input type="email" class="form-input" placeholder="E-mail">
            <br>
            <br>
            <button class="btn">Subscribe</button>  
     </ul>   
    </div>
    <span class='border'></span>   
    <div class="third-footer-part">
        <h3>You can also find us on:</h3>
    
        <a href="https://www.facebook.com/" class="fa fa-facebook" target="_blank"></a>
        <a href="https://www.twitter.com" class="fa fa-twitter" target="_blank"></a>
        <a href="https://www.instagram.com" class="fa fa-instagram" target="_blank"></a>
    
        </li>   
     </ul>   
    </div>
</footer>
</html>