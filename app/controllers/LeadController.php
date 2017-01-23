<?php

class LeadController extends CoreController
{
    public function indexAction()
    {
        $collection = \Wedding\EnquiryQuery::create()->find();
        $this->view->collection = $collection;
    }

    public function addAction()
    {
        $this->view->title('Add Lead');
    }


    public function editAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getGetParams();

        if(!isset($params['id'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }


        $enq = \Wedding\EnquiryQuery::create()->findOneByEntityId($params['id']);
        $this->view->enq = $enq;
        $this->view->title(sprintf('Edit Enquiry %s', $enq->getFormattedId()));

    }
}