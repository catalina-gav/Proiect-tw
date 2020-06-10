
<br/><br/>
<div class="chart">
<div id="chart1" style = "width: 40%;margin:auto">
<canvas id="cool-canvas" ></canvas>
</div>
<div id="space" style = "margin:4em;">

</div>
<div id="chart2" style = "width: 40%; margin:auto;">
<canvas id="piechart" ></canvas>
</div>
<div id="space" style = "margin:4em;">

</div>
<div id="chart3" style = "width: 40%; margin:auto;">
<canvas id="linechart" ></canvas>
</div>

<style>
#download-html{
    margin:auto;
}
#download-pdf{
    margin:auto;
}
.center {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  
}
</style>
<div class="center">
<a id="download-html" onclick="this.href='data:text/html;charset=UTF-8,'
+encodeURIComponent(document.documentElement.outerHTML)" 
href="#" download="page.html">Download HTML</a>

</div>
<div class="center">

<button type="button" id="download-pdf" >
  Download PDF
</button>
</div>
<div class="center">

<button id="myButton" class="button-back" >Home</button>

<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "http://localhost:1234/gasm/public/";
    };
</script>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script> 
<script src= "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript">

function separate(array,category){
    var positions=[];
    for(i=0;i<array.length;i++){
        if(array[i].localeCompare(category)==0){
            positions.push(i);
        }
    }
    return positions;
}

var ctx = document.getElementById('cool-canvas').getContext('2d');
var ctx2 = document.getElementById('piechart').getContext('2d');
var ctx3 = document.getElementById('linechart').getContext('2d');
function generateArrays(array,data){
    var categoryArray=[];
    for(i = 0; i < array.length; i++){
        categoryArray.push(data[array[i]]);
    }
    console.log(categoryArray);
    return categoryArray;
}
function dynamicColors(material) {
    var type=material;
    if(type.localeCompare("glass")==0){
        //green
        return "rgba(0,128,0,1)";
    }else if(type.localeCompare("paper")==0){
        //yellow
        return "rgba(255,255,0,1)";
    }else{
        //red
        return "rgba(255,0,0,1)";
    }
}
function poolColors(a) {
    var pool = [];
    for(i = 0; i < a.length; i++) {
        console.log(a[i]);
        pool.push(dynamicColors(a[i]));
    }
    return pool;
}

var glass_quantities=<?php echo $data[2]; ?>;
var paper_quantities=<?php echo $data[3]; ?>;
var plastic_quantities=<?php echo $data[4]; ?>;
var arrData = <?php echo $data[1]; ?>;//orase
console.log(arrData);
var materials =<?php echo $data[2]; ?>;//materiale
console.log(materials);
var amounts=<?php echo $data[1]; ?>;//cantitate
console.log(amounts);
var red_plastic="rgba(255,0,0,1)";
var yellow_paper="rgba(255,255,0,1)";
var green_glass="rgba(0,128,0,1)";
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: arrData,
        datasets: [{
            label: 'Quantity of plastic trash in kg',
            data: plastic_quantities,
            backgroundColor: red_plastic,
            borderWidth: 1
            
        },{
            label: 'Quantity of paper trash in kg',
            data: paper_quantities,
            backgroundColor: yellow_paper,   
            borderWidth: 1
            },
            {
            label: 'Quantity of glass trash in kg',
            data: glass_quantities,
            backgroundColor: green_glass,   
            borderWidth: 1
            }]
    },
    options: {
        tooltips: {
            mode : 'index',
        },
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        },
        
    }
    
});


function add(accumulator, a) {
    return accumulator + a;
}
var plasticSum=plastic_quantities.reduce(add,0);
var paperSum=paper_quantities.reduce(add,0);
var glassSum=glass_quantities.reduce(add,0);
data = {
    datasets: [{
        data: [plasticSum,glassSum,paperSum],
        backgroundColor: [red_plastic,green_glass,yellow_paper]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Total quantity of plastic trash reported',
        'Total quantity of glass trash reported',
        'Total quantity of paper trash reported'
    ]
};
var chart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: arrData,
        datasets: [{
            label: 'Quantity of plastic trash in kg',
            data: plastic_quantities,
            borderColor: red_plastic,
            borderWidth: 2
            
        },{
            label: 'Quantity of paper trash in kg',
            data: paper_quantities,
            borderColor: yellow_paper,   
            borderWidth: 2
            },
            {
            label: 'Quantity of glass trash in kg',
            data: glass_quantities,
            borderColor: green_glass,   
            borderWidth: 2
            }]
    },
    options: {
        tooltips: {
            mode : 'index',
        },
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        },
        
    }
    
});
var chart2= new Chart(ctx2, {
    type: 'pie',
    data: data,
    
});
window.onload=function(){
    document.getElementById('download-pdf').addEventListener("click", downloadPDF);
    //document.getElementById('download-html').addEventListener("click", downloadHTML);
    function downloadPDF() {
    var canvas = document.querySelector('#cool-canvas');
   var canvasImg = canvas.toDataURL("image/jpeg", 1.0);
   var doc = new jsPDF('landscape');
   doc.setFontSize(20);
   
   doc.text(15, 15, "Cool Chart");
   doc.addImage(canvasImg, 'PNG', 10, 10, 280, 150 );
   doc.save('canvas.pdf');
}
/* function downloadHTML() {
    let fileToSave=document.documentElement.outerHTML;
  let blob = new Blob([fileToSave],{type:"text/html;charset=utf-8"});
  saveAs(blob,'SavedOutline.html');
}
 */

}

</script>


