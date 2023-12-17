<?php
include SITE_ROOT . '../Model/Comment.php';
class CommentC
{

    function addComment(Comment $newComment)
    {
        $sql = "INSERT INTO comment (`id_user`, `id_lesson`, `comment`,`date`)
            VALUES (:iu, :il, :c,:d)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'iu' => $newComment->getIdUser(),
                'il' => $newComment->getIdLesson(),
                'c' => $newComment->getComment(),
                'd' => $newComment->getDate(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deleteComment($id)
    {
        $sql = "DELETE FROM comment WHERE id = :id";
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

    function updateComment(Comment $newComment)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE comment SET 
                    comment = :comment,
                    date = :date
                WHERE id = :id'
            );
            $query->execute([
                'comment' => $newComment->getComment(),
                'date' => $newComment->getDate(),
                'id' => $newComment->getId(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function getCommentByLessonByUser($id_user, $id_lesson)
    {
        $sql = "SELECT * FROM comment WHERE id_user = :id_user AND id_lesson = :id_lesson LIMIT 1";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_user', $id_user);
            $query->bindValue(':id_lesson', $id_lesson);
            $query->execute();

            $comment = $query->fetch(PDO::FETCH_ASSOC);
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getCommentByUser($id_user)
    {
        $sql = "SELECT * FROM comment WHERE id_user = :id_user ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $id_user,
            ]);

            $comment = $query->fetch(PDO::FETCH_ASSOC);
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function getCommentByLesson($id_lesson)
    {
        $sql = "SELECT * FROM comment WHERE  id_lesson = :id_lesson";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_lesson' => $id_lesson
            ]);

            $comment = $query->fetchAll(PDO::FETCH_ASSOC);
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
