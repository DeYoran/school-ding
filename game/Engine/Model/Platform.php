<?php
namespace Engine\Model;
 
/**
 * @Entity @Table(name="platform")
 **/
class Platform
{
    /** @Id @Column(type="string") **/
    private $naam;

    /** @Column(type="string") **/
    private $omschrijving;
    
    /**
     * @ManyToMany(targetEntity="Game", mappedBy="platformen")
     **/
    private $games;
    
    function __construct()
    {
        
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNaam()
    {
        return $this->naam;
    }
    
    public function __toString()
    {
        return $this->naam;
    }
    
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }
    
    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;
        return $this;
    }

    public function getGames()
    {
        return $this->games;
    }
    
    public function setGames($games)
    {
        $this->games = $games;
        return $this;
    }
}
