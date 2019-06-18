<?php
use Phalcon\Mvc\Model;

class MasSubjectGroup extends Model
{

    /**
     *
     * @var integer
     */
    public $SubjectGroupID;

    /**
     *
     * @var string
     */
    public $SubjectGroupNameTh;

    /**
     *
     * @var string
     */
    public $SubjectGroupNameEn;

    /**
     *
     * @var string
     */
    public $SubjectGroupDetail;


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
        $this->setSource("mas_subject_group");
        $this->hasMany(

            'SubjectGroupID' , 'MasSubjectForm','SubjectGroupID' , ['alias' => 'MasSubjectForm']


        );


    }


}
