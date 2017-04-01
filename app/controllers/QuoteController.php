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

        try {
            // IF editing and not wanting to create a new quote
            // load the existing quote psased in via param
            // else
            $quote = new \Wedding\Quote();
            // end if


            if(isset($quoteData['day'])) {
                $quote->setDay(implode(',', $quoteData['day']));
            }

            if(isset($quoteData['month'])) {
                $quote->setMonth(implode(',', $quoteData['month']));
            }

            if(isset($quoteData['year'])) {
                $quote->setYear($quoteData['year']);
            }

            if(isset($quoteData['exc'])) {
                $quote->setExclusive(implode(',', $quoteData['exc']));
            }

            $quote->setCeremonyTypeId($quoteData['ceremony']);
            $quote->setSpecificDate($quoteData['date']);
            $quote->setDayGuests($quoteData['dayg']);
            $quote->setEveGuests($quoteData['eveg']);
            $quote->setEnquiryId($quoteData['enquiry_id']);
            $quote->setCreatedAt(time());
            $quote->save();


            $enquiry = $quote->getEnquiry();



            $staffId = null;
            $result = \Wedding\EnquiryComment::add($enquiry, $quoteData['notes'], $staffId);
        } catch(Exception $e) {
            \Wedding\Messages::addError($e->getMessage());
            $this->redirectReferer();
        }


        $url = \Wedding::getUrl('quote/add', ['enquiry_id' => $enquiry->getEntityId(), 'quote_id' => $quote->getEntityId()]);
        header('Location: '. $url);
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