<?php

class CoreController extends Controller
{
    /** @var  \Wedding\StaffPermission */
    /*
    protected $_permission;

    public function init()
    {
        $staffId = \Wedding\Session::getData('staff_id');
        if(!$staffId) {
            header('Location:' . \Timesheets::getUrl('login'));
            exit;
        }

        $staffPermission = \Wedding\StaffPermissionQuery::create()->findOneByStaffId($staffId);


        $this->_permission = $staffPermission;

        // Make permission available to layout
        \Wedding\Registry::register('permission', $this->_permission);
    }
    */


    public function noPriv()
    {
        header('Location: /index/permission');
        exit;
    }

    public function redirectReferer()
    {
        $url = "/";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
        }

        header('Location: '. $url);
        exit;
    }
}