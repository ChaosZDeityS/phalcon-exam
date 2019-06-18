<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\File ;
use Phalcon\Image\Factory;
use Phalcon\Http\Request;
use Phalcon\Forms\ElementInterface;
//



class TeacherForm extends Form
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
            $this->add(new Hidden("TeacherID"));

        }


        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);


        $TeacherCode = new Text("TeacherCode");
        $TeacherCode->setLabel("รหัสอาจารย์");
        $TeacherCode->setFilters(['striptags', 'string']);
        $this->add($TeacherCode);

        $Photo = new File('Photo'); $this->add($Photo);
        $Photo->setLabel("รูปภาพ");



        $PrefixNameID = new select('PrefixNameID', MasPrefixName::find(['conditions' => 'RecordStatus = "N"']), array('using' => array('PrefixNameID', 'PrefixNameTh'), 'useEmpty' => true));
        $PrefixNameID->setLabel('คำนำหน้าชื่อ');
        $this->add($PrefixNameID);


        $FirstName = new Text("FirstName");
        $FirstName->setLabel("ชื่อ");
        $FirstName->setFilters(['striptags', 'string']);
        $FirstName->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อ(Th)'
            ])
        ]);

        $this->add($FirstName);

        $LastName = new Text("LastName");
        $LastName->setLabel("นามสกุล");
        $LastName->setFilters(['striptags', 'string']);
        $LastName->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล นามสกุล(Th)'
            ])
        ]);
        $this->add($LastName);

//        $Photo -> setLabel();
//        $this->tag->fileField(["imageFile", "size" => 30, "class" => "form-control", "id" => "Photo"]) ;

        $Address = new TextArea("Address");
        $Address->setLabel("ที่อยู่");
        $Address->setFilters(['striptags', 'string']);
//        $Address->addValidators([
//            new PresenceOf([
//                'message' => 'กรุณาระบุที่อยู่'
//            ])
//        ]);

        $this->add($Address);

        $Phone = new Text("Phone");
        $Phone->setLabel("เบอร์ติดต่อ");
        $Phone->setFilters(['striptags', 'string']);
        $Phone->addValidators([
            new PresenceOf([
                'message' => 'กรุณาระบุเบอร์ติดต่อ'
            ])
        ]);
        $this->add($Phone);

        $Email = new Text("Email");
        $Email->setLabel("อีเมล");
        $Email->setFilters(['striptags', 'string']);
        $Email->addValidators([
            new Email([
                'message' => 'กรุณากรอกอีเมลล์ให้ถูกต้อง'
            ])
        ]);
        $this->add($Email);





        $Note = new TextArea("Note");
        $Note->setLabel("หมายเหตุ");
        $Note->setFilters(['striptags', 'string']);
        $this->add($Note);





//        $ClassGroupID = new select('ClassGroupID', MasClassGroup::find(), array('using' => array('ClassGroupID', 'ClassGroupTh'), 'useEmpty' => true));
//        $ClassGroupID->setLabel('ช่วงการศึกษา');
//        $this->add($ClassGroupID);


//        $Sex = new select('Sex', Selective::find(['Conditions' => 'selectType = "Sex" ']), array('using' => array('SelectValue', 'SelectNameTh'), 'useEmpty' => true));













    }
}
