<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class MasPrefixNameForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {


        if (!isset($options['edit'])) {


//            $element = new Text("PrefixNameID");
//            $this->add($element->setLabel("เลขที่คำนำหน้าชื่อ"));
        }
        else {
            //Edit ONLY
            $this->add(new Hidden("PrefixNameID"));

        }


        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);

        $PrefixNameTh = new Text("PrefixNameTh");
        $PrefixNameTh->setLabel("คำนำหน้าชื่อ(Th)");
        $PrefixNameTh->setFilters(['striptags', 'string']);
        $PrefixNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อระดับการศึกษา(ภาษาไทย)'
            ])
        ]);

        $this->add($PrefixNameTh);

        $InitialsTh = new Text("InitialsTh");
        $InitialsTh->setLabel("คำนำหน้าชื่อแบบย่อ(Th)");
        $InitialsTh->setFilters(['striptags', 'string']);
        $InitialsTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกคำนำหน้าชื่อแบบย่อ(Th)'
            ])
        ]);
        $this->add($InitialsTh);

        $PrefixNameEn = new Text("PrefixNameEn");
        $PrefixNameEn->setLabel("คำนำหน้าชื่อ(En)");
        $PrefixNameEn->setFilters(['striptags', 'string']);
        $this->add($PrefixNameEn);



        $InitialsEn = new Text("InitialsEn");
        $InitialsEn->setLabel("คำนำหน้าชื่อแบบย่อ(En)");
        $InitialsEn->setFilters(['striptags', 'string']);
//        $InitialsEn->addValidators([
//            new PresenceOf([
//                'message' => 'กรุณากรอกคำนำหน้าชื่อ(En)'
//            ])
//        ]);
        $this->add($InitialsEn);
















    }
}
