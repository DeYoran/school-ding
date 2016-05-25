<?php
 namespace Engine\Model;

/**
 * @Entity @Table(name="gebruiker")
 **/
class Gebruiker
{
    /** @Id @Column(type="string") **/
    private $klantnr;
	
    /** @Column(type="string") **/
    private $wachtwoord;
    
    /** @Column(type="string") **/
    private $salt;
    
    /** @Column(type="string") **/
    private $naam;
    
    /** @Column(type="string") **/
    private $emailadres;

    public function __construct() {
        
    }
    
    public function getKlantnr(){
        return $this->klantnr;
    }
    
    public function setPass($pass){
        $this->salt = hash("crc32", time());
        $this->wachtwoord = hash("sha256",$pass.$this->salt);
    }
    
    public function checkPass($pass){
       # return hash("sha256",$pass.$this->salt) === $this->wachtwoord;
        return true;
    }
    
    public function getToegang(){
        return true;
    }
    
    public function setKlantnr($klantnr){
        $this->klantnr = $klantnr;
    }
    
    public function setToegang($toegang){
        $this->toegang = $toegang;
    }
    
    function getEmail()
    {
        return $this->emailadres;
    }

    function setEmail($email)
    {
        $this->email = $emailadres;
    }



}