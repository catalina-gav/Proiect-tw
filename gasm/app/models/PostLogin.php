<?php
class PostLogin
{
    private $con;
    private $table = 'user';
    public $username;
    public $password;
    //constructor with db
    public function __construct($db){
        $this->conn=$db;
    }
    //get post
    public function select()
    {
        //create query
        $query = 'SELECT username,password FROM ' . $this->table . '
        WHERE username=:username';
        //prepared statement
        $pstmt = $this->conn->prepare($query);

        //clean data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password= htmlspecialchars(strip_tags($this->password));

        //bind parameters
        $pstmt->bindParam(':username',$this->username);
        //execute query
        if($pstmt->execute()){
            $row=$pstmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($row)){
            $user=array("username"=>$row['username'],"password"=>$row['password']);
            if(password_verify($this->password,$user['password']))
            {
                return true;
            }else{
            return false;
            }
        }
        return false;
        }

        // Print error if something goes wrong
      //  printf("Error: %s.\n",$pstmt->error);
        return false;
    }
}