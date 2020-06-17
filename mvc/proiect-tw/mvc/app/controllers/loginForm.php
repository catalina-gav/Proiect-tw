<?php

class LoginForm extends Controller 
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('PostLogin',$this->db);
    }
    public function index()
    {   
        $this->view('login');
    }
    public function submit()
    {   
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
            ];
            print_r($data);
        
        if( 
            !empty($data['username']) &&
            !empty($data['password']) 
            ){
                echo 'aici';   
        $this->post->username= $data['username'];
        $this->post->password= $data['password'];  
        if($this->post->select()){
            echo json_encode(
                array('message'=>'PostLogin Created')
            );
        }else{
            echo json_encode(
                array('message'=>'PostLogin Not Created')
            );
        }
    }
    }
}
}