<?php
include SITE_ROOT . '../Model/Forum.php';
class ForumC
{
    public function getAll()
    {
        $sql = "SELECT * FROM forum";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addForum(Forum $newForum)
    {
        $sql = "INSERT INTO forum (`id_user`, `title`, `content`)
            VALUES (:id_user, :title, :content)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $newForum->getIdUser(),
                'title' => $newForum->getTitle(),
                'content' => $newForum->getContent()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deleteForum($id)
    {
        $sql = "DELETE FROM forum WHERE id = :id";
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

    function updateForum(Forum $newForum)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE forum SET 
                    title = :title,
                    content = :content
                WHERE id = :id'
            );
            $query->execute([
                'title' => $newForum->getTitle(),
                'content' => $newForum->getContent(),
                'id' => $newForum->getId(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function getForumById($id)
    {
        $sql = "SELECT * FROM forum WHERE id = :id  LIMIT 1";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $Forum = $query->fetch(PDO::FETCH_ASSOC);
            return $Forum;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getForumByUser($id_user)
    {
        $sql = "SELECT * FROM forum WHERE id_user = :id_user ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $id_user,
            ]);

            $Forum = $query->fetch(PDO::FETCH_ASSOC);
            return $Forum;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}
