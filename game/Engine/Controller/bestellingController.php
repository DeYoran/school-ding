<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\View;

class bestellingController extends listController
{
    public function __construct($entitymanager, $param)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");;
            die();
        }
        $array = $entitymanager->getRepository("Engine\Model\Bestelregel")->findAll();
        $colums = array("Game", "Aantal", "Platform", "lokatie");
        $rows = array();
        foreach ($array as $object){
            $game = $entitymanager->find("Engine\Model\Game",$object->getGame());
            $row = array();
            $row[] = $object->getGame()->getGameId();
            $row[] = $object->getGame()->getGameId();
            $row[] = $object->getAantal();
            $row[] = $object->getGame()->getPlatformen()[0]->getNaam();
            $row[] = rand(1,9);
             if(isset($param[0]) && $object->getBestelling()->getBestelId() == $param[0]){
                $rows[] = $row;
            }
            else{
                
            }
        }
        parent::__construct($entitymanager, $colums, $rows, TRUE, "/game/");
    }
}
