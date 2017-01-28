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