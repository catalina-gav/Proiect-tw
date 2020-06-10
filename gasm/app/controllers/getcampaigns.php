<?php
session_start();
class GetCampaigns extends Controller 
{
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('PostCampaigns',$this->db);
    }
    public function campaigns()
    {   
       if($this->post->select())
       {
            return true;
       }
       
  return false;
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD']=='GET'){
         $this->post->id=$_GET['id'];
        if($this->post->selectDelete())
        {
            if($this->post->select())
            {
                return true;
            }
            return false;
        }
        return false;

    }
    return false;
    }
}
?>
