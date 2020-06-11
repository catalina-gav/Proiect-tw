<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="http://localhost:1234/gasm/public/css/chart_map.css">
    <div class="chart">
    <div id="chart1" >
    <canvas id="bar-chart" ></canvas>
    </div>
    <div id="space" >

    </div>
    <div id="chart2" >
    <canvas id="piechart" ></canvas>
    </div>
    <div id="space" >

    </div>
    <div id="chart3" >
    <canvas id="linechart" ></canvas>
    </div>
    </div>
    <div id="space" >   
    </div>
    <div class="clasification">
    <table id="clasif">
   
    </table>
    </div>

    <div class="center">
        <a id="download-html" onclick="this.href='data:text/html;charset=UTF-8,'
        +encodeURIComponent(document.documentElement.innerHTML)" 
        href="" download="raport-page.html">Download HTML</a>

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



    var ctx = document.getElementById('bar-chart').getContext('2d');
    var ctx2 = document.getElementById('piechart').getContext('2d');
    var ctx3 = document.getElementById('linechart').getContext('2d');
    function generateArray(arrData,plastic_quantities,paper_quantities,glass_quantities,type){
        cities=[];
        quantities=[];
        for(i=0;i<arrData.length;i++){
            allQuantity=plastic_quantities[i]+paper_quantities[i]+glass_quantities[i];
            quantities.push(allQuantity);
        }
        for(i=0;i<arrData.length;i++){
            if(quantities[i]>300){
                jsonCity=JSON.parse('{ " Dirtiest places  " : " ' + arrData[i] +'" ,"  In between  ": "---", "  Cleanest places " : "---" } ');
                cities.push(jsonCity);
            }else if(quantities[i]>20 && quantities[i]<50){
                jsonCity=JSON.parse('{ " Dirtiest places  " : "---" ,"  In between  ": "---", "  Cleanest places  " : " ' + arrData[i]  + '" } ');
                cities.push(jsonCity);
            }else{
                jsonCity=JSON.parse('{ "Dirtiest places " : "---" , "  In between   " : " ' + arrData[i] +'","  Cleanest places " : "---" } ');
                cities.push(jsonCity);

            }
        }
        return cities;
    }

    function generateTableHead(table, data) {
        if(data.length!=0){
            let thead = table.createTHead();
            let row = thead.insertRow();
            for (let key of data) {
                let th = document.createElement("th");
                let text = document.createTextNode(key);
                console.log(key);
                console.log(text);
                if(text!=""){
                th.appendChild(text);
                row.appendChild(th);
                }
            }
        }
    }

    function generateTable(table, data) {
        if(data.length!=0){
            for (let element of data) {

                let row = table.insertRow();
                for (key in element) {
                let cell = row.insertCell();
                let text = document.createTextNode(element[key]);
                cell.appendChild(text);
                
                }
                
            }
        }
    }

    function add(accumulator, a) {
        return accumulator + a;
    }
    function getData(){
        var data= <?php echo file_get_contents("http://localhost:1234/gasm/public/chart/display?time=" . $_GET['time'] . "&space=" . $_GET['space']);
        ?>;
        return data;
    }
    var data=getData();

    function getCities(data){
        var cities=[];
        for( i=0;i<data.length;i++){
            cities.push(data[i].city);
        }
        return cities;
    }
    function getDistricts(data){
        var districts=[];
        for( i=0;i<data.length;i++){
            districts.push(data[i].cartier);
        }
        return districts;
    }
    function getGlassAmounts(data){
        var amount=[];
        for( i=0;i<data.length;i++){
            amount.push(parseInt(data[i].glass_quantity));
        }
        return amount;

    }
    function getPaperAmounts(data){
        var amount=[];
        for( i=0;i<data.length;i++){
            amount.push(parseInt(data[i].paper_quantity));
        }
        return amount;

    }
    function getPlasticAmounts(data){
        var amount=[];
        for( i=0;i<data.length;i++){
            amount.push(parseInt(data[i].plastic_quantity));
        }
        return amount;

    }

    <?php if($_GET['space']=='City'){
        ?>
    var space='<?php echo $_GET['space'];?>';
    var time='<?php echo $_GET['time'];?>';


    console.log(data);
    console.log(data[0].city)

    var glass_quantities=getGlassAmounts(data);
    var paper_quantities=getPaperAmounts(data);
    var plastic_quantities=getPlasticAmounts(data);
    console.log("AICi E PLASTIC");
    console.log(plastic_quantities);
    var arrData = getCities(data);
    console.log(arrData);

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
    categories=generateArray(arrData,plastic_quantities,paper_quantities,glass_quantities);
    console.log(categories);
        if(categories.length!=0){
        let table = document.querySelector("table");
        let info = Object.keys(categories[0]);
        generateTableHead(table, info);
        generateTable(table, categories);
        }
    <?php
        
    }elseif($_GET['space']=='Neighborhood'){
    ?>
    var space='<?php echo $_GET['space'];?>';
    var time='<?php echo $_GET['time'];?>';

  


    console.log(data);
    console.log(data[0].city)

    var glass_quantities=getGlassAmounts(data);
    var paper_quantities=getPaperAmounts(data);
    var plastic_quantities=getPlasticAmounts(data);
    console.log("AICi E PLASTIC");
    console.log(plastic_quantities);
    var arrData = getDistricts(data);//orase
    console.log(arrData);

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
    categories=generateArray(arrData,plastic_quantities,paper_quantities,glass_quantities);
    console.log(categories);
        if(categories.length!=0){
        let table = document.querySelector("table");
        let info = Object.keys(categories[0]);
        generateTableHead(table, info);
        generateTable(table, categories);
        }

    <?php
    }
    ?>
    window.onload=function(){
    
        document.getElementById('download-pdf').addEventListener("click", downloadPDF);
        //document.getElementById('download-html').addEventListener("click", downloadHTML);
        function downloadPDF() {
        var doc = new jsPDF('landscape');
        var canvas = document.querySelector('#bar-chart');
    var canvasImg = canvas.toDataURL("image/png", 1.0);
    
    doc.setFontSize(20);
    doc.text(15, 15, "Quantity of trash based on category on each city/neighborhood.");
    doc.addImage(canvasImg, 'PNG', 10, 30, 280, 150 );
    
    doc.addPage();
    
    var canvas = document.querySelector('#piechart');
    var canvasImg = canvas.toDataURL("image/png", 1.0);
    doc.setFontSize(20);
    doc.text(15, 15, "Quantity of trash based on category for Romania.");
    doc.addImage(canvasImg, 'PNG', 10, 30, 280, 150 );

    doc.addPage();

    var canvas = document.querySelector('#linechart');
    var canvasImg = canvas.toDataURL("image/png", 1.0);
    doc.setFontSize(20);
    doc.text(15, 15, "Quantity of trash based on category on each city/neighborhood.");
    doc.addImage(canvasImg, 'PNG', 10, 30, 280, 150 );
    doc.save('Raport.pdf');
    }


    }

    </script>
</html>

