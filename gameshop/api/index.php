<?php
require_once('engine/model/gebruiker.php');
require_once('engine/model/platformgame.php');
require_once('engine/model/game.php');
require_once('engine/model/bestelregel.php');
require_once('engine/model/bestelling.php');
include('../mpdf60/mpdf.php');
use Engine\Model\Gebruiker;


	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

set_error_handler("error");

require_once('bootstrap.php');

$return = array();

if(!isset($_GET['action'])){
    $return['message'] = 'no action set';
    $return['status'] = 'fail';
    $returnstring = json_encode($return);
    die($returnstring);
}

call_user_func($_GET['action']);

function getGameInfo(){
    global $em;
    $pgame = $em->getRepository("Engine\\Model\\Platformgame")->find($_GET['game']);
    $gameid = $pgame->getGame()->getGameId();
    $game = $em->getRepository("Engine\Model\Game")->find($gameid);
    $html='
   <h2>'.$game->getNaam().'</h2>
    <img src="img/covers/'.$_GET['game'].'.png">
    <p>
        '.$game->getOmschrijving().'
    </p>
    <div class="pricing">
        € '.$game->getPrijs().' <a id="addToCart" href="javascript:void(0)">add to cart</a>
    </div>';
    die($html);
}

function getGames(){
    global $em;
    $pgames = $em->getRepository("Engine\\Model\\Platformgame")->findAll();
    $return['html'] = '';
    foreach ($pgames as $pgame) {
        if($_GET['platform'] == 'all' || strtolower(str_replace(' ', '_', $pgame->getPlatform())) == strtolower($_GET['platform'])){
            $game = $pgame->getGame();
            $diff = $game->getStartverkoop()->diff(new DateTime());
            if(!$diff->invert){
                $prijs = number_format($game->getPrijs() ,2);
                $return['html'] .= "
                <div class='game'>
                    <img src='img/covers/".$pgame->getPlatformgameid().".png' class='coverimage'>
                    <h4>".$game->getNaam()."</h4>
                    <p>
                        <span class='label'>Price</span>
                        <span class='price'>€".$prijs."</span><br /><br />
                        <a href='game/".$pgame->getPlatformgameid()."' class='button'>More info</a>
                    </p>
                </div>";
            }
        }
    }
    $return['status'] = 'succes';
    $returnstring = json_encode($return);
    die($returnstring);
}

function getNews(){
    $xmlstring = file_get_contents("http://feeds.videogamer.com/rss/news.xml");
    $data = parseXML($xmlstring);
    $return['html'] = '';
    $i = 0;
    foreach ($data->channel->item as $item) {
        if($i > 2){
            break;
        }
        $pos = strpos($item->description, 'http://s.pro-gmedia.com/videogamer/media/images/pub/featured/news');
        $url = substr($item->description, $pos, 81);
        $return['html'] .= "
        <div class='item'>
            <h3>".$item->title."</h3>
            <img class='itemimg' src='".$url."'>
            <a href='".$item->link."' target='_blank' class='itemlink'>VideoGamer.com<i class='fa fa-chevron-circle-right'></i></a>
        </div>";
        $i++;
    }
    $return['status'] = 'succes';
    $returnstring = json_encode($return);
    die($returnstring);
}

function error($errno, $errstr, $errfile, $errline){
    $return['message'] = $errstr;
    $return['file'] = $errfile;
    $return['line'] = $errline;
    if($errno == E_WARNING || $errno == E_USER_WARNING || $errno == E_CORE_WARNING ){
        $return['status'] = 'warning';
    }
    else{
        $return['status'] = 'error';
        $returnstring = json_encode($return);
        die($returnstring);
    }
}

function parseXML($xml){
    $sxmle = new SimpleXMLElement($xml);
    return $sxmle;
}

function removeFromCart(){
    global $em;
    $game = $em->getRepository("Engine\Model\Platformgame")->find($_GET['game']);
    if(isset($_SESSION['cart'][$game->getPlatformgameid()])){
        unset($_SESSION['cart'][$game->getPlatformgameid()]);
    }
}

function addToCart(){
    global $em;
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    $game = $em->getRepository("Engine\Model\Platformgame")->find($_GET['game']);
    if(isset($_SESSION['cart'][$game->getPlatformgameid()])){
        $_SESSION['cart'][$game->getPlatformgameid()] += $_GET['aantal'];
    }
    else{
        $_SESSION['cart'][$game->getPlatformgameid()] = (int) $_GET['aantal'];
    }
}

function getTotaal(){
    global $em;
    $html = '';
    if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $cartitem => $amount ) {
            $pgame = $em->getRepository("Engine\Model\Platformgame")->find($cartitem);
            $game = $pgame->getGame();
            $html += $game->getPrijs() * $amount;
        }
    }
    else{
        $html = '0,00';
    }
    die($html);
}

