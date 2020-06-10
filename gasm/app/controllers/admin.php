<?php
session_start();
class Admin extends Controller
{
    
   public function index()
   {
    if(!isset( $_SESSION['username']))
    {
        $this->view('login');
    }
    else if(isset( $_SESSION['username'])&&strcmp( $_SESSION['username'],'admin')!=0)
    {
        $this->view('login');
    }else{
        $this->view('admin');
    }
   }
}