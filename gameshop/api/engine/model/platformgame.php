<?php
namespace Engine\Model;

/**
 * @Entity @Table(name="platformgame")
 **/
class Platformgame
{
    //VARIABLES

    /** @Id @Column(type="integer") **/
    private $platformgameid;
     /**
     * @ManyToOne(targetEntity="Game", inversedBy="platformen")
     * @JoinColumn(name="gameId", referencedColumnName="gameId")
     **/
    private $game;
    /** @Column(type="string") **/
    private $platform;

    public function getPlatformgameid()
    {
        return $this->platformgameid;
    }
    
    public function setPlatformgameid($platformgameid)
    {
        $this->platformgameid = $platformgameid;
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

    public function getPlatform()
    {
        return $this->platform;
    }
    
    public function setPlatform($platform)
    {
        $this->platform = $platform;
        return $this;
    }

}