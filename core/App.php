<?php 

class App 
{
    public static function redirectTo($page='')
    {
        return header('Location: ' . BASE_URL . $page . '.php');
    }    
}