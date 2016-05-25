<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\View;

class platformController extends listController
{
    public function __construct($entitymanager, $param)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");;
            die();
        }
        $array = $entitymanager->getRepository("Engine\Model\Platform")->findAll();
        $colums = array("Naam", "Omschrijving", "Aantal Games");
        $rows = array();
        foreach ($array as $object){
            $row = array();
            $row[] = $object->getNaam();
            $row[] = $object->getNaam();
            $row[] = $object->getOmschrijving();
            $row[] = sizeof($object->getGames());
            $rows[] = $row;
        }
        parent::__construct($entitymanager, $colums, $rows, TRUE, '/gameshop/album/');
    }
}