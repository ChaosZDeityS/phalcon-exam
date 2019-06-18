<?php
use Phalcon\Mvc\Model;

class MasClassGroup extends Model
{

    /**
     *
     * @var integer
     */
    public $ClassGroupID;

    /**
     *
     * @var string
     */
    public $ClassGroupTh;

    /**
     *
     * @var string
     */
    public $ClassGroupEn;

    /**
     *
     * @var integer
     */
    public $ClassGroupSorting;

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
        $this->setSource("mas_class_group");
        $this->hasMany(

                'ClassGroupID' , 'MasClassLevel','ClassGroupID' , ['alias' => 'masClassGroup']


        );
//        $this->belongsTo('ClassGroupID','MasClassLevel','ClassGroupID');



    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
//    public function getSource()
//    {
//        return 'mas_class_group';
//    }
//
//    /**
//     * Allows to query a set of records that match the specified conditions
//     *
//     * @param mixed $parameters
//     * @return MasClassGroup[]|MasClassGroup|\Phalcon\Mvc\Model\ResultSetInterface
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
//     * @return MasClassGroup|\Phalcon\Mvc\Model\ResultInterface
//     */
//    public static function findFirst($parameters = null)
//    {
//        return parent::findFirst($parameters);
//    }

}
