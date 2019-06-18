<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('ระบบจัดการฐานข้อมูล | ');
        $this->view->setTemplateAfter('main');
    }
}
