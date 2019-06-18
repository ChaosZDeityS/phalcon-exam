<?php

class Teacher extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $TeacherID;

    /**
     *
     * @var string
     */
    public $TeacherPID;

    /**
     *
     * @var string
     */
    public $TeacherCode;

    /**
     *
     * @var integer
     */
    public $PrefixNameID;

    /**
     *
     * @var string
     */
    public $FirstName;

    /**
     *
     * @var string
     */
    public $LastName;

    /**
     *
     * @var string
     */
    public $Address;

    /**
     *
     * @var string
     */
    public $Phone;

    /**
     *
     * @var string
     */
    public $Email;

    /**
     *
     * @var string
     */
    public $Photo;

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
        $this->setSource("teacher");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'teacher';
    }
//
//    /**
//     * Allows to query a set of records that match the specified conditions
//     *
//     * @param mixed $parameters
//     * @return Teacher[]|Teacher|\Phalcon\Mvc\Model\ResultSetInterface
//     */
//    public static function find($parameters = null)
//    {
//        return parent::find($parameters);
//    }
//
//    /**
//     * Allows to query the first record that match the specified conditions
//     *
//     * @param mixed $parameters
//     * @return Teacher|\Phalcon\Mvc\Model\ResultInterface
//     */
//    public static function findFirst($parameters = null)
//    {
//        return parent::findFirst($parameters);
//    }

}
