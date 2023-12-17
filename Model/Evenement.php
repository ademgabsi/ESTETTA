<?php
class Evenement
{
    private ?int $event_id = null;
    private ?string $titre = null;
    private ?int $creator_id = null;
    private ?string $host_name = null;
    private ?string $discription = null;
    private ?string $event_image = null;
    private ?string $event_date = null;
    private ?float $price = null;
    private ?int $participants = null;


    public function __construct($id = null, $t, $c, $hn, $d, $i, $dt, $p, $participants)
    {
        $this->event_id = $id;
        $this->titre = $t;
        $this->creator_id = $c;
        $this->host_name = $hn;
        $this->discription = $d;
        $this->event_image = $i;
        $this->event_date = $dt;
        $this->price = $p;
        $this->participants = $participants;

    }
    public function getParticipants()
    {
        return $this->participants;
    }


    public function setParticipants($Participants)
    {
        $this->participants = $Participants;

        return $this;
    }

    public function getevent_id()
    {
        return $this->event_id;
    }


    public function gettitre()
    {
        return $this->titre;

    }
    public function settitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }
    public function getHostName()
    {
        return $this->host_name;
    }



    public function setHostName($host_name)
    {
        $this->host_name = $host_name;

        return $this;
    }



    public function getcreator_id()
    {
        return $this->creator_id;
    }


    public function setcreator_id($creator_id)
    {
        $this->creator_id = $creator_id;

        return $this;
    }


    public function getdiscription()
    {
        return $this->discription;
    }


    public function setdiscription($discription)
    {
        $this->discription = $discription;

        return $this;
    }
    public function getEventImage()
    {
        return $this->event_image;
    }


    public function setEventImage($event_image)
    {
        $this->event_image = $event_image;

        return $this;
    }

    public function getevent_date()
    {
        return $this->event_date;
    }


    public function setevent_date($event_date)
    {
        $this->event_date = $event_date;

        return $this;
    }

    public function getprice()
    {
        return $this->price;
    }


    public function setprice($price)
    {
        $this->price = $price;

        return $this;
    }
}
