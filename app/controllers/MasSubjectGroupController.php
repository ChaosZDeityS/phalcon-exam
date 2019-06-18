<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MasSubjectGroupController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('จัดการข้อมูลกลุ่มสาระวิชา');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new MasSubjectGroupForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MasSubjectGroup" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $masSubjectGroup = MasSubjectGroup::find($parameters);
        $masSubjectGroup -> RecordStatus =  'N' ;




        if (count($masSubjectGroup) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $masSubjectGroup,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->masSubjectGroup = $masSubjectGroup;
    }

    /**
     * Shows the form to create a new MasClassGroup
     */
    public function newAction()
    {
        $this->view->form = new MasSubjectGroupForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($SubjectGroupID)
    {


        if (!$this->request->isPost()) {

            $massubjectgroup = MasSubjectGroup::findFirstBySubjectGroupID($SubjectGroupID);
            if (!$massubjectgroup) {
                $this->flash->error("ไม่พบฐานข้อมูลกลุ่มสาระวิชา");

                return $this->dispatcher->forward(
                    [
                        "controller" => "masSubjectGroup",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new MasSubjectGroupForm($massubjectgroup, ['edit' => true]);
        }
    }

    /**
     * Creates a new
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
                    "controller" => "masSubjectGroup",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasSubjectGroupForm();
        $massubjectgroup = new MasSubjectGroup();
        $data = $this->request->getPost();
        $massubjectgroup -> CreateUser =   $CreateUserNow  ;
        $massubjectgroup -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $massubjectgroup)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "new",
                ]
            );
        }

        if ($massubjectgroup->save() == false) {
            foreach ($massubjectgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลกลุ่มสาระวิชาสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubjectGroup",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $SubjectGroupID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $ClassLevelID

        $SubjectGroupID = $this->request->getPost("SubjectGroupID", "int");
        $massubjectgroup = MasSubjectGroup::findFirstBySubjectGroupID($SubjectGroupID);
        if (!$massubjectgroup) {
            $this->flash->error("ไม่พบข้อมูล");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasSubjectGroupForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $massubjectgroup)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "new",
                ]
            );
        }
        $massubjectgroup -> LastUser = $LastUserNow ;
        if ($massubjectgroup->save() == false) {
            foreach ($massubjectgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubjectGroup",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $SubjectGroupID
     */
    public function deleteAction($SubjectGroupID)
    {

        $masSubjectGroup = MasSubjectGroup::findFirstBySubjectGroupID($SubjectGroupID);

        if (!$masSubjectGroup) {
            $this->flash->error("ไม่พบข้อมูล");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "index",
                ]
            );
        }

        $masSubjectGroup -> RecordStatus = 'D' ;
        if (!$masSubjectGroup->save()) {
            foreach ($masSubjectGroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubjectGroup",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubjectGroup",
                "action"     => "index",
            ]
        );
    }



}
