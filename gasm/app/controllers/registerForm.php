<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
class RegisterForm extends Controller 
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('PostRegister',$this->db);
    }
    public function index()
    {   if(isset( $_SESSION['username']))
        {
            session_destroy();
        }
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
                'password' => trim($_POST['password'])
            ];
            //print_r($data);
           
            if(empty($_POST['first_name'])||empty($_POST['last_name'])||empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['birth_date']))
            {  $data = [
                'first_name' =>'',
                'last_name' =>'',
                'username' =>'',
                'email' => '',
                'birth_date' =>'',
                'password' =>''
            ];

          if(empty($_POST['first_name']))
          {
              $data['first_name']='First Name is required';
             
          }
        if(empty($_POST['last_name']))
          {
            $data['last_name']='Last Name is required';
          }
          if(empty($_POST['username']))
          {
            $data['username']='Username is required';
          }
          if(empty($_POST['email']))
          {
            $data['email']='Email is required';
             
          }
          if(empty($_POST['password']))
          {
            $data['password']='Password is required';
            
          }
          if(empty($_POST['birth_date']))
          {
            $data['birth_date']='Birthdate is required';
            
          }
       // print_r($data);
          $this->view('register',$data);
        }
    
        if( !empty($data['first_name']) &&
            !empty($data['last_name']) &&
            !empty($data['username']) &&
            !empty($data['email']) &&
            !empty($data['role']) &&
            !empty($data['birth_date']) &&
            !empty($data['password']) 
            ){
            
        $this->post->first_name = $data['first_name'];
        $this->post->last_name= $data['last_name'];
        $this->post->username= $data['username'];
        $this->post->role= $data['role'];
        $this->post->organization=$data['organization'];
        $this->post->email= $data['email'];
        $this->post->birth_date=$data['birth_date'];
        $this->post->password= $data['password'];  
        
        if($this->post->existUsername())
        {
          $data['username']='Username already used!';
          $data['email']='';
          $this->view('register',$data);
        }
       else if($this->post->existEmail())
        {
          $data['email']='Email already used !';
          $data['username']='';
          $this->view('register',$data);
        }

       else  if($this->post->insert()){
        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'reviewinator.noreply@gmail.com';
$mail->Password = 'WhoCouldPossiblyHateSarmale?';
          $mail->setFrom('reviewinator.noreply@gmail.com','GaSM User Registration');
          $mail->addAddress($this->post->email);
          $mail->isHTML(true);
          $mail->Subject='GaSM Registration';
          $mail->Body='GaSM Registration Success';
         $mail->send();
            $this->view('login');
        }else{
            echo json_encode(
                array('message'=>'PostRegister Not Created')
            );
        }
    }
    }
}
}