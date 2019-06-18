<?php

class Selective extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $selectNameTh;

    /**
     *
     * @var string
     */
    public $selectNameEn;

    /**
     *
     * @var string
     */
    public $selectType;

    /**
     *
     * @var string
     */
    public $selectValue;

    /**
     *
     * @var string
     */
    public $selectDetail;

    /**
     *
     * @var string
     */
    public $recordStatus;

    /**
     *
     * @var string
     */
    public $createDate;

    /**
     *
     * @var string
     */
    public $createBy;

    /**
     *
     * @var string
     */
    public $lastDate;

    /**
     *
     * @var string
     */
    public $lastBy;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("exam");
        $this->setSource("selective");
        $this->hasMany(

            'SelectValue' , 'SchoolStudent','Sex' , ['alias' => 'SchoolStudent']


        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'selective';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Selective[]|Selective|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Selective|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
