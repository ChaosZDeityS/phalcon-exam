<?php
use Phalcon\Mvc\Model;

class MasSubjectType extends Model
{

    /**
     *
     * @var integer
     */
    public $SubjectTypeID;

    /**
     *
     * @var integer
     */
    public $SubjectTypeNameTh;

    /**
     *
     * @var string
     */
    public $SubjectTypeNameEn;

    /**
     *
     * @var string
     */
    public $SubjectTypeDetail;


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
        $this->setSource("mas_subject_type");
        $this->hasMany(

            'SubjectTypeID' , 'MasSubjectForm','SubjectTypeID' , ['alias' => 'MasSubjectForm']


        );


    }


}
