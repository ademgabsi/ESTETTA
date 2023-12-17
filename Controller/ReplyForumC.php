<?php
include SITE_ROOT . '../Model/ReplyForum.php';
class ReplyForumC
{
    public function getAll()
    {
        $sql = "SELECT * FROM reply_forum";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addReplyForum(ReplyForum $newReplyForum)
    {
        $sql = "INSERT INTO reply_forum (`id_user`,`id_forum` ,`content`)
            VALUES (:id_user, :id_forum, :content)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $newReplyForum->getIdUser(),
                'id_forum' => $newReplyForum->getIdForum(),
                'content' => $newReplyForum->getContent()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deleteReplyForum($id)
    {
        $sql = "DELETE FROM reply_forum WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
            echo $req->rowCount() . " record(s) deleted successfully <br>";
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateReplyForum(ReplyForum $newReplyForum)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reply_forum SET 
                    content = :content
                WHERE id = :id'
            );
            $query->execute([
                'content' => $newReplyForum->getContent(),
                'id' => $newReplyForum->getId(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function getReplyForumById($id)
    {
        $sql = "SELECT * FROM reply_forum WHERE id = :id  LIMIT 1";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $ReplyForum = $query->fetch(PDO::FETCH_ASSOC);
            return $ReplyForum;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getReplyForumByUser($id_user)
    {
        $sql = "SELECT * FROM reply_forum WHERE id_user = :id_user ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $id_user,
            ]);

            $ReplyForum = $query->fetch(PDO::FETCH_ASSOC);
            return $ReplyForum;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function getReplyForumByForum($id_forum)
    {
        $sql = "SELECT * FROM reply_forum WHERE id_forum = :id_forum ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_forum' => $id_forum,
            ]);

            $ReplyForum = $query->fetch(PDO::FETCH_ASSOC);
            return $ReplyForum;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    


}
