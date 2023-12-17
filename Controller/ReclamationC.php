<?php

include SITE_ROOT . "/Model/Reclamation.php";


class ReclamationC
{
    function ajouterreclamation(Reclamation $reclamation)
    {
        $sql = "INSERT INTO reclamation (nom, sujet,id_user,date,message) 
        VALUES (:nom,:sujet,:id_user,:date,:message)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $reclamation->getnom(),
                'sujet' => $reclamation->getSujet(),
                'id_user' => $reclamation->getIdUser(),
                'date' => $reclamation->getdate(),
                'message' => $reclamation->getMsg(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }


    function getById($id)
    {
        $sql = "SELECT * from reclamation where id=$id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $rendezvous = $query->fetch();
            return $rendezvous;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function modifierRec(Reclamation $rec)
    {
        try {

            $db = config::getConnexion();
            $sql = "UPDATE reclamation SET nom = :nom,sujet = :sujet ,id_user= :id_user ,date= :date,message= :message WHERE id=:id ";
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $rec->getId(),
                'sujet' => $rec->getsujet(),
                'nom' => $rec->getnom(),
                'id_user' => $rec->getIdUser(),
                'date' => $rec->getdate(),
                'message' => $rec->getMsg(),
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function afficherRec()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function GetByName($name)
    {
        $sql = "SELECT * FROM reclamation  where nom LIKE '%$name%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function getByIdUser($id)
    {
        $sql = "SELECT * from reclamation where id_user=$id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $article = $query->fetchAll();
            return $article;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function supprimerRec($id)
    {
        $sql = "DELETE FROM reclamation WHERE id=:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}
