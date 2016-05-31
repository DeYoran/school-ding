<?php
namespace Engine\View;

use Engine\Model\Game;
use getID3;

class GameView implements View
{
    private $liedje;
    private $content;
    
    public function __construct(Game $game)
    {
        include './library/getID3/getID3.php';
        $getID3 = new getID3;
        $this->game = $game;
        ob_start();
        include("./Engine/view/pages/game.php");
        $this->content = ob_get_contents();
        ob_end_clean();
    }

    public function view()
    {
        echo $this->content;
    }

}
