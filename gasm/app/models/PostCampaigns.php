<?php
class PostCampaigns
{
    private $con;
    private $table = 'campaigns';
    public $id;
    //constructor with db
    public function __construct($db){
        $this->conn=$db;
    }
    public function select()
    {
        //create query
        $query = 'SELECT id,user,name,date,place FROM ' . $this->table;
        //prepared statement
        $stmt = $this->conn->prepare($query);  
        if($stmt->execute()){
           echo "<table style='border: solid 4px black; border-collapse:collapse;'>
           <tr style='width: 150px; border: 4px solid black; border-collapse: collapse;'>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>Id</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;' >User</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>Name</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>Date</th>
           <th style='width: 150px; border: 4px solid black; border-collapse: collapse;'>Place</th>
           </tr>";
          while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr style='width: 150px; border: 2px solid black; border-collapse: collapse;'>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['id'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['user'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['name'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['date'] . "</td>";
            echo "<td style='width: 150px; border: 2px solid black; border-collapse: collapse;'>" . $result['place'] . "</td>";
            echo "</tr>";
          //  print_r($result);
        }
        echo "</table><br><br>SELECT ID TO DELETE CAMPAIGN  <input type='number' min='1' step='1' id='idCampaign' style='border:2px solid black'> <button class='form-button' type='submit' onclick='DeleteCampaign()'>Delete</button>";
          return true;  
        }
        return false;
        }
        public function selectDelete()
        {
            try{
            $query = 'DELETE FROM '.$this->table.' WHERE id=:id';
            //prepared statement
            $stmt = $this->conn->prepare($query); 
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id',$this->id); 
            $stmt->execute();
            $nr=$stmt->rowCount();
            if($nr>0)
            {
                return true;
            }else{
            return false;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
           
          }
            return false;
        }

}
?>