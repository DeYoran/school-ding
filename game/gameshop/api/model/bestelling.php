<?php
 namespace Engine\Model;
 
 use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="bestelling")
 **/
class Bestelling
{
     /** @Id @Column(type="integer") **/
    private $bestelId;
    /** @Column(type="date") **/
    private $datum;
    /**
     * @ManyToOne(targetEntity="Gebruiker")
     * @JoinColumn(name="klant", referencedColumnName="klantnr")
     **/
    private $klant; 
    /** @OneToMany(targetEntity="Bestelregel", mappedBy="bestelling") */
    private $bestelregels;
    
    public function __construct()
    {
        
    }

    function setBesteId($id)
    {
        $this->bestelId = $id;
    }
    
    function getbestelId()
    {
        return $this->bestelId;
    }

    function getKlant()
    {
        return $this->klant;
    }

    function setKlant($k)
    {
        $this->klant = $k;
    }

    function getDatum()
    {
        return $this->datum;
    }

    function setDatum($d){
        $this->datum     = $d;
    }

    function getAantal()
    {
        $aantal = 0;
        foreach ($this->bestelregels as $bestelregel ) {
            $aantal += $bestelregel->getAantal();
        }
        return $aantal;
    }

    function getBestelregels()
    {
        return $this->bestelregels;
    }

    function getDate()
    {
        return $this->datum->format('d-m-Y');
    }

}