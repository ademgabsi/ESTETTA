<?php
class Course
{
    private ?int $id = null;
    private ?string $course_name = null;
    private ?string $course_desc = null;
    private ?string $course_author = null;
    private ?string $course_img = null;
    private ?int $course_duration = null;
    private ?int $author_id = null;

    public function __construct($id = null, $cn, $cds, $ca, $ci, $cd, $ai)
    {
        $this->id = $id;
        $this->course_name = $cn;
        $this->course_desc = $cds;
        $this->course_author = $ca;
        $this->course_img = $ci;
        $this->course_duration = $cd;
        $this->author_id = $ai;
    }

    /**
     * Get the value of idCourse
     */
    public function getIdCourse()
    {
        return $this->id;
    }

    /**
     * Get the value of CourseName
     */
    public function getCourseName()
    {
        return $this->course_name;
    }

    /**
     * Get the value of CourseDesc
     */
    public function getCourseDesc()
    {
        return $this->course_desc;
    }


    /**
     * Get the value of CourseAuthor
     */
    public function getCourseAuthor()
    {
        return $this->course_author;
    }

    /**
     * Get the value of Course_img
     */
    public function getCourseImg()
    {
        return $this->course_img;
    }

    /**
     * Get the value of CourseDuration
     */
    public function getCourseDuration()
    {
        return $this->course_duration;
    }
    public function getAuthorId()
    {
        return $this->author_id;
    }


    /**
     * Set the value of courseName
     *
     * @return  self
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * Set the value of courseName
     *
     * @return  self
     */
    public function setCourseName($courseName)
    {
        $this->course_name = $courseName;

        return $this;
    }

    /**
     * Set the value of courseDescription
     *
     * @return  self
     */
    public function setCourseDescription($courseDescription)
    {
        $this->course_desc = $courseDescription;

        return $this;
    }

    /**
     * Set the value of courseAuthor
     *
     * @return  self
     */
    public function setCourseAuthor($courseAuthor)
    {
        $this->course_author = $courseAuthor;

        return $this;
    }

    /**
     * Set the value of courseImg
     *
     * @return  self
     */
    public function setCourseImg($courseImg)
    {
        $this->course_img = $courseImg;

        return $this;
    }

    /**
     * Set the value of courseDuration
     *
     * @return  self
     */
    public function setCourseDuration($courseDuration)
    {
        $this->course_duration = $courseDuration;

        return $this;
    }

}
