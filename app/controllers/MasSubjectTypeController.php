<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MasSubjectTypeController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('จัดการข้อมูลประเภทรายวิชา');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new MasSubjectTypeForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MasSubjectType" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $masSubjectType = MasSubjectType::find($parameters);
        $masSubjectType -> RecordStatus =  'N' ;




        if (count($masSubjectType) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $masSubjectType,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->masSubjectType = $masSubjectType;
    }

    /**
     * Shows the form to create a new MasClassGroup
     */
    public function newAction()
    {
        $this->view->form = new MasSubjectTypeForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($SubjectTypeID)
    {


        if (!$this->request->isPost()) {

            $massubjecttype = MasSubjectType::findFirstBySubjectTypeID($SubjectTypeID);
            if (!$massubjecttype) {
                $this->flash->error("ไม่พบฐานข้อมูล");

                return $this->dispatcher->forward(
                    [
                        "controller" => "masSubjectType",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new MasSubjectTypeForm($massubjecttype, ['edit' => true]);
        }
    }

    /**
     * Creates a new company
     */
    public function createAction()
    {
        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $CreateUserNow = $user->username ;
        $LastUserNow = $user->username ;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasSubjectTypeForm();
        $massubjecttype = new MasSubjectType();
        $data = $this->request->getPost();
        $massubjecttype -> CreateUser =   $CreateUserNow  ;
        $massubjecttype -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $massubjecttype)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "new",
                ]
            );
        }

        if ($massubjecttype->save() == false) {
            foreach ($massubjecttype->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubjectType",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $SubjectTypeID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $ClassLevelID

        $SubjectTypeID = $this->request->getPost("SubjectTypeID", "int");
        $massubjecttype = MasSubjectType::findFirstBySubjectTypeID($SubjectTypeID);
        if (!$massubjecttype) {
            $this->flash->error("ไม่พบข้อมูล");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasSubjectTypeForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $massubjecttype)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "new",
                ]
            );
        }
        $massubjecttype -> LastUser = $LastUserNow ;
        if ($massubjecttype->save() == false) {
            foreach ($massubjecttype->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubjectType",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $SubjectTypeID
     */
    public function deleteAction($SubjectTypeID)
    {

        $masSubjectType = MasSubjectType::findFirstBySubjectTypeID($SubjectTypeID);

        if (!$masSubjectType) {
            $this->flash->error("ไม่พบข้อมูล");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "index",
                ]
            );
        }

        $masSubjectType -> RecordStatus = 'D' ;
        if (!$masSubjectType->save()) {
            foreach ($masSubjectType->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectType",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubjectType",
                "action"     => "index",
            ]
        );
    }



}
