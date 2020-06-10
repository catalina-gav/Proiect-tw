<?php
session_start();
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
        if(isset( $_SESSION['username']))
        {
            $this->view('/home/index');
        }else{
        $this->view('login');
        }
    }
    public function logout()
    {
        if(isset( $_SESSION['username']))
    { session_unset();
        session_destroy();
    }
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
           // print_r($data);
           if(empty($_POST['username'])||empty($_POST['password']))
           {  $data = [
               'usernameErr' =>'',
               'passwordErr' =>''
           ];
         if(empty($_POST['username']))
         {
           $data['usernameErr']='Username is required';
         }
         if(empty($_POST['password']))
         {
           $data['passwordErr']='Password is required';
           
         }
      // print_r($data);
         $this->view('login',$data);
       }
        if( 
            !empty($data['username']) &&
            !empty($data['password']) 
            ){
        $this->post->username= $data['username'];
        $this->post->password= $data['password'];
        if($this->post->select()){
          $_SESSION['username']=$data['username'];
          if(strcmp($data['username'],'admin')==0)
          { 
            header("Location: http://localhost:1234/gasm/public/admin");
            exit();
          }else{
            header("Location: http://localhost:1234/gasm/public/home/index");
            exit();
          }
           
        }else{
             $data = [
                'usernameErr' =>'',
                'passwordErr' =>''
            ];
                $data['usernameErr']='Username/Password wrong !';
            $this->view('login',$data);
         
        }
    }
    }
}
}
