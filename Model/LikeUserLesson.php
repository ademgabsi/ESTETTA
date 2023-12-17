<?php
class LikeUserLesson
{
    private ?int $id = null;
    private ?int $id_user = null;
    private ?int $id_lesson = null;
    private ?int $status = null;

    public function __construct( $id = null, $id_user, $id_lesson, $status)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_lesson = $id_lesson;
        $this->status = $status;
    }

    /**
     * Get the value of idCourse
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of CourseName
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Get the value of CourseDesc
     */
    public function getIdLesson()
    {
        return $this->id_lesson;
    }


    /**
     * Get the value of CourseAuthor
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set the value of courseName
     *
     * @return  self
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Set the value of courseDescription
     *
     * @return  self
     */
    public function setIdLesson($id_lesson)
    {
        $this->id_lesson = $id_lesson;

        return $this;
    }

    /**
     * Set the value of courseAuthor
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}