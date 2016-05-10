<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\View;

class gamesController extends listController
{
    public function __construct($entitymanager, $param)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");;
            die();
        }
        $array = $entitymanager->getRepository("Engine\Model\Game")->findAll();
        $colums = array("Game", "Aantal in opslag", "Aantal verkoopbaar", "Platform");
        $rows = array();
        foreach ($array as $object){
            $row = array();
            $row[] = $object->getGameId();
            $row[] = $object->getNaam();
            $t = rand(5,15);
            $row[] = $t;
            $row[] = $t - rand(0, 3);
            //$row[] = $object->getPlatformen()[0]->getNaam();
            $row[] = rand(1,9);
            $rows[] = $row;
        }
        parent::__construct($entitymanager, $colums, $rows, TRUE, "/game/");
    }
}
