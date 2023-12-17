<?php
class CourseC
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



    function ajouterCourse($newCourse)
    {
        $sql = "INSERT INTO course (course_name, course_desc, course_author, course_img, course_duration,author_id)
            VALUES (:cn, :cds, :ca, :ci,:cd,:ai)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'cn' => $newCourse->getCourseName(),
                'cds' => $newCourse->getCourseDesc(),
                'ca' => $newCourse->getCourseAuthor(),
                'ci' => $newCourse->getCourseImg(),
                'cd' => $newCourse->getCourseDuration(),
                'ai' => $newCourse->getAuthorId(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function supprimerCourse($id)
    {
        $sql = "DELETE FROM course WHERE course_id = :id";
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

    function modifierCourse($course, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE course SET 
                    course_name = :course_name, 
                    course_desc = :course_desc, 
                    course_author = :course_author, 
                    course_img = :course_img, 
                    course_duration = :course_duration
                WHERE course_id = :id'
            );
            $query->execute([
                'id' => $id,
                'course_name' => $course->getCourseName(),
                'course_desc' => $course->getCourseDesc(),
                'course_author' => $course->getCourseAuthor(),
                'course_img' => $course->getCourseImg(),
                'course_duration' => $course->getCourseDuration(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function showCourse($id)
    {
        $sql = "SELECT * FROM course WHERE course_id = :id";
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
}
