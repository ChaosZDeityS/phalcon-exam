<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SchoolStudentController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('จัดการข้อมูลนักเรียน');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new SchoolStudentForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "SchoolStudent" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $schoolStudent = SchoolStudent::find($parameters);
        $schoolStudent -> RecordStatus =  'N' ;




        if (count($schoolStudent) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $schoolStudent,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->schoolStudent = $schoolStudent;
    }

    /**
     * Shows the form to create a new $schoolCourse
     */
    public function newAction()
    {
        $this->view->form = new SchoolStudentForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($StudentID)
    {


        if (!$this->request->isPost()) {

            $schoolstudent = SchoolStudent::findFirstByStudentID($StudentID);
            if (!$schoolstudent) {
                $this->flash->error("ไม่พบข้อมูล");

                return $this->dispatcher->forward(
                    [
                        "controller" => "schoolStudent",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new SchoolStudentForm($schoolstudent, ['edit' => true]);
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
                    "controller" => "schoolStudent",
                    "action"     => "index",
                ]
            );
        }

        $form = new SchoolStudentForm();
        $schoolstudent = new SchoolStudent();
        $data = $this->request->getPost();
        $schoolstudent -> CreateUser =   $CreateUserNow  ;
        $schoolstudent -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $schoolstudent)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "new",
                ]
            );
        }

        if ($schoolstudent->save() == false) {
            foreach ($schoolstudent->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "schoolStudent",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $StudentID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $CourseID

        $StudentID = $this->request->getPost("StudentID", "int");
        $schoolstudent = SchoolStudent::findFirstByStudentID($StudentID);
        if (!$schoolstudent) {
            $this->flash->error("ไม่พบเเลขที่นักเรียน");

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "index",
                ]
            );
        }

        $form = new SchoolStudentForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $schoolstudent)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "new",
                ]
            );
        }
        $schoolstudent -> LastUser = $LastUserNow ;
        if ($schoolstudent->save() == false) {
            foreach ($schoolstudent->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "schoolStudent",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $StudentID
     */
    public function deleteAction($StudentID)
    {

        $schoolStudent = SchoolStudent::findFirstByStudentID($StudentID);

        if (!$schoolStudent) {
            $this->flash->error("ไม่พบข้อมูล");

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "index",
                ]
            );
        }

        $schoolStudent -> RecordStatus = 'D' ;
        if (!$schoolStudent->save()) {
            foreach ($schoolStudent->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolStudent",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "schoolStudent",
                "action"     => "index",
            ]
        );
    }



}
