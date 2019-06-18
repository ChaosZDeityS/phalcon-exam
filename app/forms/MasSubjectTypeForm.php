<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class MasSubjectTypeForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {


        if (!isset($options['edit'])) {




        }
        else {






            $this->add(new Hidden("SubjectTypeID"));

        }




        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);

        $SubjectTypeNameTh = new Text("SubjectTypeNameTh");
        $SubjectTypeNameTh->setLabel("ชื่อประเภทรายวิชา(Th)");
        $SubjectTypeNameTh->setFilters(['striptags', 'string']);
        $SubjectTypeNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อประเภทรายวิชา(Th)'
            ])
        ]);

        $this->add($SubjectTypeNameTh);

        $SubjectTypeNameEn = new Text("SubjectTypeNameEn");
        $SubjectTypeNameEn->setLabel("ชื่อประเภทรายวิชา(En)");
        $SubjectTypeNameEn->setFilters(['striptags', 'string']);
//        $SubjectTypeNameEn->addValidators([
//            new PresenceOf([
//                'message' => 'กรุณากรอกข้อมูล ชื่อกลุ่มสาระวิชา(En)'
//            ])
//        ]);

        $this->add($SubjectTypeNameEn);

        $SubjectTypeDetail = new Text("SubjectTypeDetail");
        $SubjectTypeDetail->setLabel("รายละเอียด");
        $SubjectTypeDetail->setFilters(['striptags', 'string']);
        $this->add($SubjectTypeDetail);











    }
}
