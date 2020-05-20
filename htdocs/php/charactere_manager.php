<?php


class PersonnagesManager
{
    private $db;

    public function __construct(PDO $db){
        $this->setDb = $db;
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
     }


    public function all()
    {
        $getPersonnagesStatement = $this->setDb->query('SELECT * FROM personnages');
        return $Personnages = $getPersonnagesStatement->fetchAll();

    }


    public function getPersonnage()
    {


    }


    public function createPersonnage (Personnage $perso)
    {

    }


    public function updatePersonnage()
    {

    }


    public function deletePersonnage()
    {

        // $this->db->exec('DELETE FROM personnages WHERE id = '.$perso->id());

    }



// SETTERS----------------------

    public function setDb(PDO $db)
    {
      $this->db = $db;
    }

}
