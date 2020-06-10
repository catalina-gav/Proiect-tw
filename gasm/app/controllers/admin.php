<?php
session_start();
class Admin extends Controller
{
    
   public function index()
   {
        $this->view('admin');
   }
}