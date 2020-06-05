<?php
class Controller{
    public function requireModel($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    public function requireView($view,$data=[])
    {
        require_once '../app/views/' . $view . '.php';
    }

}