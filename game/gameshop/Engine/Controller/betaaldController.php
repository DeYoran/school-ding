<?php
namespace Engine\Controller;
use Engine\View\View;
use Engine\View\Login;
use Engine\View\EmptyPage;
use Engine\View\VerkeerdWachtwoord;
use Engine\View\GeenToegang;
use Engine\Model\Gebruiker;

/**
 * Description of LoginController
 *
 * @author Yoran
 */
class betaaldController implements iController
{
    
    private $view;
            
    public function __construct($entityManager, $nr)
    {
        $nr = intval($nr[0]);
        $bestelling = $entityManager->find("Engine\Model\bestelling",$nr);
        $bestelling->setBetaald(1);
        $entityManager->flush();
        $user = $bestelling->getKlant();
        $to = $user->getEmail();
        $message = "Uw betaling is ontvangen en verwerkt. \nU kunt uw bestelling ophalen \nU heeft daarvoor de pdf nodig op de pagina:\n";
        $message .= "http://gameshop.sygnal.nl/api/index.php?action=getPdf&bestelling=".$nr;
        $subject = "Betaling ontvangen";
        mail($to, $subject, $message);
        header("Location: /gameshop/Home");
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
