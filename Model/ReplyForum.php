<?php
class ReplyForum
{
    private ?int $id = null;
    private ?int $id_user = null;
    private ?int $id_forum = null;
    private ?string $content = null;

    public function __construct($id = null, $id_user,$id_forum, $content)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_forum = $id_forum;
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
    public function getIdForum()
    {
        return $this->id_forum;
    }

    /**
     * Get the value of CourseName
     */
    public function getIdUser()
    {
        return $this->id_user;
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
     * Set the value of courseName
     *
     * @return  self
     */
    public function setIdForum($id_forum)
    {
        $this->id_forum = $id_forum;

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