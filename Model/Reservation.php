<?php
class Reservation
{
    private ?int $reservation_id = null;
    private ?string $name_res = null;
    private ?int $event_id = null;
    private ?int $user_id = null;
    private ?string $phone_res = null;
    private ?string $message_res = null;


    public function __construct($id = null, $nr, $e, $user_id, $pr, $mr)
    {
        $this->reservation_id = $id;
        $this->name_res = $nr;
        $this->event_id = $e;
        $this->user_id = $user_id;
        $this->phone_res = $pr;
        $this->message_res = $mr;

    }


    public function getreservation_id()
    {
        return $this->reservation_id;
    }


    public function getname_res()
    {
        return $this->name_res;

    }
    public function setname_res($name_res)
    {
        $this->name_res = $name_res;

        return $this;
    }
    public function getevent_id()
    {
        return $this->event_id;
    }



    public function setevent_id($event_id)
    {
        $this->event_id = $event_id;

        return $this;
    }



    public function getUserId()
    {
        return $this->user_id;
    }


    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }


    public function getphone_res()
    {
        return $this->phone_res;
    }


    public function setphone_res($phone_res)
    {
        $this->phone_res = $phone_res;

        return $this;
    }
    public function getmessage_res()
    {
        return $this->message_res;
    }


    public function setmessage_res($message_res)
    {
        $this->message_res = $message_res;

        return $this;
    }


}
