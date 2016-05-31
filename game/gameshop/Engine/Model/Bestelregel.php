<?php
namespace Engine\Model;
 
/**
 * @Entity @Table(name="Bestelregel")
 **/
class Bestelregel
{
    /** @Id @ManyToOne(targetEntity="Bestelling") 
     * @JoinColumn(name="bestelId", referencedColumnName="bestelId") */
    private $bestelling;
    /** @Id @ManyToOne(targetEntity="Platformgame") 
     * @JoinColumn(name="platformgameId", referencedColumnName="platformgameid") */
    private $game;
    /** @Column(type="integer") **/
    private $aantal;
    
    public function __construct()
    {
        
    }
    
    public function getBestelling()
    {
        return $this->bestelling;
    }
    
    public function setBestelling($bestelling)
    {
        $this->bestelling = $bestelling;
        return $this;
    }

    public function getGame()
    {
        return $this->game;
    }
    
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    public function getAantal()
    {
        return $this->aantal;
    }
    
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;
        return $this;
    }

}
