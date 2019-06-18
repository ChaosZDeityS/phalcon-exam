<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


class MasClassGroupForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {


        if (!isset($options['edit'])) {


            $element = new Text("ClassGroupID");
            $this->add($element->setLabel("เลขที่ช่วงชั้น"));

        }
        else {
            //Edit ONLY
            $this->add(new Hidden("ClassGroupID"));



        }
        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);
        $ClassGroupTh = new Text("ClassGroupTh");
        $ClassGroupTh->setLabel("ช่วงชั้น(Th)");
        $ClassGroupTh->setFilters(['striptags', 'string']);
        $ClassGroupTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกชื่อช่วงชั้นภาษาไทย'
            ])
        ]);

        $this->add($ClassGroupTh);

        $ClassGroupEn = new Text("ClassGroupEn");
        $ClassGroupEn->setLabel("ช่วงชั้น(En)");
        $ClassGroupEn->setFilters(['striptags', 'string']);
        $ClassGroupEn->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกช่วงชั้น (En)'
            ])
        ]);

        $this->add($ClassGroupTh);


//        $ClassGroupSorting = new select('ClassGroupSorting', Selective::find(['condition' =>  'selectType LIKE "Sorting"']), array('using' => array('selectValue', 'selectNameTh' ,), 'useEmpty' => false));
        $ClassGroupSorting = new select('ClassGroupSorting', Selective::find(), array('using' => array('selectValue', 'selectNameTh'), 'useEmpty' => true));
        $ClassGroupSorting->setLabel("ลำดับความสำคัญ");

        $ClassGroupSorting->addValidators([
            new PresenceOf([
                'message' => 'กรุณาเเลือกลำดับความสำคัญ'
            ])

        ]);
        $this->add($ClassGroupSorting);














    }
}
