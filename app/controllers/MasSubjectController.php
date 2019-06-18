<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MasSubjectController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('จัดการข้อมูลคำนำหน้าชื่อ');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new MasSubjectForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MasSubject" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $masSubject = MasSubject::find($parameters);
        $masSubject -> RecordStatus =  'N' ;




        if (count($masSubject) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $masSubject,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->masSubject = $masSubject;
    }

    /**
     * Shows the form to create a new MasClassGroup
     */
    public function newAction()
    {
        $this->view->form = new MasSubjectForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($SubjectID)
    {


        if (!$this->request->isPost()) {

            $massubject = MasSubject::findFirstBySubjectID($SubjectID);
            $new = $massubject -> SubjectVersion ;
            $massubject -> SubjectVersion = $new+1 ;
            if (!$massubject) {
                $this->flash->error("ไม่พบข้อมูลที่เลือก");

                return $this->dispatcher->forward(
                    [
                        "controller" => "masSubject",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new MasSubjectForm($massubject, ['edit' => true]);
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
                    "controller" => "masSubject",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasSubjectForm();
        $massubject = new MasSubject();
        $data = $this->request->getPost();
        $massubject -> CreateUser =   $CreateUserNow  ;
        $massubject -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $massubject)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "new",
                ]
            );
        }

        if ($massubject->save() == false) {
            foreach ($massubject->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลรายวิชาสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubject",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $SubjectID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $ClassLevelID

        $SubjectID = $this->request->getPost("SubjectID", "int");
        $massubject = MasSubject::findFirstBySubjectID($SubjectID);
        if (!$massubject) {
            $this->flash->error("ไม่พบเเลขที่รายวิชา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasSubjectForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $massubject)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "new",
                ]
            );
        }
        $massubject -> LastUser = $LastUserNow ;
        if ($massubject->save() == false) {
            foreach ($massubject->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubject",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $SubjectID
     */
    public function deleteAction($SubjectID)
    {

        $masSubject = MasSubject::findFirstByPrefixNameID($SubjectID);

        if (!$masSubject) {
            $this->flash->error("ไม่พบข้อมูลที่ต้องการลบ");

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "index",
                ]
            );
        }

        $masSubject -> RecordStatus = 'D' ;
        if (!$masSubject->save()) {
            foreach ($masSubject->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masSubject",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masSubject",
                "action"     => "index",
            ]
        );
    }



}
