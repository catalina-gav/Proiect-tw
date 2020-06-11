<?php
class modelCampaigns
{
    private $con;
    private $table = 'campaigns';
    public $user;
    public $name;
    public $description;
    public $place;
    public $date;
    public $image;
   
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
            user=:user,
            name=:name,
            description = :description,
            place= :place,
            date= :date,
            image= :image'
            ;
        //prepared statement
        $pstmt = $this->conn->prepare($query);

        //clean data
        $this->user = htmlspecialchars(strip_tags($this->user));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->place = htmlspecialchars(strip_tags($this->place));
        $this->date =date("Y/m/d");
        $this->image = htmlspecialchars(strip_tags($this->image)); 
        
        //bind parameters
        $pstmt->bindParam(':user',$this->user);
        $pstmt->bindParam(':name',$this->name);
        $pstmt->bindParam(':description',$this->description);
        $pstmt->bindParam(':place',$this->place);
        $pstmt->bindParam(':date',$this->date);
        $pstmt->bindParam(':image',$this->image);
        
        
        //execute query
        if($pstmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n",$pstmt->error);
        return false;
    }
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    public function getPostById($id)
    {
        $query = 'SELECT * 
            ' . $this->table . ' where $id=:id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
    }
}    