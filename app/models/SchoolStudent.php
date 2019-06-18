<?php
use Phalcon\Mvc\Model;

class SchoolStudent extends Model
{

    /**
     *
     * @var integer
     */
    public $StudentID;

    /**
     *
     * @var integer
     */
    public $AdmitYear;

    /**
     *
     * @var string
     */
    public $StudentCode;

    /**
     *
     * @var integer
     */
    public $StudentPID;

    /**
     *
     * @var integer
     */
    public $PrefixNameID;

    /**
     *
     * @var string
     */
    public $FirstNameTh;

    /**
     *
     * @var string
     */
    public $LastNameTh;

    /**
     *
     * @var string
     */
    public $FirstNameEn;

    /**
     *
     * @var string
     */
    public $LastNameEn;

    /**
     *
     * @var integer
     */
    public $CourseID;


    /**
     *
     * @var string
     */
    public $Sex;


    /**
     *
     * @var string
     */
    public $Birthday;

    /**
     *
     * @var string
     */
    public $Note;

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
        $this->setSource("school_student");
        $this->belongsTo('PrefixNameID','MasPrefixName','PrefixNameID',[
            'reusable' => true
        ]);
        $this->belongsTo('CourseID','SchoolCourse','CourseID',[
        'reusable' => true
       ]);
        $this->belongsTo('Sex','Selective','selectValue',[
            'reusable' => true
        ]);

    }


}
