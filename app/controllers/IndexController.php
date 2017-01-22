<?php

class IndexController extends CoreController
{
    public function indexAction()
    {
        die('moo');
    }

    public function permissionAction()
    {
        $this->view->title('Naughty person alert');
    }
}