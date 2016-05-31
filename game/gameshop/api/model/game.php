<?php
namespace Model;

/**
 * @Entity @Table(name="game")
 **/
class Game
{
    //VARIABLES

    /** @Id @Column(type="integer") **/
    private $gameId;
    /** @Column(type="integer") **/
    private $verkoopprijs;
    /** @Column(type="integer") **/
    private $inkoopprijs;
    /** @Column(type="date") **/
    private $releasedatum;
    /** @@Column(type="string") **/
    private $omschrijving;
    /** @Column(type="string") **/
    private $besturing;
    /** @Column(type="string") **/
    private $videolink;
    /** @Column(type="string") **/
    private $naam;

    public function getGameId()
    {
        return $this->gameId;
    }
    
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;
        return $this;
    }

    public function getVerkoopprijs()
    {
        return $this->verkoopprijs;
    }
    
    public function setVerkoopprijs($verkoopprijs)
    {
        $this->verkoopprijs = $verkoopprijs;
        return $this;
    }

    public function getInkoopprijs()
    {
        return $this->inkoopprijs;
    }
    
    public function setInkoopprijs($inkoopprijs)
    {
        $this->inkoopprijs = $inkoopprijs;
        return $this;
    }

    public function getReleasedatum()
    {
        return $this->releasedatum;
    }
    
    public function setReleasedatum($releasedatum)
    {
        $this->releasedatum = $releasedatum;
        return $this;
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

    public function getBesturing()
    {
        return $this->besturing;
    }
    
    public function setBesturing($besturing)
    {
        $this->besturing = $besturing;
        return $this;
    }

    public function getVideolink()
    {
        return $this->videolink;
    }
    
    public function setVideolink($videolink)
    {
        $this->videolink = $videolink;
        return $this;
    }

    public function getNaam()
    {
        return $this->naam;
    }
    
    public function setNaam($naam)
    {
        $this->naam = $naam;
        return $this;
    }

}