<?php
    class Database {
        private static $con = NULL;

        private static function connect(){
            if(is_null(self::$con)){
            self::$con= new PDO('mysql:host=localhost;dbname=gasm','root','');
            }
            return self::$con;
        }
        
    }



?>