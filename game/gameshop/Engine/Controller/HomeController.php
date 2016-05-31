<?php
namespace Engine\Controller;

use Engine\Controller\iController;
use Engine\View\View;
use Engine\View\Home;

class HomeController implements iController
{
    private $view;
    
    public function __construct($entityManager)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");;
            die();
        }
        else
        {
            
        }
        
        $this->view = new Home();
        
    }
    
    public function setView(View $view)
    {
        $this->view = $view;
    }
    
    public function getView()
    {
        return $this->view;
    }
    
}