<?php
class Answer
{
    private  $id = null;
    private  $contenu = null;
    private  $id_sender = null;
    private  $id_rec = null;
    private  $date = null;


    public function __construct($id, $idRec, $idSender, $contenu, $d)
    {
        $this->id = $id;
        $this->id_rec = $idRec;
        $this->id_sender = $idSender;

        $this->contenu = $contenu;
        $this->date = $d;
    }


    public function getId()
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getIdRec()
    {
        return $this->id_rec;
    }
    public function setIdRec(int $id_rec)
    {
        $this->id_rec = $id_rec;
    }
    public function getIdSender()
    {
        return $this->id_sender;
    }
    public function setIdSender(int $id_sender)
    {
        $this->id_sender = $id_sender;
    }



    public function getdate()
    {
        return $this->date;
    }


    public function setdate($date)
    {
        $this->date = $date;
    }


    public function getContenu()
    {
        return $this->contenu;
    }


    public function setCfontenu($contenu)
    {
        $this->contenu = $contenu;
    }
}
