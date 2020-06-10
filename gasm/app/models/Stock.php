<?php 

class Stock {
    public $products = [];
    public $db;
    public function __construct($db)
    {   
        $this->db=$db;  
        $statement = "
            SELECT * FROM campaigns";
        try {
            $statement = $this->db->query($statement);
           
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
           $json_array = array();  
           while($row = $statement->fetch(\PDO::FETCH_ASSOC))  
           {  
                $json_array[] = $row;  
           }  
           
       $allProducts = json_decode(json_encode($json_array));
        foreach ($allProducts as $product) {
           
            array_push($this -> products, (object)["id" => $product -> id, "name" => $product -> name, "description" => $product -> description,"image" => $product -> image,"user" => $product -> user]);
          
        }
        
    }
}