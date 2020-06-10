<!DOCTYPE html>
<html>
    <header>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.0/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.0/dist/MarkerCluster.Default.css" />
  
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <script src="https://unpkg.com/leaflet.markercluster@1.4.0/dist/leaflet.markercluster.js"></script>
        <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/index.css">
        
        
        <h1 class="logo">GaSM</h1>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <nav>
            <ul>
                <li><a href="http://localhost:1234/gasm/public/"><strong>🏡Home</strong></a></li>
                <li><a href="#"><strong>Events</strong></a></li>
                <li><a href="http://localhost:1234/gasm/public/about"><strong>About</strong></a></li>
                <li><a href="http://localhost:1234/gasm/public/map"><strong>Map</strong></a></li>
                <li><a href="http://localhost:1234/gasm/public/statistics"><strong>Statistics</strong></a></li>
                <li><a href="http://localhost:1234/gasm/public/logMaprm/index"><strong>Login</strong></a></li>
            </ul>
        </nav>
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>
    </header>
    
<head>
    <div class="gasmMap">

    <title>The statistics</title>
</head>
<body>
<div id="map"></div>
    <style >
    .gasmMap{}
    #map {
        
        height : 800px;
        width:400;}
</style>
    <script>
    var mymap = L.map('map').setView([45.9432, 24.9668], 7);
    L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=ZGlA907NfsLGLegjEUrX', {
    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
}).addTo(mymap);

var greenIcon = new L.Icon({
  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
var yellowIcon = new L.Icon({
  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
var redIcon = new L.Icon({
  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
var longits = <?php echo $data[1]; ?>;
var lats=<?php echo $data[0]; ?>;
var glassQs=<?php echo $data[2]; ?>;
var paperQs=<?php echo $data[3]; ?>;
var plasticQs=<?php echo $data[4]; ?>;
for(i=0;i<lats.length;i++){
    var point=[lats[i],longits[i]];
    var markers = L.markerClusterGroup();
    var list = [];
    if(plasticQs[i]!=0){
    
    var marker = L.marker(point,{icon: redIcon});
    marker.bindPopup(
        "Plastic - Cantitatea totala in aceasta zona : " 
        + plasticQs[i]
    );
    list.push(marker);
    //markers.addLayer(plasticMarker);
    }
    if(glassQs[i]!=0){
    
    var marker = L.marker(point,{icon: greenIcon});
    marker.bindPopup(
        "Sticla - Cantitatea totala in aceasta zona : " 
        + glassQs[i]
    );
    list.push(marker);
    //markers.addLayer(plasticMarker);
    }
    if(paperQs[i]!=0){
    
    var marker = L.marker(point,{icon: yellowIcon});
    marker.bindPopup(
        "Hartie - Cantitatea totala in aceasta zona : " 
        + paperQs[i]
    );
    list.push(marker);
   // markers.addLayer(plasticMarker);
    }
    markers.addLayers(list);
    mymap.addLayer(markers);

}
mymap.locate({setView: true, maxZoom: 20});
function onLocationFound(e) {
    var radius = e.accuracy;

    L.marker(e.latlng).addTo(map)
        .bindPopup("You are within " + radius + " meters from this point").openPopup();

    L.circle(e.latlng, radius).addTo(map);
}

mymap.on('locationfound', onLocationFound);
function onLocationError(e) {
    alert(e.message);
}
var states = [{
    "type": "Feature",
    "properties": {"party": "Republican"},
    "geometry": {
        "type": "Polygon",
        "coordinates": [[
            [-104.05, 48.99],
            [-97.22,  48.98],
            [-96.58,  45.94],
            [-104.03, 45.94],
            [-104.05, 48.99]
        ]]
    }
}, {
    "type": "Feature",
    "properties": {"party": "Democrat"},
    "geometry": {
        "type": "Polygon",
        "coordinates": [[
            [-109.05, 41.00],
            [-102.06, 40.99],
            [-102.03, 36.99],
            [-109.04, 36.99],
            [-109.05, 41.00]
        ]]
    }
}];

L.geoJSON(states, {
    style: function(feature) {
        switch (feature.properties.party) {
            case 'Republican': return {color: "#ff0000"};
            case 'Democrat':   return {color: "#0000ff"};
        }
    }
}).addTo(mymap);
mymap.on('locationerror', onLocationError);

</script>

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