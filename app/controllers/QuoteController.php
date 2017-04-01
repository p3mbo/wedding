<?php

class QuoteController extends CoreController
{
    public function indexAction()
    {
        $collection = \Wedding\QuoteQuery::create()->joinWithEnquiry()->find();
        $this->view->collection = $collection;
    }

    public function addAction()
    {
        $itemGroups = \Wedding\QuoteItemGroupQuery::create()->find();

        $enquiry = $this->_getEnquiry();

        $this->view->itemGroups = $itemGroups;
        $this->view->enquiry = $enquiry;
        $this->view->title('Add Quote');
    }

    public function editPostAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getPostParams();

        if(!isset($params['quote'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }

        $quoteData = $params['quote'];


        // IF editing and not wanting to create a new quote
        // load the existing quote psased in via param
        // else
        $quote = new \Wedding\Quote();
        // end if

        echo '<pre>';
        print_r($quoteData);
        die('done');
        $quote->fromArray($quoteData, \Propel\Runtime\Map\TableMap::TYPE_FIELDNAME);

        echo '<pre>';
        print_r($quoteData);
        exit;
    }

    private function _getEnquiry()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getGetParams();
        if(!isset($params['enquiry_id'])) {
            throw new Exception('Invalid Enquiry Id');
        }

        $enquiry = \Wedding\EnquiryQuery::create()->findOneByEntityId($params['enquiry_id']);
        if(!$enquiry) {
            throw new Exception('Could not locate enquiry to create linked quote.');
        }

        return $enquiry;

    }

}