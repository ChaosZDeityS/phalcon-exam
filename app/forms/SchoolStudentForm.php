<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;


class SchoolStudentForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {


        if (!isset($options['edit'])) {


//            $element = new Text("StudentID");
//            $this->add($element->setLabel("StudentID"));
        }
        else {
            //Edit ONLY
            $this->add(new Hidden("StudentID"));

        }


        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);


        $StudentCode = new Numeric("StudentCode");
        $StudentCode->setLabel("รหัสนักเรียน");
        $StudentCode->setFilters(['striptags', 'int']);
        $this->add($StudentCode);



        $AdmitYear = new Text("AdmitYear");
        $AdmitYear->setLabel("ปีที่เข้าศึกษา");
        $AdmitYear->setFilters(['striptags', 'int']);
        $AdmitYear->setAttributes(['onkeypress' => "return validatenumerics(event);",'maxLength' => 4 ]);
        $AdmitYear->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกปีที่เข้าศึกษา'
            ])
        ]);
        $this->add($AdmitYear);

        $CourseID = new select('CourseID', SchoolCourse::find(['conditions' => 'RecordStatus = "N"']), array('using' => array('CourseID', 'CourseNameTh'), 'useEmpty' => true));
        $CourseID->setLabel('หลักสูตร');
        $this->add($CourseID);


        $PrefixNameID = new select('PrefixNameID', MasPrefixName::find(['conditions' => 'RecordStatus = "N"']), array('using' => array('PrefixNameID', 'PrefixNameTh'), 'useEmpty' => true));
        $PrefixNameID->setLabel('คำนำหน้าชื่อ');
        $this->add($PrefixNameID);


        $FirstNameTh = new Text("FirstNameTh");
        $FirstNameTh->setLabel("ชื่อ(Th)");
        $FirstNameTh->setFilters(['striptags', 'string']);
        $FirstNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อ(Th)'
            ])
        ]);

        $this->add($FirstNameTh);

        $LastNameTh = new Text("LastNameTh");
        $LastNameTh->setLabel("นามสกุล(Th)");
        $LastNameTh->setFilters(['striptags', 'string']);
        $LastNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล นามสกุล(Th)'
            ])
        ]);
        $this->add($LastNameTh);

        $FirstNameEn = new Text("FirstNameEn");
        $FirstNameEn->setLabel("ชื่อ(En)");
        $FirstNameEn->setFilters(['striptags', 'string']);
        $FirstNameEn->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อ(En)'
            ])
        ]);

        $this->add($FirstNameEn);

        $LastNameEn = new Text("LastNameEn");
        $LastNameEn->setLabel("นามสกุล(En)");
        $LastNameEn->setFilters(['striptags', 'string']);
        $LastNameEn->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล นามสกุล(En)'
            ])
        ]);
        $this->add($LastNameEn);



        $Sex = new select('Sex', Selective::find(['conditions' => 'selectType = "Sex" ']), array('using' => array('selectValue', 'selectNameTh'), 'useEmpty' => true));
        $Sex->setLabel('เพศ');
        $this->add($Sex);


        $Birthday = new Date("Birthday");
        $Birthday->setLabel("วันเดือนปีเกิด");
        $Birthday->setFilters(['striptags', 'string']);
        $Birthday->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกวันเดือนปีเกิด'
            ])
        ]);
        $this->add($Birthday);

        $Note = new Text("Note");
        $Note->setLabel("หมายเหตุ");
        $Note->setFilters(['striptags', 'string']);
        $this->add($Note);

















    }
}
