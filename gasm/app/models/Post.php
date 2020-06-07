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
    //constructor with db
    public function __construct($db){
        $this->conn=$db;
    }
    //get post
    public function insert()
    {
        //create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            first_name=:first_name,
            last_name=:last_name,
            email= :email,
             role = :role,
            city = :city,
            cartier = :cartier,
            trash = :trash,
            notice_date = :date';
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

        //bind parameters
        $pstmt->bindParam(':first_name',$this->first_name);
        $pstmt->bindParam(':last_name',$this->last_name);
        $pstmt->bindParam(':email',$this->email);
        $pstmt->bindParam(':role',$this->role);
        $pstmt->bindParam(':city',$this->city);
        $pstmt->bindParam(':cartier',$this->cartier);
        $pstmt->bindParam(':trash',$this->trash);
        $pstmt->bindParam(':date',$this->date); 
        //execute query
        if($pstmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n",$pstmt->error);
        return false;
    }
  
    public function read($data)
    {

        $query = 'SELECT id , city, 
        cartier, trash, notice_date FROM ' . $this->table ;
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();
        return $stmt;
    } 
}