<?php
class Lesson
{
    private ?int $id = null;
    private ?string $lesson_name = null;
    private ?string $lesson_description = null;
    private ?string $lesson_video = null;
    private ?string $course_id = null;

    public function __construct($id = null, $ln, $ld, $lv, $ci)
    {
        $this->id = $id;
        $this->lesson_name = $ln;
        $this->lesson_description = $ld;
        $this->lesson_video = $lv;
        $this->course_id = $ci;
    }

    /**
     * Get the value of idlesson
     */
    public function getIdLesson()
    {
        return $this->id;
    }

    /**
     * Get the value of CourseName
     */
    public function getLessonName()
    {
        return $this->lesson_name;
    }

    /**
     * Get the value of lessonDesc
     */
    public function getLessonDescription()
    {
        return $this->lesson_description;
    }


    /**
     * Get the value of lessonVideo
     */
    public function getLessonVideo()
    {
        return $this->lesson_video;
    }

    /**
     * Get the value of course id 
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * Set the value of lessonName
     *
     * @return  self
     */
    public function setLessonName($lessonName)
    {
        $this->lesson_name = $lessonName;

        return $this;
    }

    /**
     * Set the value of lessonDescription
     *
     * @return  self
     */
    public function setLessonDescription($lessonDescription)
    {
        $this->lesson_description = $lessonDescription;

        return $this;
    }

    
    /**
     * Set the value of courseImg
     *
     * @return  self
     */
    public function setLessonVideo($lessonVideo)
    {
        $this->lesson_video = $lessonVideo;

        return $this;
    }

    /**
     * Set the value of courseID
     *
     * @return  self
     */
    public function setCourseID($courseId)
    {
        $this->course_id = $courseId;

        return $this;
    }

}


