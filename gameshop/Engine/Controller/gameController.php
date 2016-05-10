<?php
namespace Engine\Controller;
use Engine\Controller\iController;
use Engine\View\GameView;
use Engine\View\View;

class gameController implements iController
{
    private $view;
    
    public function __construct($entityManager, $nr)
    {
        if(!isset($_SESSION['kr-user']))
        {
            header("Location: /gameshop/login");
            die();
        }
        $nr = intval($nr[0]);
        $game = $entityManager->find("Engine\Model\Game",$nr);
        $this->view = new gameView($game);
    }
    
    public function getView()
    {
        return $this->view;
    }

    public function setView(View $view)
    {
        $this->view = $view;
    }
}
