<?php
use Phalcon\Mvc\Model;

class MasPrefixName extends Model
{

    /**
     *
     * @var integer
     */
    public $PrefixNameID;

    /**
     *
     * @var integer
     */
    public $PrefixNameTh;

    /**
     *
     * @var string
     */
    public $PrefixNameEn;

    /**
     *
     * @var string
     */
    public $InitialsTh;

    /**
     *
     * @var string
     */
    public $InitialsEn;

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
        $this->setSource("mas_prefix_name");
        $this->hasMany(

            'PrefixNameID' , 'SchoolStudent','PrefixNameID' , ['alias' => 'SchoolStudent']


        );


    }


}
