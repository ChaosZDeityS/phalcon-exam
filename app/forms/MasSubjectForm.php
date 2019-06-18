<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Numeric;

class MasSubjectForm extends Form
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
            $this->add(new Hidden("SubjectID"));
            $this->add(new Hidden("SubjectVersion"));


        }


        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);

        $SubjectCode = new Text("SubjectCode");
        $SubjectCode->setLabel("รหัสวิชา");
        $SubjectCode->setFilters(['striptags', 'string']);
        $SubjectCode->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชหัสวิชา'
            ])
        ]);
        $this->add($SubjectCode);

        $SubjectNameTh = new Text("SubjectNameTh");
        $SubjectNameTh->setLabel("ชื่อวิชา(Th)");
        $SubjectNameTh->setFilters(['striptags', 'string']);
        $SubjectNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อวิชา(Th)'
            ])
        ]);
        $this->add($SubjectNameTh);

        $SubjectNameEn = new Text("SubjectNameEn");
        $SubjectNameEn->setLabel("ชื่อวิชา(En)");
        $SubjectNameEn->setFilters(['striptags', 'string']);
//        $SubjectNameEn->addValidators([
//            new PresenceOf([
//                'message' => 'กรุณากรอกข้อมูล ชื่อวิชา(En)'
//            ])
//        ]);
        $this->add($SubjectNameEn);

        $SubjectDetail = new Text("SubjectDetail");
        $SubjectDetail->setLabel("รายละเอียด");
        $SubjectDetail->setFilters(['striptags', 'string']);
        $this->add($SubjectDetail);


        $SubjectGroupID = new select('SubjectGroupID', MasSubjectGroup::find(['conditions' => 'RecordStatus = "N"']), array('using' => array('SubjectGroupID', 'SubjectGroupNameTh'), 'useEmpty' => true));
        $SubjectGroupID->setLabel('กลุ่มสาระวิชา');
        $this->add($SubjectGroupID);

        $SubjectTypeID = new select('SubjectTypeID', MasSubjectType::find(['conditions' => 'RecordStatus = "N"']), array('using' => array('SubjectTypeID', 'SubjectTypeNameTh'), 'useEmpty' => true));
        $SubjectTypeID->setLabel('ประเภทรายวิชา');
        $this->add($SubjectTypeID);

        $SubjectCredit = new Numeric("SubjectCredit");
        $SubjectCredit->setLabel("หน่วยกิต");
        $SubjectCredit->setFilters(['striptags', 'int']);
        $SubjectCredit->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูลหน่วยกิตให้ถูกต้อง'
            ])
        ]);
        $this->add($SubjectCredit);

        $SubjectLearn = new Numeric("SubjectLearn");
        $SubjectLearn->setLabel("จำนวนชั่วโมงเรียน");
        $SubjectLearn->setFilters(['striptags', 'int']);
        $SubjectLearn->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูลจำนวนชั่วโมงเรียนให้ถูกต้อง'
            ])
        ]);
        $this->add($SubjectLearn);






















    }
}
