<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/admin.css">
        <title>
            Admin Panel
        </title>

        <script>
function showUsers() {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("showdata").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","http://localhost:1234/gasm/public/getusers/users",true);
  xmlhttp.send();
}
</script>
<script>
function showPages() {
  document.getElementById("showlist").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.pages')) {
    var list = document.getElementsByClassName("list-content");
    var i;
    for (i = 0; i < list.length; i++) {
      var openList = list[i];
      if (openList.classList.contains('show')) {
        openList.classList.remove('show');
      }
    }
  }
}
</script>
<script>
    function deleteCampaign()
    { 
        document.getElementById("showdata").innerHTML="<input type="numeric" id="select">";
        
    }
    </script>
    </head>
 <body>
     <div class="header">
<img  class ="admin-icon" src="https://image.flaticon.com/icons/svg/181/181549.svg" width="70" height="90">
</div>
<div class="meniu">
<ul>
    <li><a href="#" >🏡 Dashboard</a></li>
    <li><a href="#" id ="user" onclick="showUsers()">👨‍👨‍Users</a></li>
    <li><a href="#" onclick="showPages()" class="pages">Pages</a>
         <div id="showlist" class="list-content">
                <a href="http://localhost:1234/gasm/public/">Home</a>
                <a href="http://localhost:1234/gasm/public/campaigns">Campaigns</a>
                <a href="http://localhost:1234/gasm/public/about">About</a>
               <a href="http://localhost:1234/gasm/public/map">Map</a>
                <a href="http://localhost:1234/gasm/public/statistics">Statistics</a>
    </div></li>
    <li><a href="#" id="campanie" onclick="deleteCampaign()">Delete Campaign</a></li>
</ul>
</div>

<div id="data">
    <div id="showdata"></div>
</div>
<div class="footer">
<div class="logo">GaSM</div>
</div>


</body>
</html>