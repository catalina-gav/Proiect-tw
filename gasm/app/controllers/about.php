<?php
session_start();
class About extends Controller
{
    
   public function index()
   {
        $this->view('about');
   }
}