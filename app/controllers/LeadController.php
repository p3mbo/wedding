<?php

class LeadController extends CoreController
{
    public function indexAction()
    {
        $collection = \Wedding\EnquiryQuery::create()->find();
        $this->view->collection = $collection;
    }
}