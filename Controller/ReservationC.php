<?php


class ReservationC
{

    public function listReservation()
    {
        $sql = "SELECT * FROM reservation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteReservation($ide)
    {
        $sql = "DELETE FROM reservation WHERE reservation_id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addReservation($reservation)
    {
        $sql = "INSERT INTO reservation (name_res,event_id ,user_id, phone_res, message_res)
        VALUES ( :name_res,:event_id,:user_id,:phone_res,:message_res)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name_res' => $reservation->getname_res(),
                'event_id' => $reservation->getevent_id(),
                'user_id' => $reservation->getUserId(),
                'phone_res' => $reservation->getphone_res(),
                'message_res' => $reservation->getmessage_res()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showReservation($id)
    {
        $sql = "SELECT * FROM reservation WHERE reservation_id = :id";
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

    function updateReservation($reservation, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reservation SET 
                    name_res = :name_res, 
                    event_id = :event_id , 
                    user_id = :user_id , 
                    phone_res = :phone_res, 
                    message_res = :message_res 
                    
                WHERE reservation_id= :reservation_id'
            );

            $query->execute([
                'reservation_id' => $id,
                'name_res' => $reservation->getname_res(),
                'event_id' => $reservation->getevent_id(),
                'user_id' => $reservation->getUserId(),
                'phone_res' => $reservation->getphone_res(),
                'message_res' => $reservation->getmessage_res(),

            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
