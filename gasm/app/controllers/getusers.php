<?php
session_start();
class GetUsers extends Controller 
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('PostUsers',$this->db);
    }
    public function users()
    {   
       if($this->post->select())
       {
                return true;
       }
       
    return false;
    }
}
?>
