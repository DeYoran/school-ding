<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\view;

class testController implements iController
{
    private $view;
    
    public function __construct($entitymanager, $params)
    {
        $array = $entitymanager->getRepository("Engine\Model\VoorraadKast")->findAll();
        var_dump($array);
        die();
    }
    
    public function getView()
    {
       return null;
    }

    public function setView(View $view)
    {
        return null;
    }
    
}