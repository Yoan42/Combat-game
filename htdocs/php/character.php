<?php
include "../config/autoload.php";
include "../config/db.php";

class Personnage
{
    // character properties
    private $id;
    private $nom;
    private $degats;

    public static $count = 0;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;


    public function __construct($id, $nom, $degats)
    {
      $this->setId($id); // Initialisation de l'id.
      $this->setDegats($degats); // Initialisation des dégâts.
      $this->setNom($nom); // Initialisation du nom
    }

    public function frapper(Personnage $persoAFrapper){

        if ($this->getId == $persoAFrapper->getId){
            return self::CEST_MOI;
        }else{
            return $persoAFrapper->recevoirDegats();
        }
    }

    public function recevoirDegats(){

        $this->setDegats = $this->setDegats += 10;
        if($this->setDegats >= 100){
            return self::PERSONNAGE_TUE;
        }
        return self::PERSONNAGE_FRAPPE;
    }

// GETTERS--------------------------------------------------

    public function getDegats()
  {
    return $this->degats;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNom()
  {
    return $this->nom;
  }

  // SETTERS--------------------------------------------------
  public function setDegats(int $degats)
  {
    if ($degats >= 0 && $degats <= 100)
    {
      $this->degats = $degats;
    }
  }

  public function setId(int $id)
  {
    if ($id <= 0)
    {
        throw new Exception("L'id doit être supérieur à zéro");
    }
    $this->id = $id;
  }

  public function setNom(string $nom)
  {
      $this->nom = $nom;
  }
}