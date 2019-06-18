<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    private $_headerMenu = [
        'navbar-left' => [
            'index' => [
                'caption' => 'Home',
                'action' => 'index'
            ],
            'masclassgroup' => [
                'caption' => 'แฟ้มข้อมูลหลัก',
                'action' => 'index'
            ],
            'schoolcourse' => [
                'caption' => 'ข้อมูลระเบียน',
                'action' => 'index'
            ],


        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In/Sign Up',
                'action' => 'index'
            ],
        ]
    ];

    private $_tabs = [
            'ข้อมูลช่วงชั้น' => [
            'controller' => 'masclassgroup',
            'action' => 'index',
            'any' => true
        ], 'ข้อมูลระดับการศึกษา' => [
            'controller' => 'masclasslevel',
            'action' => 'index',
            'any' => true
        ],'ข้อมูลคำนำหน้าชื่อ' => [
            'controller' => 'masprefixname',
            'action' => 'index',
            'any' => true ],
        'ข้อมูลรายวิชา' => [
            'controller' => 'massubject',
            'action' => 'index',
            'any' => true ],
        'ข้อมูลกลุ่มสาระวิชา' => [
            'controller' => 'massubjectgroup',
            'action' => 'index',
            'any' => true ],
        'ข้อมูลประเภทวิชา' => [
            'controller' => 'massubjecttype',
            'action' => 'index',
            'any' => true ],
    ];

    private $_tabs2 = [
//        'ข้อมูลภาคการศึกษา/ปีการศึกษา' => [
//            'controller' => 'schoolacadtermyear',
//            'action' => 'index',
//            'any' => true
//        ],
        'ข้อมูลหลักสูตร' => [
            'controller' => 'schoolcourse',
            'action' => 'index',
            'any' => true
        ],'ข้อมูลนักเรียน' => [
            'controller' => 'schoolstudent',
            'action' => 'index',
            'any' => true ],
        'ข้อมูลอาจารย์' => [
            'controller' => 'teacher',
            'action' => 'index',
            'any' => true ],

    ];

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Log Out',
                'action' => 'end'
            ];
        } else {
            unset($this->_headerMenu['navbar-left']['masclassgroup']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }

    public function getTabs2()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs2 as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
}
