<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MasClassLevelController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your Mas Class Group');
        parent::initialize();

    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new MasClassLevelForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MasClassLevel" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $masClassLevel = MasClassLevel::find($parameters);
        $masClassLevel -> RecordStatus =  'N' ;




        if (count($masClassLevel) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $masClassLevel,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->masClassLevel = $masClassLevel;
    }

    /**
     * Shows the form to create a new MasClassGroup
     */
    public function newAction()
    {
        $this->view->form = new MasClassLevelForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($ClassLevelID)
    {


        if (!$this->request->isPost()) {

            $masclasslevel = MasClassLevel::findFirstByClassLevelID($ClassLevelID);
            if (!$masclasslevel) {
                $this->flash->error("MasClassLevel was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "masClassLevel",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new MasClassLevelForm($masclasslevel, ['edit' => true]);
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
                    "controller" => "masClassLevel",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasClassLevelForm();
        $masclasslevel = new MasClassLevel();
        $data = $this->request->getPost();
        $masclasslevel -> CreateUser =   $CreateUserNow  ;
        $masclasslevel -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $masclasslevel)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "new",
                ]
            );
        }

        if ($masclasslevel->save() == false) {
            foreach ($masclasslevel->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลระดับการศึกษาสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masClassLevel",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current LevelID in screen
     *
     * @param string $ClassLevelID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $ClassLevelID

        $ClassLevelID = $this->request->getPost("ClassLevelID", "int");
        $masclasslevel = MasClassLevel::findFirstByClassLevelID($ClassLevelID);
        if (!$masclasslevel) {
            $this->flash->error("ไม่พบเลขที่ระดับการศึกษา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasClassLEvelForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $masclasslevel)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "new",
                ]
            );
        }
        $masclasslevel -> LastUser = $LastUserNow ;
        if ($masclasslevel->save() == false) {
            foreach ($masclasslevel->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masClassLevel",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $ClassLevelID
     */
    public function deleteAction($ClassLevelID)
    {

        $masClassLevel = MasClassLevel::findFirstByClassLevelID($ClassLevelID);

        if (!$masClassLevel) {
            $this->flash->error("masClassLevel was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "index",
                ]
            );
        }

        $masClassLevel -> RecordStatus = 'D' ;
        if (!$masClassLevel->save()) {
            foreach ($masClassLevel->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassLevel",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masClassLevel",
                "action"     => "index",
            ]
        );
    }



}
