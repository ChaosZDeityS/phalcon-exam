<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SchoolCourseController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('จัดการหลักสูตร');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new SchoolCourseForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "SchoolCourse" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $schoolCourse = SchoolCourse::find($parameters);
        $schoolCourse -> RecordStatus =  'N' ;




        if (count($schoolCourse) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $schoolCourse,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->schoolCourse = $schoolCourse;
    }

    /**
     * Shows the form to create a new $schoolCourse
     */
    public function newAction()
    {
        $this->view->form = new SchoolCourseForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($CourseID)
    {


        if (!$this->request->isPost()) {

            $schoolcourse = SchoolCourse::findFirstByCourseID($CourseID);
            if (!$schoolcourse) {
                $this->flash->error("ไม่พบข้อมูล");

                return $this->dispatcher->forward(
                    [
                        "controller" => "schoolCourse",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new SchoolCourseForm($schoolcourse, ['edit' => true]);
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
                    "controller" => "schoolCourse",
                    "action"     => "index",
                ]
            );
        }

        $form = new SchoolCourseForm();
        $schoolcourse = new SchoolCourse();
        $data = $this->request->getPost();
        $schoolcourse -> CreateUser =   $CreateUserNow  ;
        $schoolcourse -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $schoolcourse)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "new",
                ]
            );
        }

        if ($schoolcourse->save() == false) {
            foreach ($schoolcourse->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "schoolCourse",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $CourseID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $CourseID

        $CourseID = $this->request->getPost("CourseID", "int");
        $schoolcourese = SchoolCourse::findFirstByCourseID($CourseID);
        if (!$schoolcourese) {
            $this->flash->error("ไม่พบเเลขที่หลักสูตร");

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "index",
                ]
            );
        }

        $form = new SchoolCourseForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $schoolcourese)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "new",
                ]
            );
        }
        $schoolcourese -> LastUser = $LastUserNow ;
        if ($schoolcourese->save() == false) {
            foreach ($schoolcourese->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "schoolCourse",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $CourseID
     */
    public function deleteAction($CourseID)
    {

        $schoolCourse = SchoolCourse::findFirstByCourseID($CourseID);

        if (!$schoolCourse) {
            $this->flash->error("ไม่พบข้อมูลหลักสูตร");

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "index",
                ]
            );
        }

        $schoolCourse -> RecordStatus = 'D' ;
        if (!$schoolCourse->save()) {
            foreach ($schoolCourse->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "schoolCourse",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "schoolCourse",
                "action"     => "index",
            ]
        );
    }



}
