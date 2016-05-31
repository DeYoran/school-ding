<?php
namespace Engine\Model;
 
/**
 * @Entity @Table(name="FysiekeVooraad")
 **/
class VoorraadKast 
{
   
     /** @Id @Column(type="integer") **/
    private $game;

     /** @Id @Column(type="integer") **/
    private $lokatie;

     /** @Column(type="integer") @GeneratedValue **/
    private $aantal;
    
    public function __construct()
    {
        
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

   public function getLokatie()
   {
       return $this->lokatie;
   }
   
   public function setLokatie($lokatie)
   {
       $this->lokatie = $lokatie;
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
