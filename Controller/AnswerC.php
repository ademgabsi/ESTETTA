<?php

include SITE_ROOT . "/Model/Answer.php";

class AnswerC
{
    function addAnswer(Answer $answer)
    {
        $sql = "INSERT INTO  `answer`( `contenu`, `id_rec`,  `id_sender`,`date`)
        VALUES (:c,:ir,:ise,:d)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'c' => $answer->getContenu(),
                'ir' => $answer->getIdRec(),
                'ise' => $answer->getIdSender(),
                'd' => $answer->getdate(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function getAnswer($id)
    {
        $sql = "SELECT * from answer where id=$id";
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
    function editAnswer(Answer $answer)
    {
        try {

            $db = config::getConnexion();
            $sql = "UPDATE `answer` SET `contenu`=:c,`id_rec`=:ir,`date`=:d,`id_sender`=:ise WHERE id=:id ";
            $query = $db->prepare($sql);
            $query->execute([
                'c' => $answer->getContenu(),
                'ir' => $answer->getIdRec(),
                'd' => $answer->getdate(),
                'ise' => $answer->getIdSender(),
                'id' => $answer->getId(),
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function deleteAnswer($id)
    {
        $sql = "DELETE FROM answer WHERE id=:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function getAll()
    {
        $sql = "SELECT * FROM answer";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function getAnswerBySender($id)
    {
        $sql = "SELECT * from answer where id_sender=$id";
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

    function getAnswerByRec($id)
    {
        $sql = "SELECT * from answer where id_rec=$id";
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
}
