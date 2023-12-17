<?php
class Forum
{
    private ?int $id = null;
    private ?int $id_user = null;
    private ?string $title = null;
    private ?string $content = null;

    public function __construct($id = null, $id_user, $title, $content)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->title = $title;
        $this->content = $content;
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
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Get the value of CourseAuthor
     */
    public function getContent()
    {
        return $this->content;
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
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the value of courseAuthor
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}