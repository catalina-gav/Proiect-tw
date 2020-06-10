<?php
class Post
{
    private $con;
    private $table = 'notice_form';
    public $first_name;
    public $last_name;
    public $email;
    public $role;
    public $city;
    public $cartier;
    public $date;
    public $trash;
    public $type;
    public $lat;
    public $long;
    //constructor with db
    public function __construct($db){
        $this->conn=$db;
    }
    //get post
    public function insert()
    {
        echo $this->type;
        if(strcmp($this->type,'glass')==0){
            $this->type='glassQ';
        }elseif(strcmp($this->type,'paper')==0){
            $this->type='paperQ';
        }else{
            $this->type='plasticQ';
        }
        //create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            first_name=:first_name,
            last_name=:last_name,
            email= :email,
            role = :role,
            city = :city,
            cartier = :cartier,' 
            . $this->type . ' = :quantity,
             notice_date = :date,
             lat =:lat,
             longit =:long';
        //prepared statement
        $pstmt = $this->conn->prepare($query);

        //clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email= htmlspecialchars(strip_tags($this->email));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->cartier = htmlspecialchars(strip_tags($this->cartier));
        $this->trash = htmlspecialchars(strip_tags($this->trash));
        $this->date = htmlspecialchars(strip_tags($this->date)); 
        $this->lat = htmlspecialchars(strip_tags($this->lat));
        $this->long = htmlspecialchars(strip_tags($this->long)); 

        //bind parameters
        $pstmt->bindParam(':first_name',$this->first_name);
        $pstmt->bindParam(':last_name',$this->last_name);
        $pstmt->bindParam(':email',$this->email);
        $pstmt->bindParam(':role',$this->role);
        $pstmt->bindParam(':city',$this->city);
        $pstmt->bindParam(':cartier',$this->cartier);
        $pstmt->bindParam(':quantity',$this->trash);
        $pstmt->bindParam(':date',$this->date); 
        $pstmt->bindParam(':lat',$this->lat);
        $pstmt->bindParam(':long',$this->long); 
        //execute query
        if($pstmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n",$pstmt->error);
        return false;
    }
  
    public function read($time,$place)
    {
        if(strcasecmp($time,"day")==0){
            $nr = 1;
        }elseif(strcasecmp($time,"week")==0){
            $nr = 7;
        }else{
            $nr = 30;
        }
       
        if(strcasecmp($place, "city")==0){
            $query = 'SELECT city, 
            sum(ifnull(glassQ,0)) as glass_quantity,sum(ifnull(paperQ,0)) as paper_quantity,sum(ifnull(plasticQ,0)) as plastic_quantity FROM ' . $this->table . ' where datediff(current_date,notice_date) <= :nr group by city';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nr",$nr);
            //execute
            
            $stmt->execute();
            return $stmt;
        }elseif (strcasecmp($place, "neighborhood")==0) {
            $query = 'SELECT city,cartier, 
            sum(ifnull(glassQ,0)) as glass_quantity,sum(ifnull(paperQ,0)) as paper_quantity,sum(ifnull(plasticQ,0)) as plastic_quantity FROM ' . $this->table . ' where datediff(current_date,notice_date) <= :nr group by cartier,city' ;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nr",$nr);
            //execute
            $stmt->execute();
            return $stmt;
        }
        
    } 
  /*   public function chart_helper()
    {
        $query= 'SELECT city,cartier,sum(ifnull(glassQ,0)) as glass_quantity,sum(ifnull(paperQ,0)) as paper_quantity,sum(ifnull(plasticQ,0)) as plastic_quantity FROM ' . $this->table . ' group by cartier,city' ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    } */
    public function map_data(){
        $query= 'SELECT city,cartier,sum(ifnull(glassQ,0)) as glass_quantity,sum(ifnull(paperQ,0)) as paper_quantity,sum(ifnull(plasticQ,0)) as plastic_quantity,lat,longit FROM ' . $this->table . ' group by cartier,city' ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}