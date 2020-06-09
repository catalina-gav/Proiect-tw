<?php
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
         $this->view('campaigns');
    }
    public function showCampaigns()
    {     //$this->post->getPosts();
         //$this->modelCampaigns->getPostById(1);
         $this->view('showCampaigns');
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
               
            ];
           // print_r($data);
        
        if( !empty($data['user']) &&
            !empty($data['name']) &&
            !empty($data['description']) &&
            !empty($data['place'])
            
            ){
               // echo 'aici';
            
        $this->post->user = $data['user'];
        $this->post->name= $data['name'];
        $this->post->description= $data['description'];
        $this->post->place= $data['place'];
        

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