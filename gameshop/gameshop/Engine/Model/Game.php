<?php
namespace Engine\Model;

 use Doctrine\Common\Collections\ArrayCollection;
 use DateTime;
 
/**
 * @Entity @Table(name="game")
 **/
class Game
{
    /** @Id @Column(type="integer") **/
    private $gameId;
    /** @Column(type="string") **/
    private $omschrijving;
    /** @Column(type="string") **/
    private $naam;
    /** @Column(type="string") **/
    private $besturing;
    /** @Column(type="date") **/
    private $releasedatum;
    /** @Column(type="date") **/
    private $startverkoop;
    /**  @Column(type="integer") **/
    private $verkoopprijs;
    /**  @Column(type="integer") **/
    private $inkoopprijs;
    /**
     * @ManyToMany(targetEntity="Platform", inversedBy="games")
     * @JoinTable(
     *  name="platformgame",
     *  joinColumns={
     *   @JoinColumn(name="gameId", referencedColumnName="gameId")
     *  },
     *  inverseJoinColumns={
     *   @JoinColumn(name="platform", referencedColumnName="naam")
     *  }
     * )
     **/
    private $platformen;

    public function setReleasedatum($r){
        $this->releasedatum = $r;
    }
    
    public function __construct()
    {
        $this->platformen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function setVerkoopprijs($p){
            $this->verkoopprijs = $p;
    }

    function setInkoopprijs($p){
            $this->inkoopprijs = $p;
    }

    function getPrijs(){
        return $this->verkoopprijs / 100;
    }

    function getKorting(){
        // als de game gereleased is in het verleden, 
        if($this->releasedatum->diff(new DateTime('now'))->invert == 0){
            return 0;
        }
        if($this->releasedatum->diff(new DateTime('now'))->m > 1){
            return 0.3;
        }
        if($this->releasedatum->diff(new DateTime('now'))->m > 0){
            return 0.25;
        }
        if($this->releasedatum->diff(new DateTime('now'))->d > 13){
            return 0.15;
        }
        if($this->releasedatum->diff(new DateTime('now'))->d > 6){
            return 0.05;
        }
        else{
            return 0;
        }
    }

    function getKortingString(){
        switch ($this->getKorting()) {
            case 0.3:
                return '30% korting';
                break;
            
            case 0.25:
                return '25% korting';
                break;
            
            case 0.15:
                return '15% korting';
                break;
            
            case 0.05:
                return '5% korting';
                break;
            
            case 0:
            default:
                return '';
                break;
        }
    }

    function setOmschrijving($o){
        $this->omschrijving = $o;
    }

    function getReleasedatum(){
        return $this->releasedatum;
    }

    function getReleasedatumString(){
        return $this->releasedatum->format('Y-m-d H:i:s');
    }
    
    function getGameId()
    {
        return $this->gameId;
    }

    function setGameid($i)
    {
        $this->gameId = $i;
    }

    function getOmschrijving()
    {
        return $this->omschrijving;
    }

    function getPad()
    {
        return $this->pad;
    }

    function getAllBestellingen()
    {
        return $this->bestellingen->getValues();
    }

    function getBesturing()
    {
        return $this->besturing;
    }

    function setBesturing($b)
    {
            $this->besturing = $b;
    }

    function getAfbeeldingsUrl()
    {
        return $this->afbeeldingsurl;
    }

    function getAllArtiesten()
    {
        return $this->artiesten->getValues();
    }

    function getAllGenres()
    {
        return $this->genres->getValues();
    }

    function getNaam()
    {
        return $this->naam;
    }

    function setNaam($naam)
    {
        $this->naam = $naam;
    }

    function setPad($pad)
    {
        $this->pad = $pad;
    }

    function setAlbums($albums)
    {
        $this->albums = $albums;
    }

    function setProducers($producers)
    {
        $this->producers = $producers;
    }

    function setComponisten($componisten)
    {
        $this->componisten = $componisten;
    }

    function setArtiesten($artiesten)
    {
        $this->artiesten = $artiesten;
    }

    function setGenres($genres)
    {
        $this->genres = $genres;
    }

    public function getPlatformen()
    {
        return $this->platformen;
    }
    
    public function setPlatformen($platformen)
    {
        $this->platformen = $platformen;
        return $this;
    }

    public function getStartverkoop()
    {
        return $this->startverkoop;
    }
    
    public function setStartverkoop($startverkoop)
    {
        $this->startverkoop = $startverkoop;
        return $this;
    }
        
    public function __toString()
    {
        return $this->naam;
    }
    
}
