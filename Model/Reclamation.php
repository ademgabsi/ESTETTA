<?php
class Reclamation
{
    private $id = null;
    private $nom = null;
    private $sujet = null;
    private $id_user = null;
    private $date = null;
    private $message = null;


    public function __construct($id, $n, $s, $a, $d, $message)
    {
        $this->id = $id;
        $this->nom = $n;
        $this->sujet = $s;
        $this->id_user = $a;
        $this->date = $d;
        $this->message = $message;
    }


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIdUser()
    {
        return $this->id_user;
    }
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
    public function getnom()
    {
        return $this->nom;
    }


    public function setnom($nom)
    {
        $this->nom = $nom;
    }


    public function getdate()
    {
        return $this->date;
    }


    public function setdate($nom)
    {
        $this->date = $nom;
    }


    public function getsujet()
    {
        return $this->sujet;
    }


    public function setsujet($sujet)
    {
        $this->sujet = $sujet;
    }

    public function getMsg()
    {
        return $this->message;
    }


    public function setMsg($message)
    {
        $this->message = $message;
    }

}