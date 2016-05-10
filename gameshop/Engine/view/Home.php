<?php
namespace Engine\View;

class Home implements View
{
    
    private $content;

    public function __construct()
    {
        $this->content = file_get_contents("./Engine/view/pages/home.php");
    }
    
    public function view()
    {
        echo $this->content;
    }
    
}