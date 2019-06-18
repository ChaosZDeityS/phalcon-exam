<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use Phalcon\Image\Adapter\GD ;
use Phalcon\Http\Request ;
use Phalcon\Http\Request\File ;
use Phalcon\Mvc\Controller;

class TeacherController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('จัดการข้อมูลอาจารย์');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new TeacherForm();
    }

    public function uploadAction()
    {

        // Check if the user has uploaded files
        if ($this->request->hasFiles()) {

            $files = $this->request->getUploadedFiles();

            // Print the real file names and sizes
            foreach ($files as $file) {
                // Print file details

                echo $file->getName(), ' ', $file->getSize(), '\n';

                // Move the file into the application
                $file->moveTo(
                    'upload/' . $file->getName()
                );
            }
        }
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Teacher" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $teacher = Teacher::find($parameters);
        $teacher -> RecordStatus =  'N' ;




        if (count($teacher) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $teacher,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->teacher = $teacher;
    }

    /**
     * Shows the form to create a new $schoolCourse
     */
    public function newAction()
    {
        $this->view->form = new TeacherForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($TeacherID)
    {


        if (!$this->request->isPost()) {

            $teacher = Teacher::findFirstByTeacherID($TeacherID);
            if (!$teacher) {
                $this->flash->error("ไม่พบข้อมูล");

                return $this->dispatcher->forward(
                    [
                        "controller" => "teacher",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new TeacherForm($teacher, ['edit' => true]);
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
                    "controller" => "teacher",
                    "action"     => "index",
                ]
            );
        }

        $form = new TeacherForm();
        $teacher = new Teacher();
        $data = $this->request->getPost();
        $teacher -> CreateUser =   $CreateUserNow  ;
        $teacher -> LastUser = $LastUserNow ;
//        $teacher->setPhoto(base64_encode(file_get_contents($this->request->getUploadedFiles()[0]->getTempName())));




        if (!$form->isValid($data, $teacher)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "new",
                ]
            );
        }

        if ($teacher->save() == false) {
            foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "teacher",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $TeacherID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $CourseID

        $TeacherID = $this->request->getPost("TeacherID", "int");
        $teacher = Teacher::findFirstByTeacherID($TeacherID);
        if (!$teacher) {
            $this->flash->error("ไม่พบเลขที่อาจารย์");

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "index",
                ]
            );
        }

        $form = new TeacherForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $teacher)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "new",
                ]
            );
        }
        $teacher -> LastUser = $LastUserNow ;
        if ($teacher->save() == false) {
            foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "teacher",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $TeacherID
     */
    public function deleteAction($TeacherID)
    {

        $teacher = Teacher::findFirstByTeacherID($TeacherID);

        if (!$teacher) {
            $this->flash->error("ไม่พบข้อมูล");

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "index",
                ]
            );
        }

        $teacher -> RecordStatus = 'D' ;
        if (!$teacher->save()) {
            foreach ($teacher->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "teacher",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "teacher",
                "action"     => "index",
            ]
        );
    }



}
