<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\View;

class bestellingenController extends listController
{
    public function __construct($entitymanager, $param)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");;
            die();
        }
        $array = $entitymanager->getRepository("Engine\Model\Bestelling")->findAll();
        $colums = array("Bestelnummer", "Datum bestelling", "Aantal games", "Klantnummer");
        $rows = array();
        foreach ($array as $object){
            $row = array();
            $row[] = $object->getbestelId();
            $row[] = $object->getbestelId();
            $row[] = $object->getDatum()->format("y-m-d");
            $row[] = $object->getAantal();
            if($object->getKlant())
            {
                $row[] = $object->getKlant()->getKlantNr();
            }
            
                $rows[] = $row;
        }
        parent::__construct($entitymanager, $colums, $rows, TRUE, '/gameshop/betaald/');
    }
}