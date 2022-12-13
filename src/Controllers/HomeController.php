<?php
namespace App\Controllers;


use App\Views\HomeView;

class HomeController {


    private $model;

    public function __construct()
    { 
        
    }

    public function index() {
        
        $view = new HomeView();
        $view->index();
    }
    
}
