<?php
class User
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?int $role = null;
    private ?string $image = null;
    private ?string $password = null;

    public function __construct($id = null, $name, $email, $role, $image, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->image = $image;
        $this->password = $password;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of CourseDesc
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Get the value of CourseAuthor
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the value of Course_img
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the value of CourseDuration
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Set the value of courseName
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of courseName
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of courseDescription
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of courseAuthor
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Set the value of courseImg
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Set the value of courseDuration
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
