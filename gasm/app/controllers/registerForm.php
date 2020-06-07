<?php

class RegisterForm extends Controller 
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('PostRegister',$this->db);
    }
    public function index()
    {   
        $this->view('register');
    }
    public function submit()
    {   
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'username' => trim($_POST['username']),
                'role' => trim($_POST['role']),
                'organization' => trim($_POST['organization']),
                'email' => trim($_POST['email']),
                'birth_date' => trim($_POST['birth_date']),
                'password' => trim($_POST['password']),
            ];
            print_r($data);
        
        if( !empty($data['first_name']) &&
            !empty($data['last_name']) &&
            !empty($data['username']) &&
            !empty($data['email']) &&
            !empty($data['role']) &&
            !empty($data['birth_date']) &&
            !empty($data['password']) 
            ){
                echo 'aici';
            
        $this->post->first_name = $data['first_name'];
        $this->post->last_name= $data['last_name'];
        $this->post->username= $data['username'];
        $this->post->role= $data['role'];
        $this->post->organization=$data['organization'];
        $this->post->email= $data['email'];
        $this->post->birth_date=$data['birth_date'];
        $this->post->password= $data['password'];  
        

        if($this->post->insert()){
            echo json_encode(
                array('message'=>'PostRegister Created')
            );
        }else{
            echo json_encode(
                array('message'=>'PostRegister Not Created')
            );
        }
    }
    }
}
}