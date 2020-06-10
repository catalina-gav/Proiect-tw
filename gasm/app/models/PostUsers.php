<?php
class PostUsers
{
    private $con;
    private $table = 'user';
    //constructor with db
    public function __construct($db){
        $this->conn=$db;
    }
    public function select()
    {
        //create query
        $query = 'SELECT first_name,last_name,username,email FROM ' . $this->table;
        //prepared statement
        $stmt = $this->conn->prepare($query);  
        if($stmt->execute()){
          //  $data=$stmt->fetch(PDO::FETCH_ASSOC);
           // $result=$stmt->fetchAll();
           echo "<table style='border: solid 4px black; border-collapse:collapse;'>
           <tr style='width: 150px; border: 4px solid black; border-collapse: collapse;'>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>First Name</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;' >Last Name</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>Username</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>Email</th>
           </tr>";
          while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr style='width: 150px; border: 2px solid black; border-collapse: collapse;'>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['first_name'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['last_name'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['username'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['email'] . "</td>";
            echo "</tr>";
          //  print_r($result);
        }
        echo "</table>";
          return true;  
        }
        return false;
        }

}
?>