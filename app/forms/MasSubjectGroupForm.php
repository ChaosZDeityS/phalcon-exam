<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class MasSubjectGroupForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {


        if (!isset($options['edit'])) {





        }
        else {
            //Edit ONLY






            $this->add(new Hidden("SubjectGroupID"));

        }




        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);

        $SubjectGroupNameTh = new Text("SubjectGroupNameTh");
        $SubjectGroupNameTh->setLabel("ชื่อกลุ่มสาระวิชา(Th)");
        $SubjectGroupNameTh->setFilters(['striptags', 'string']);
        $SubjectGroupNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อกลุ่มสาระวิชา(Th)'
            ])
        ]);

        $this->add($SubjectGroupNameTh);

        $SubjectGroupNameEn = new Text("SubjectGroupNameEn");
        $SubjectGroupNameEn->setLabel("ชื่อกลุ่มสาระวิชา(En)");
        $SubjectGroupNameEn->setFilters(['striptags', 'string']);
//        $SubjectGroupNameEn->addValidators([
//            new PresenceOf([
//                'message' => 'กรุณากรอกข้อมูล ชื่อกลุ่มสาระวิชา(En)'
//            ])
//        ]);

        $this->add($SubjectGroupNameEn);

        $SubjectGroupDetail = new Text("SubjectGroupDetail");
        $SubjectGroupDetail->setLabel("รายละเอียด");
        $SubjectGroupDetail->setFilters(['striptags', 'string']);
        $this->add($SubjectGroupDetail);











    }
}
