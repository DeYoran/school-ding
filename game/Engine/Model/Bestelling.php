<?php
 namespace Engine\Model;
 
 use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="bestelling")
 **/
class Bestelling
{
     /** @Id @Column(type="integer") @GeneratedValue **/
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

    /** @Column(type="integer") **/
    private $betaald;
    
    public function __construct()
    {
        
    }

    function setBetaald($betaald)
    {
        $this->betaald = $betaald;
    }
    
    function getbestelId()
    {
        return $this->bestelId;
    }

    function getKlant()
    {
        return $this->klant;
    }

    function getDatum()
    {
        return $this->datum;
    }

    function getAantal()
    {
        $aantal = 0;
        foreach ($this->bestelregels as $bestelregel ) {
            $aantal += $bestelregel->getAantal();
        }
        return $aantal;
    }

}