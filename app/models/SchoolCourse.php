<?php
use Phalcon\Mvc\Model;

class SchoolCourse extends Model
{

    /**
     *
     * @var integer
     */
    public $CourseID;

    /**
     *
     * @var string
     */
    public $CourseNameTh;

    /**
     *
     * @var string
     */
    public $CourseNameEn;

    /**
     *
     * @var string
     */
    public $CourseDetail;



    /**
     *
     * @var string
     */
    public $RecordStatus;

    /**
     *
     * @var string
     */
    public $CreateDate;

    /**
     *
     * @var string
     */
    public $CreateUser;

    /**
     *
     * @var string
     */
    public $LastDate;

    /**
     *
     * @var string
     */
    public $LastUser;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("exam");
        $this->setSource("school_course");
        $this->hasMany(

            'CourseID' , 'SchoolStudent','SubjectTypeID' , ['alias' => 'SchoolStudent']


        );


    }


}
