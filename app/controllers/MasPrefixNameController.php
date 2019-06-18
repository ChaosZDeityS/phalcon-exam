<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MasPrefixNameController extends ControllerBase
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
        $this->view->form = new MasPrefixNameForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MasPrefixName" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
        $masPrefixName = MasPrefixName::find($parameters);
        $masPrefixName -> RecordStatus =  'N' ;




        if (count($masPrefixName) == 0) {
            $this->flash->notice("ไม่พบข้อมูลที่ต้องการค้นหา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $masPrefixName,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->masPrefixName = $masPrefixName;
    }

    /**
     * Shows the form to create a new MasClassGroup
     */
    public function newAction()
    {
        $this->view->form = new MasPrefixNameForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($PrefixNameID)
    {


        if (!$this->request->isPost()) {

            $masprefixname = MasPrefixName::findFirstByPrefixNameID($PrefixNameID);
            if (!$masprefixname) {
                $this->flash->error("ไม่พบฐานข้อมูลคำนำหน้าชื่อ");

                return $this->dispatcher->forward(
                    [
                        "controller" => "masPrefixName",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new MasPrefixNameForm($masprefixname, ['edit' => true]);
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
                    "controller" => "masPrefixName",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasPrefixNameForm();
        $masprefixname = new MasPrefixName();
        $data = $this->request->getPost();
        $masprefixname -> CreateUser =   $CreateUserNow  ;
        $masprefixname -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $masprefixname)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "new",
                ]
            );
        }

        if ($masprefixname->save() == false) {
            foreach ($masprefixname->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("เพิ่มข้อมูลระดับการศึกษาสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masPrefixName",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current $masprefixname in screen
     *
     * @param string $PrefixNameTh
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $ClassLevelID

        $PrefixNameID = $this->request->getPost("PrefixNameID", "int");
        $masprefixname = MasPrefixName::findFirstByPrefixNameID($PrefixNameID);
        if (!$masprefixname) {
            $this->flash->error("ไม่พบเลขที่ระดับการศึกษา");

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasPrefixNameForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $masprefixname)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "new",
                ]
            );
        }
        $masprefixname -> LastUser = $LastUserNow ;
        if ($masprefixname->save() == false) {
            foreach ($masprefixname->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("แก้ไขข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masPrefixName",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a Level
     *
     * @param string $ClassLevelID
     */
    public function deleteAction($PrefixNameID)
    {

        $masPrefixName = MasPrefixName::findFirstByPrefixNameID($PrefixNameID);

        if (!$masPrefixName) {
            $this->flash->error("masClassLevel was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "index",
                ]
            );
        }

        $masPrefixName -> RecordStatus = 'D' ;
        if (!$masPrefixName->save()) {
            foreach ($masPrefixName->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masPrefixName",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("ลบข้อมูลสำเร็จ");

        return $this->dispatcher->forward(
            [
                "controller" => "masPrefixName",
                "action"     => "index",
            ]
        );
    }



}
