<?php
namespace Model;

/**
 * @Entity @Table(name="gebruiker")
 **/
class Gebruiker
{
    //VARIABLES

    /** @Id @Column(type="string") **/
    private $klantnr;
    /** @Column(type="string") **/
    private $emailadres;
    /** @Column(type="string") **/
    private $wachtwoord;
    /** @Column(type="string") **/
    private $salt;
    /** @Column(type="string") **/
    private $naam;
    /** @Column(type="string") **/
    private $straat;
    /** @Column(type="string") **/
    private $huisnummer;
    /** @Column(type="string") **/
    private $postcode;
    /** @Column(type="string") **/
    private $woonplaats;
    /** @Column(type="string") **/
    private $telefoonnummer;

    //GETTERS & SETTERS
    public function getKlantnr()
    {
        return $this->klantnr;
    }
    
    public function setKlantnr($klantnr)
    {
        $this->klantnr = $klantnr;
        return $this;
    }

    public function getEmailadres()
    {
        return $this->emailadres;
    }
    
    public function setEmailadres($emailadres)
    {
        $this->emailadres = $emailadres;
        return $this;
    }

    public function checkWachtwoord($wachtwoord)
    {
        return hash("sha512",$this->wachtwoord.$this->salt) === hash("sha512",$wachtwoord.$this->salt);
    }
    
    public function setWachtwoord($wachtwoord)
    {
        $this->salt = md5($this->emailadres).sha1(time("u")).md5(mt_rand());
        $this->wachtwoord = hash("sha512",$wachtwoord.$this->salt);
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

    public function getStraat()
    {
        return $this->straat;
    }
    
    public function setStraat($straat)
    {
        $this->straat = $straat;
        return $this;
    }

    public function getHuisnummer()
    {
        return $this->huisnummer;
    }
    
    public function setHuisnummer($huisnummer)
    {
        $this->huisnummer = $huisnummer;
        return $this;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }
    
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function getWoonplaats()
    {
        return $this->woonplaats;
    }
    
    public function setWoonplaats($woonplaats)
    {
        $this->woonplaats = $woonplaats;
        return $this;
    }

    public function getTelefoonnummer()
    {
        return $this->telefoonnummer;
    }
    
    public function setTelefoonnummer($telefoonnummer)
    {
        $this->telefoonnummer = $telefoonnummer;
        return $this;
    }

    //FUNCTIONS
}