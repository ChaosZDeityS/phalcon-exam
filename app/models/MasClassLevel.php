<?php
use Phalcon\Mvc\Model;

class MasClassLevel extends Model
{

    /**
     *
     * @var integer
     */
    public $ClassLevelID;

    /**
     *
     * @var integer
     */
    public $ClassGroupID;

    /**
     *
     * @var string
     */
    public $ClassLevelNameTh;

    /**
     *
     * @var string
     */
    public $ClassLevelNameEn;

    /**
     *
     * @var integer
     */
    public $ClassLevelSorting;

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
        $this->setSource("mas_class_level");
        $this->belongsTo('ClassGroupID','MasClassGroup','ClassGroupID',[
            'reusable' => true
        ]);

    }

//    /**
//     * Returns table name mapped in the model.
//     *
//     * @return string
//     */
//    public function getSource()
//    {
//        return 'mas_class_level';
//    }
//
//    /**
//     * Allows to query a set of records that match the specified conditions
//     *
//     * @param mixed $parameters
//     * @return MasClassLevel[]|MasClassLevel|\Phalcon\Mvc\Model\ResultSetInterface
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
//     * @return MasClassLevel|\Phalcon\Mvc\Model\ResultInterface
//     */
//    public static function findFirst($parameters = null)
//    {
//        return parent::findFirst($parameters);
//    }

}
