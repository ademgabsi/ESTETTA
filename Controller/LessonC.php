<?php

class LessonC
{
    public function afficherLesson()
    {
        $sql = "SELECT * FROM lesson";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function showLessonByCourse($id)
    {
        $sql = "SELECT * FROM lesson WHERE course_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $course = $query->fetch();
            return $course;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
 

    function ajouterLesson($newLesson)
    {
        $sql = "INSERT INTO lesson (lesson_name, lesson_description, lesson_video, course_id)
            VALUES (:ln, :ld, :lv, :ci)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ln' => $newLesson->getLessonName(),
                'ld' => $newLesson->getLessonDescription(),
                'lv' => $newLesson->getLessonVideo(),
                'ci' => $newLesson->getCourseId(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function supprimerLesson($id)
    {
        $sql = "DELETE FROM lesson WHERE lesson_id = :id";
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

    function showLesson($id)
    {
        $sql = "SELECT * FROM lesson WHERE lesson_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $course = $query->fetch(PDO::FETCH_ASSOC);
            return $course;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    function modifierLesson($lesson, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE lesson SET 
                    lesson_name = :lesson_name, 
                    lesson_description = :lesson_description, 
                    lesson_video = :lesson_video, 
                    course_id = :course_id
                WHERE lesson_id = :id'
            );
            $query->execute([
                'id' => $id,
                'lesson_name' => $lesson->getLessonName(),
                'lesson_description' => $lesson->getLessonDescription(),
                'lesson_video' => $lesson->getLessonVideo(),
                'course_id' => $lesson->getCourseId(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }


}
?>