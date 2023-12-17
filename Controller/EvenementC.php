<?php


class EvenementC
{

    public function listevent()
    {
        $sql = "SELECT * FROM evenement";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function getEventByName($name)
    {
        $sql = "SELECT * FROM evenement WHERE titre LIKE '$name%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
            /*$query = $db->query($sql);
            $query->execute();

            $event = $query->fetch(PDO::FETCH_ASSOC);
            return $event;*/
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteevent($ide)
    {
        $sql = "DELETE FROM evenement WHERE event_id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addEvent($event)
    {
        $sql = "INSERT INTO evenement (titre, discription, event_image, event_date, creator_id,host_name,Participants, price)
        VALUES ( :titre,:discription,:event_image,:event_date,:creator_id,:host_name,:Participants,:price)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $event->gettitre(),
                'discription' => $event->getdiscription(),
                'event_image' => $event->getEventImage(),
                'event_date' => $event->getevent_date(),
                'creator_id' => $event->getcreator_id(),
                'host_name' => $event->getHostName(),
                'price' => $event->getprice(),
                'Participants' => $event->getParticipants(),

            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showevent($id)
    {
        $sql = "SELECT * FROM evenement WHERE event_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $event = $query->fetch(PDO::FETCH_ASSOC);
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateEvent($event, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE evenement SET 
                    titre = :titre, 
                    creator_id = :creator_id , 
                    host_name = :host_name , 
                    price = :price, 
                    discription = :discription, 
                    event_image = :event_image, 
                    Participants = :Participants, 
                    event_date = :event_date
                WHERE event_id= :event_id'
            );

            $query->execute([
                'event_id' => $id,
                'titre' => $event->gettitre(),
                'creator_id' => $event->getcreator_id(),
                'host_name' => $event->getHostName(),
                'discription' => $event->getdiscription(),
                'price' => $event->getprice(),
                'event_image' => $event->getEventImage(),
                'Participants' => $event->getParticipants(),
                'event_date' => $event->getevent_date(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
