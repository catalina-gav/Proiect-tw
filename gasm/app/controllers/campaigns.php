<?php
session_start();
class Campaigns extends Controller
{
    
   public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('modelCampaigns',$this->db);
    }
    public function index()
    {
     if(!isset( $_SESSION['username']))
     {
        header('Location: http://localhost:1234/gasm/public/campaigns/showCampaigns');
     }else{
         $this->view('campaigns');
     }
    }
   
    public function showCampaigns()
    {     
         $stock = $this->model('Stock',$this->db);
         $this->view('showCampaigns',["stock" => $stock -> products]);
    }
    
    public function submit()
    {   
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user' => trim($_POST['user']),
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'place' => trim($_POST['place']),
                'image' => trim($_POST['image']),
               
            ];
           // print_r($data);
        
        if( !empty($data['user']) &&
            !empty($data['name']) &&
            !empty($data['description']) &&
            !empty($data['place'])&&
            !empty($data['image'])
            
            ){
               // echo 'aici';
            
        $this->post->user = $data['user'];
        $this->post->name= $data['name'];
        $this->post->description= $data['description'];
        $this->post->place= $data['place'];
        $this->post->image= $data['image'];
        

        if($this->post->insert()){
            // echo json_encode(
            //     array('message'=>'PostRegister Created')
            // );
         $this->view('showCampaigns');
        }else{
            echo json_encode(
                array('message'=>'PostRegister Not Created')
            );
        }
    }
    }
}


}