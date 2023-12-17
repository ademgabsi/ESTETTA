<?php
include SITE_ROOT.'../Model/LikeUserLesson.php';
class LikeUserLessonC
{
    public function afficherCourse()
    {
        $sql = "SELECT * FROM course";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    function addlikeUserLesson(LikeUserLesson $newlikeUserLesson)
    {
        $sql = "INSERT INTO like_user_lesson (`id_user`, `id_lesson`, `status`)
            VALUES (:iu, :il, :st)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'iu' => $newlikeUserLesson->getIdUser(),
                'il' => $newlikeUserLesson->getIdLesson(),
                'st' => $newlikeUserLesson->getStatus(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deletelikeUserLesson($id)
    {
        $sql = "DELETE FROM like_user_lesson WHERE id = :id";
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

    function updatelikeUserLesson(LikeUserLesson $newlikeUserLesson)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE like_user_lesson SET 
                    status = :status
                WHERE id = :id'
            );
            $query->execute([
                'status' => $newlikeUserLesson->getStatus(),
                'id' => $newlikeUserLesson->getId(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function getlikeUserLessonByLessonByUser($id_user, $id_lesson)
    {
        $sql = "SELECT * FROM like_user_lesson WHERE id_user = :id_user AND id_lesson = :id_lesson LIMIT 1";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_user', $id_user);
            $query->bindValue(':id_lesson', $id_lesson);
            $query->execute();

            $likeUserLesson = $query->fetch(PDO::FETCH_ASSOC);
            return $likeUserLesson;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getlikeUserLessonByUser($id_user)
    {
        $sql = "SELECT * FROM like_user_lesson WHERE id_user = :id_user ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $id_user,
            ]);

            $likeUserLesson = $query->fetch(PDO::FETCH_ASSOC);
            return $likeUserLesson;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function getlikeUserLessonByLesson($id_lesson)
    {
        $sql = "SELECT * FROM like_user_lesson WHERE  id_lesson = :id_lesson";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_lesson' => $id_lesson
            ]);

            $likeUserLesson = $query->fetchAll(PDO::FETCH_ASSOC);
            return $likeUserLesson;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
