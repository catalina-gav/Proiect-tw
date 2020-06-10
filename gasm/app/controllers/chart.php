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
   {    $result=$this->post->chart_helper();
        $json1=[];
        $json2=[];
        $json3=[];
        $json4=[];
        $json5=[];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $json1[]=$city;
        $json2[]=$cartier;
        $json3[]=(int)$glass_quantity;
        $json4[]=(int)$paper_quantity;
        $json5[]=(int)$plastic_quantity;
    }
    
        $this->view('chart',json_encode($json1),json_encode($json2),json_encode($json3),json_encode($json4),json_encode($json5));
   }
}