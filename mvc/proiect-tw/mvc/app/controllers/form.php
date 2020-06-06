<?php

class Form extends Controller 
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('Post',$this->db);
    }
    public function index()
    {   
        $this->view('formular_instiintare');
    }
    public function submit()
    {   
        echo 'sunt aici';
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize post data
            echo 'sunt aici';
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role']),
                'city' => trim($_POST['city']),
                'cartier' => trim($_POST['cartier']),
                'cartier' => trim($_POST['trash'])
            ];
            print_r($data);
        
        if( !empty($data['first_name']) &&
            !empty($data['last_name']) &&
            !empty($data['email']) &&
            !empty($data['role']) &&
            !empty($data['city']) &&
            !empty($data['cartier']) &&
            !empty($data['trash']) 
            ){
                echo 'aici';
            
        $this->post->first_name = $data['first_name'];
        $this->post->last_name= $data['last_name'];
        $this->post->email= $data['email'];
        $this->post->role= $data['role'];
        $this->post->city= $data['city'];
        $this->post->cartier= $data['cartier'];
        $this->post->date= date("Y/m/d");
        $this->post->trash= $data['trash'];  
        

        if($this->post->insert()){
            echo json_encode(
                array('message'=>'Post Created')
            );
        }else{
            echo json_encode(
                array('message'=>'Post Not Created')
            );
        }
    }
    }
}
}