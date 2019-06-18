<?php
use Phalcon\Mvc\Model;

class MasSubject extends Model
{

    /**
     *
     * @var integer
     */
    public $SubjectID;

    /**
     *
     * @var integer
     */
    public $SubjectCode;

    /**
     *
     * @var integer
     */
    public $SubjectVersion;

    /**
     *
     * @var string
     */
    public $SubjectNameTh;

    /**
     *
     * @var string
     */
    public $SubjectNameEn;

    /**
     *
     * @var string
     */
    public $SubjectDetail;
    /**
     *
     * @var integer
     */
    public $SubjectGroupID;

    /**
     *
     * @var integer
     */
    public $SubjectTypeID;

    /**
     *
     * @var float
     */
    public $SubjectCredit;

    /**
     *
     * @var integer
     */
    public $SubjectLearn;


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
        $this->setSource("mas_subject");
        $this->belongsTo('SubjectTypeID','MasSubjectType','SubjectTypeID',[
            'reusable' => true
        ]);
        $this->belongsTo('SubjectGroupID','MasSubjectGroup','SubjectGroupID',[
            'reusable' => true
        ]);


    }


}
