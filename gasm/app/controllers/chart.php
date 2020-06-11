<?php

class Chart extends Controller
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('Post',$this->db);
    }
   public function index()
   {   
        $this->view('chart');
   }
   public function concatParams(){
    //echo $_POST['space'];
    if(isset($_POST['space']) && isset($_POST['time'])){
       $url="http://localhost:1234/gasm/public/chart/index?time=". $_POST['time'] . "&space=" . $_POST['space'];
       header('Location: ' . $url);
    }else{
       $this->view("statistics");
    }
 }

   public function display(){
      
        $data=array();
        $result=$this->post->read($_GET['time'],$_GET['space']);
       
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
          
            array_push($data,$row);
            
        }
     
        print_r(json_encode($data));
        
   }
}
