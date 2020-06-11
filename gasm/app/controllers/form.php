<?php
session_start();
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
        
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $data=[
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'role' => '',
                'type' => '',
                'city' => '',
                'cartier' => '',
                'trash' => '',
                'city' => ''
            ];
            
            //sanitize post data
            if(empty($_POST['first_name']) ||
            empty($_POST['last_name']) ||
            empty($_POST['email']) ||
            empty($_POST['role']) ||
            empty($_POST['cartier'])||
            empty($_POST['trash']) ){
           
            if(empty($_POST['first_name'])){
                $data['first_name']='First Name is requiered';
            
            }
            if(empty($_POST['last_name'])){
                $data['last_name']='Last Name is requiered';
                
             }
             if(empty($_POST['email'])){
                $data['email']='Email is requiered';
                
             }
             if(empty($_POST['role'])){
                $data['role']='This field is requiered';
                
             }
             if(empty($_POST['cartier'])){
                $data['cartier']='Specifying the neighborhood is requiered';
             }
             if(empty($_POST['trash'])){
                $data['trash']=' Quantity is requiered';
             } 
             $data['city'] = 'Please select the city again'; 
            
          
 
            $this->view('formular_instiintare',$data);
        }
        // sursa json "https://raw.githubusercontent.com/rennokki/romania.json/master/json/regions.json";
        $json = file_get_contents("https://raw.githubusercontent.com/catalina-gav/PA-JAVA-lab6/master/json/regions.json");
        $flag=false;
        $regions = json_decode($json, true);
        if(isset($regions[strtoupper($_POST['city'])])){
          
            $cities=$regions[strtoupper($_POST['city'])];
            foreach($cities as $city){
                if($city['name']==strtoupper($_POST['cartier'])){
                    $lat=(float)$city['lat'];
                    $long= (float)$city['long'];
                    $flag=true;
                    break;
                } 
            }
            if(!$flag){
                $data['cartier']='Please enter a valid neighborhood.';
                $_POST['cartier']='';
                $this->view('formular_instiintare',$data);
            }
        }else{
            $data['city'] = 'Sorry there is no data for this city'; 
            $_POST['cartier']='';
            $this->view('formular_instiintare',$data);
        }

  
        if(isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['email']) &&
            isset($_POST['role']) &&
            isset($_POST['cartier'])&&
            isset($_POST['trash']) &&
            $flag ){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role']),
                'type' => trim($_POST['type']),
                'city' => trim($_POST['city']),
                'cartier' => trim($_POST['cartier']),
                'trash' => trim($_POST['trash'])
            ];
            
 
        if( !empty($data['first_name']) &&
            !empty($data['last_name']) &&
            !empty($data['email']) &&
            !empty($data['role']) &&
            !empty($data['type']) &&
            !empty($data['city']) &&
            !empty($data['cartier']) &&
            !empty($data['trash']) 
            ){
           
            
        $this->post->first_name = $data['first_name'];
        $this->post->last_name= $data['last_name'];
        $this->post->email= $data['email'];
        $this->post->role= $data['role'];
        $this->post->type=$data['type'];
        $this->post->city= $data['city'];
        $this->post->cartier= $data['cartier'];
        $this->post->date= date("Y/m/d");
        $this->post->trash= $data['trash'];  
        $this->post->lat= $lat; 
        $this->post->long= $long;
        $_POST = array();        
        if($this->post->insert()){
            header('Location: http://localhost:1234/gasm/public/form/index?succes');
        }
    }
    //$this->view('formular_instiintare');
    }
}

}
}