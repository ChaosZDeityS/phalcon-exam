<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MasClassGroupController extends ControllerBase
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
        $this->view->form = new MasClassGroupForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MasClassGroup" ,$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];

        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;


        }
//        $masClassGroup = MasClassGroup::find([$parameters , 'order' => 'ClassGroupSorting ASC' , 'conditions' => " RecordStatus LIKE 'N' " ]);
         $masClassGroup = MasClassGroup::find($parameters);
         $masClassGroup -> RecordStatus =  'N' ;



        if (count($masClassGroup) == 0) {
            $this->flash->notice("The search did not find any MasClassGroup");

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $masClassGroup,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->masClassGroup = $masClassGroup;
    }

    /**
     * Shows the form to create a new MasClassGroup
     */
    public function newAction()
    {
        $this->view->form = new MasClassGroupForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($ClassGroupID)
    {


        if (!$this->request->isPost()) {

            $masclassgroup = MasClassGroup::findFirstByClassGroupID($ClassGroupID);
            if (!$masclassgroup) {
                $this->flash->error("ไม่พบข้อมูลจากฐานข้อมูลช่วงชั้น");

                return $this->dispatcher->forward(
                    [
                        "controller" => "masClassGroup",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new MasClassGroupForm($masclassgroup, ['edit' => true]);
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
                    "controller" => "masClassGroup",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasClassGroupForm();
        $masclassgroup = new MasClassGroup();
        $data = $this->request->getPost();
        $masclassgroup -> CreateUser =   $CreateUserNow  ;
        $masclassgroup -> LastUser = $LastUserNow ;



        if (!$form->isValid($data, $masclassgroup)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "new",
                ]
            );
        }

        if ($masclassgroup->save() == false) {
            foreach ($masclassgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("masClassGroup was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "masClassGroup",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current ClassGroupID in screen
     *
     * @param string $ClassGroupID
     */
    public function saveAction()
    {

        $auth = $this->session->get('auth');
        $user = Users::findFirst($auth['id']);
        $LastUserNow = $user->username;
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "index",
                ]
            );
        }
//        * @param string $ClassGroupID

        $ClassGroupID = $this->request->getPost("ClassGroupID", "int");
        $masclassgroup = MasClassGroup::findFirstByClassGroupID($ClassGroupID);
        if (!$masclassgroup) {
            $this->flash->error("ClassGroupID does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "index",
                ]
            );
        }

        $form = new MasClassGroupForm();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $masclassgroup)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "new",
                ]
            );
        }
        $masclassgroup -> LastUser = $LastUserNow ;
        if ($masclassgroup->save() == false) {
            foreach ($masclassgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("masClassGroup was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "masClassGroup",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a ClassGroup
     *
     * @param string $ClassGroupID
     */
    public function deleteAction($ClassGroupID)
    {

        $masClassGroup = MasClassGroup::findFirstByClassGroupID($ClassGroupID);

        if (!$masClassGroup) {
            $this->flash->error("masClassGroup was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "index",
                ]
            );
        }

        $masClassGroup -> RecordStatus = 'D' ;
        if (!$masClassGroup->save()) {
            foreach ($masClassGroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "masClassGroup",
                    "action"     => "search",
                ]
            );
        }


        $this->flash->success("masClassGroup was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "masClassGroup",
                "action"     => "index",
            ]
        );
    }



}