function getBasket(){
    global $em;     
    $html = '';
    if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $cartitem => $amount ) {
            $html .= '<tr>';
            $pgame = $em->getRepository("Engine\Model\Platformgame")->find($cartitem);
            $game = $pgame->getGame();
            $html .= '<td class="name">'.$game->getNaam().'</td>';
            $html .= '<td class="amount">'.$amount.'</td>';
            $html .= '<td class="price">€'.$game->getPrijs().'</td>';
            $html .= '<td class="total">€'.$game->getPrijs() * $amount.'</td>';
            $html .= '</tr>';
        }
    }
    else{
         $html .= '<tr>';
            $html .= '<td colspan=4>There are no items in your shopping cart</td>';
            $html .= '</tr>';
    }
    die($html);
}

function getNewGames(){
    global $em;
    $pgames = $em->getRepository("Engine\Model\Platformgame")->findAll();
    $return['html'] = '';
    foreach ($pgames as $pgame) {
            $game = $pgame->getGame();
            $diff = $game->getStartverkoop()->diff(new DateTime());
            if($_GET['vari'] == 'upcoming'){
                if($diff->invert){
                     $prijs = number_format($game->getPrijs() / 100,2);
                    $return['html'] .= "
                    <div class='game'>
                        <img src='img/covers/".$pgame->getPlatformgameid().".png' class='coverimage'>
                        <h4>".$game->getNaam()."</h4>
                        <p>
                            <span class='label'>Price</span>
                            <span class='price'>€".$prijs."</span><br /><br />
                            <a href='game/".$pgame->getPlatformgameid()."' class='button'>More info</a>
                        </p>
                    </div>";
                }
            }
            else{
                if(!$diff->invert){
                    $prijs = number_format($game->getPrijs() / 100,2);
                    $return['html'] .= "
                    <div class='game'>
                        <img src='img/covers/".$pgame->getPlatformgameid().".png' class='coverimage'>
                        <h4>".$game->getNaam()."</h4>
                        <p>
                            <span class='label'>Price</span>
                            <span class='price'>€".$prijs."</span><br /><br />
                            <a href='game/".$pgame->getPlatformgameid()."' class='button'>More info</a>
                        </p>
                    </div>";
                }
            }
    }
    $return['status'] = 'succes';
    $returnstring = json_encode($return);
    die($returnstring);

}

function order(){
    global $em;
    var_dump($_SESSION);
    $bestelling = new Engine\Model\Bestelling();
    $bestelling->setDatum(new DateTime());
    $bestelling->setBesteId(date('U'));
    if(isset($_SESSION['kr-user']) && isset($_SESSION['cart'])){
        $user = $em->getRepository("Engine\Model\Gebruiker")->find($_SESSION['kr-user']->getKlantnr());
        $bestelling->setKlant($user);
        $em->persist($bestelling);
        $em->flush();
        foreach ($_SESSION['cart'] as $item => $amount) {
            $regel = new Engine\Model\Bestelregel();
            $regel->setBestelling($bestelling);
            $game = $em->getRepository("Engine\Model\Platformgame")->find($item);
            $regel->setGame($game);
            $regel->setAantal($amount);
            $em->persist($regel);
        }
        $em->flush();
        unset($_SESSION['cart']);

        $to = $user->getEmailadres();
        $subject = 'Confirmation order';
        $message = 'Uw bestelling is geplaatst, na betaling krijg u een pdf toegestuurd met de gegevens voor het ophalen';
        mail($to, $subject, $message);
    }
}

function login(){
    global $em;
    if(isset($_SESSION['kr-user'])){
        die('true');
    }
    $user = $em->getRepository("Engine\Model\Gebruiker")->find($_POST['klantnr']);
    if($user->checkWachtwoord($_POST['pass'])){
        $_SESSION['kr-user'] = $user;
        die('true');
    }
    die('false');
}

function getPDF(){
    global $em;
    $bestelling = $em->getRepository("Engine\Model\Bestelling")->find($_GET['bestelling']);
    $mpdf=new mPDF();
    $mpdf->WriteHTML('<h3>Order confirmation</h3>');
    $mpdf->WriteHTML('<p>Name: Yoran</p>');
    $mpdf->WriteHTML('<p>Date: '.$bestelling->getDate().'</p>');
    $mpdf->WriteHTML('<table>');
    $total = 0;
    $bestelregels = $bestelling->getBestelregels()->toArray();
    foreach ($bestelregels as $bestelregel) {
        $game = $bestelregel->getGame()->getGame();
        $mpdf->WriteHTML('<tr>');
        $mpdf->WriteHTML('<td>'.$game->getNaam().'</td>');
        $mpdf->WriteHTML('<td>€'.$game->getPrijs().'</td>');
        $mpdf->WriteHTML('</tr>');
    }
    $mpdf->WriteHTML('</table>');
    $mpdf->WriteHTML('<img src="plugin/barcode.php?text='.$_GET['bestelling'].'">');
    $mpdf->WriteHTML('&nbsp;&nbsp;'.$_GET['bestelling']);

    $mpdf->Output();
    exit;
}