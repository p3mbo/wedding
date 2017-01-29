<?php

class LeadController extends CoreController
{
    public function indexAction()
    {
        $collection = \Wedding\EnquiryQuery::create()->find();
        $this->view->collection = $collection;

        $this->view->js('/js/viewing.js');
    }

    public function addAction()
    {
        $this->view->title('Add Lead');
    }

    public function promoteAction()
    {
        $enq = $this->_initEnquiry();
        if($enq->markPromoted()) {
            \Wedding\Messages::addSuccess('Lead marked as promoted.');
        }

        $this->redirectReferer();
    }

    public function loseAction()
    {
        $enq = $this->_initEnquiry();
        if($enq->markLost()) {
            \Wedding\Messages::addSuccess('Lead marked as lost.');
        }

        $this->redirectReferer();
    }

    public function resetAction()
    {
        $enq = $this->_initEnquiry();
        if($enq->reset()) {
            \Wedding\Messages::addSuccess('Lead marked as lost.');
        }

        $this->redirectReferer();
    }

    public function contactedAction()
    {
        $enq = $this->_initEnquiry();
        if($enq->markContacted()) {
            \Wedding\Messages::addSuccess('Lead marked as contacted.');
        }

        $this->redirectReferer();
    }

    public function editAction()
    {
        $enq = $this->_initEnquiry();

        $this->view->enq = $enq;
        $this->view->title(sprintf('Edit Enquiry %s', $enq->getFormattedId()));

    }

    /**
     * @return \Wedding\Enquiry
     */
    private function _initEnquiry()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getGetParams();

        if(!isset($params['id'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }


        $enq = \Wedding\EnquiryQuery::create()->findOneByEntityId($params['id']);

        if(!$enq) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }

        return $enq;
    }

    public function editPostAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getPostParams();

        if(!isset($params['enq'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }

        $data = $params['enq'];


        return $this->_saveEnquiry($data);

    }


    private function _saveEnquiry($data)
    {

        if(isset($data['enq_id']) && !empty($data['enq_id'])) {
            $enquiry = \Wedding\EnquiryQuery::create()->findOneByEntityId($data['enq_id']);

            if(!$enquiry) {
                if(!isset($params['enq'])) {
                    \Wedding\Messages::addError('Could not locate entry for saving');
                    $this->redirectReferer();
                }
            }
        } else {
            $enquiry = new \Wedding\Enquiry();
        }


        $enquiry->fromArray($data, \Propel\Runtime\Map\TableMap::TYPE_FIELDNAME);


        try {
            $enquiry->save();
        } catch(Exception $e) {
            \Wedding\Messages::addError('Could not locate entry for saving');
            $this->redirectReferer();
        }




        \Wedding\Messages::addSuccess('Lead Updated');
        header('Location: ' . \Wedding::getUrl('lead'));
        exit;
    }
}