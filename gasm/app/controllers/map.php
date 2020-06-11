<?php
session_start();
class Map extends Controller
{
   public function __construct()
   {
       $this->database = new Database();
       $this->db= $this->database -> connect();
       $this->post = $this->model('Post',$this->db);
   }
   public function index()
   {    $result=$this->post->map_data();
        $json1=[];
        $json2=[];
        $json3=[];
        $json4=[];
        $json5=[];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $json1[]=$lat;//latitudine
        $json2[]=$longit;//longitudinea
        $json3[]=(int)$glass_quantity;
        $json4[]=(int)$paper_quantity;
        $json5[]=(int)$plastic_quantity;
    }
    
        $this->view('map',json_encode($json1),json_encode($json2),json_encode($json3),json_encode($json4),json_encode($json5));
   }
}
   
