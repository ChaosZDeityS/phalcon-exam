<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class SchoolCourseForm extends Form
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
            $this->add(new Hidden("CourseID"));

        }


        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);

        $CourseNameTh = new Text("CourseNameTh");
        $CourseNameTh->setLabel("ชื่อหลักสูตร(Th)");
        $CourseNameTh->setFilters(['striptags', 'string']);
        $CourseNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อหลักสูตร(Th)'
            ])
        ]);

        $this->add($CourseNameTh);

        $CourseNameEn = new Text("CourseNameEn");
        $CourseNameEn->setLabel("ชื่อหลักสูตร(En)");
        $CourseNameEn->setFilters(['striptags', 'string']);

        $this->add($CourseNameEn);

        $CourseDetail = new Text("CourseDetail");
        $CourseDetail->setLabel("รายละเอียด");
        $CourseDetail->setFilters(['striptags', 'string']);

        $this->add($CourseDetail);















    }
}
