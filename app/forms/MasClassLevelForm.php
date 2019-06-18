<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class MasClassLevelForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {


        if (!isset($options['edit'])) {


            $element = new Text("ClassLevelID");
            $this->add($element->setLabel("ClassLevelID"));
        }
        else {
            //Edit ONLY
            $this->add(new Hidden("ClassLevelID"));

        }


        $RecordStatus = new Hidden("RecordStatus");
        $RecordStatus->setDefault('N');
        $this->add($RecordStatus);
        $ClassLevelNameTh = new Text("ClassLevelNameTh");
        $ClassLevelNameTh->setLabel("ชื่อระดับการศึกษา(ภาษาไทย)");
        $ClassLevelNameTh->setFilters(['striptags', 'string']);
        $ClassLevelNameTh->addValidators([
            new PresenceOf([
                'message' => 'กรุณากรอกข้อมูล ชื่อระดับการศึกษา(ภาษาไทย)'
            ])
        ]);

        $this->add($ClassLevelNameTh);

        $ClassLevelNameEn = new Text("ClassLevelNameEn");
        $ClassLevelNameEn->setLabel("ชื่อระดับการศึกษา(ภาษาอังกฤษ)");
        $ClassLevelNameEn->setFilters(['striptags', 'string']);


        $this->add($ClassLevelNameEn);
        $ClassGroupID = new select('ClassGroupID', MasClassGroup::find(['conditions' => 'RecordStatus = "N"']), array('using' => array('ClassGroupID', 'ClassGroupTh'), 'useEmpty' => true));
        $ClassGroupID->setLabel('ช่วงการศึกษา');
        $this->add($ClassGroupID);



        $ClassLevelSorting = new select('ClassLevelSorting', Selective::find(), array('using' => array('selectValue', 'selectNameTh'), 'useEmpty' => true));
        $ClassLevelSorting->setLabel('ลำดับความสำคัญ');

        $this->add($ClassLevelSorting);












    }
}
