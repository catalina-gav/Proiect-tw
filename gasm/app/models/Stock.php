<?php 

class Stock {
    public $products = [];

    public function __construct($db)
    {   
        $connect = mysqli_connect("localhost", "root", "", "gasm");  
           $sql = "SELECT * FROM campaigns";  
           $result = mysqli_query($connect, $sql);  
           $json_array = array();  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $json_array[] = $row;  
           }  
           /*echo '<pre>';  
           print_r(json_encode($json_array));  
           echo '</pre>';*/  
           //echo json_encode($json_array);  
           
       // $allProducts = json_decode(file_get_contents(__DIR__ . '/products.json'));
       $allProducts = json_decode(json_encode($json_array));
        foreach ($allProducts as $product) {
            // array_push($this -> products, (object)["id" => $product -> id, "name" => $product -> name, "image" => $product -> image]);
            array_push($this -> products, (object)["id" => $product -> id, "name" => $product -> name, "description" => $product -> description,"image" => $product -> image,"user" => $product -> user]);
           // return $allProducts;
        }
        
    }
}