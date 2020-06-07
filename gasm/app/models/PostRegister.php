<?php
class PostRegister
{
    private $con;
    private $table = 'user';
    public $first_name;
    public $last_name;
    public $username;
    public $role;
    public $organization;
    public $email;
    public $birth_date;
    public $password;
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
            username=:username,
            role = :role,
            organization = :organization,
            email= :email,
            birth_date = :birth_date,
            password = :password';
        //prepared statement
        $pstmt = $this->conn->prepare($query);

        //clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->organization = htmlspecialchars(strip_tags($this->organization));
        $this->email= htmlspecialchars(strip_tags($this->email));
        $this->birth_date = htmlspecialchars(strip_tags($this->birth_date)); 
        $this->password= htmlspecialchars(strip_tags($this->password));

        //bind parameters
        $pstmt->bindParam(':first_name',$this->first_name);
        $pstmt->bindParam(':last_name',$this->last_name);
        $pstmt->bindParam(':username',$this->username);
        $pstmt->bindParam(':role',$this->role);
        $pstmt->bindParam(':organization',$this->organization);
        $pstmt->bindParam(':email',$this->email);
        $pstmt->bindParam(':birth_date',$this->birth_date); 
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
        $pstmt->bindParam(':password',$this->password);
        //execute query
        if($pstmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n",$pstmt->error);
        return false;
    }
}