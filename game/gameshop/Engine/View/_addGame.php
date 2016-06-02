<?php
namespace Engine\View;

class AddGame implements View
{
    
    private $content;

    public function __construct()
    {
        $this->content = file_get_contents("./Engine/view/pages/addGame.php");
    }
    
    public function view()
    {
        echo $this->content;
    }
    
}