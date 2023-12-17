<?php
class Comment
{
    private ?int $id = null;
    private ?int $id_user = null;
    private ?int $id_lesson = null;
    private ?string $comment = null;
    private ?string $date = null;

    public function __construct($id = null, $id_user, $id_lesson, $comment, $date)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_lesson = $id_lesson;
        $this->comment = $comment;
        $this->date = $date;
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
    public function getComment()
    {
        return $this->comment;
    }
    public function getDate()
    {
        return $this->date;
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
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Set the value of courseAuthor
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}