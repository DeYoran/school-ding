<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\View;

class preordersController extends listController
{
    public function __construct($entitymanager, $param)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");;
            die();
        }
        $array = $entitymanager->getRepository("Engine\Model\Bestelregel")->findAll();
        $colums = array("Korting", "Openstaand", "Korting");
        $rows = array(
                    array(4,'percentage'=>'30','openstaand'=>0,'korting'=>0),
                    array(3,'percentage'=>'25','openstaand'=>0,'korting'=>0),
                    array(2,'percentage'=>'15','openstaand'=>0,'korting'=>0),
                    array(1,'percentage'=>'5','openstaand'=>0,'korting'=>0),
                    array(0,'percentage'=>'0','openstaand'=>0,'korting'=>0)
                );
        foreach ($array as $object){
            $game = $entitymanager->find("Engine\Model\Game",$object->getGame());
            $difference = $object->getGame()->getReleaseDatum()->diff($object->getBestelling()->getDatum());
            if($difference->inverse = 1){
                if($difference->m > 1){
                    $rows[0]['korting'] += $game->getPrijs() * 0.3 * $object->getAantal();
                    $rows[0]['openstaand'] += $game->getPrijs() * 0.7 * $object->getAantal();
                }
                elseif($difference->m > 0){
                    $rows[1]['korting'] += $game->getPrijs() * 0.25 * $object->getAantal();
                    $rows[1]['openstaand'] += $game->getPrijs() * 0.75 * $object->getAantal();
                }
                elseif($difference->d > 13){
                    $rows[2]['korting'] += $game->getPrijs() * 0.15 * $object->getAantal();
                    $rows[2]['openstaand'] += $game->getPrijs() * 0.85 * $object->getAantal();
                }
                elseif($difference->m > 6){
                    $rows[3]['korting'] += $game->getPrijs() * 0.5 * $object->getAantal();
                    $rows[3]['openstaand'] += $game->getPrijs() * 0.95 * $object->getAantal();
                }
                else{
                    $rows[4]['korting'] += $game->getPrijs() * 0 * $object->getAantal();
                    $rows[4]['openstaand'] += $game->getPrijs() * 1 * $object->getAantal();
                }
            }
        }
        parent::__construct($entitymanager, $colums, $rows, FALSE, "/game/");
    }
}
