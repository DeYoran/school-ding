<?php
namespace Engine\Controller;
use Engine\View\View;
use Engine\View\AddGame;
use Engine\View\Geregistreerd;
use Engine\View\NietNieuw;
use Engine\View\Verschil;
use Engine\Model\Game;
use Engine\Model\Platform;
use DateTime;
use DateInterval;

/**
 * Description of LoginController
 *
 * @author Yoran
 */
class addGameController implements iController
{
    
    private $view;
            
    public function __construct($entityManager)
    {
        if(isset($_POST['naam']))
        {
           $game = new Game();
            $release = new DateTime($_POST['datum']);
           switch ($_POST['type']) {
               case 'special':{
                $diff = new DateInterval('P7D');
                $verkoopstart  = $release->sub($diff);
                   $game->setStartVerkoop($verkoopstart);
                   break;
               }
               case 'voorverkoop':{
                $verkoopstart  = new DateTime();
                var_dump($verkoopstart);
                   $game->setStartVerkoop($verkoopstart);
                   break;
               }
               default:{
                   $game->setStartVerkoop($release);
                   break;
               }
           }
           foreach ($_POST['platform'] as $platform) {
               $platformObject = $entityManager->getRepository("Engine\Model\Platform")->find($platform);
               $platformen = $game->getPlatformen();
               $platformen->add($platformObject);
               $game->setPlatformen($platformen);
           }
           $game->setVerkoopprijs($_POST['verkoop']);
           $game->setInkoopprijs($_POST['inkoop']);
           $game->setNaam($_POST['naam']);
           $game->setReleasedatum($release);
           $game->setOmschrijving('null');
           $game->setBesturing('controller');
           $game->setGameid(date('U'));
           var_dump($game);
           $entityManager->persist($game);
           $entityManager->flush();
           header("Location: /gameshop/games");
           die();
        }
        else
        {
            $this->view = new AddGame();
        }
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
